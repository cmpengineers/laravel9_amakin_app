<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyPlaceRequest;
use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use App\Models\Area;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Feature;
use App\Models\Place;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class PlaceController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('place_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $places = Place::with(['country', 'city', 'area', 'category', 'features', 'media'])->get();

        $countries = Country::get();

        $cities = City::get();

        $areas = Area::get();

        $categories = Category::get();

        $features = Feature::get();

        return view('admin.places.index', compact('areas', 'categories', 'cities', 'countries', 'features', 'places'));
    }

    public function create()
    {
        abort_if(Gate::denies('place_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areas = Area::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $features = Feature::pluck('name', 'id');

        return view('admin.places.create', compact('areas', 'categories', 'cities', 'countries', 'features'));
    }

    public function store(StorePlaceRequest $request)
    {
        $place = Place::create($request->all());
        $place->features()->sync($request->input('features', []));
        if ($request->input('banner_image', false)) {
            $place->addMedia(storage_path('tmp/uploads/' . basename($request->input('banner_image'))))->toMediaCollection('banner_image');
        }

        if ($request->input('main_image', false)) {
            $place->addMedia(storage_path('tmp/uploads/' . basename($request->input('main_image'))))->toMediaCollection('main_image');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $place->id]);
        }

        return redirect()->route('admin.places.index');
    }

    public function edit(Place $place)
    {
        abort_if(Gate::denies('place_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $countries = Country::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cities = City::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $areas = Area::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $categories = Category::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $features = Feature::pluck('name', 'id');

        $place->load('country', 'city', 'area', 'category', 'features');

        return view('admin.places.edit', compact('areas', 'categories', 'cities', 'countries', 'features', 'place'));
    }

    public function update(UpdatePlaceRequest $request, Place $place)
    {
        $place->update($request->all());
        $place->features()->sync($request->input('features', []));
        if ($request->input('banner_image', false)) {
            if (!$place->banner_image || $request->input('banner_image') !== $place->banner_image->file_name) {
                if ($place->banner_image) {
                    $place->banner_image->delete();
                }
                $place->addMedia(storage_path('tmp/uploads/' . basename($request->input('banner_image'))))->toMediaCollection('banner_image');
            }
        } elseif ($place->banner_image) {
            $place->banner_image->delete();
        }

        if ($request->input('main_image', false)) {
            if (!$place->main_image || $request->input('main_image') !== $place->main_image->file_name) {
                if ($place->main_image) {
                    $place->main_image->delete();
                }
                $place->addMedia(storage_path('tmp/uploads/' . basename($request->input('main_image'))))->toMediaCollection('main_image');
            }
        } elseif ($place->main_image) {
            $place->main_image->delete();
        }

        return redirect()->route('admin.places.index');
    }

    public function show(Place $place)
    {
        abort_if(Gate::denies('place_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $place->load('country', 'city', 'area', 'category', 'features', 'placeItemReviews');

        return view('admin.places.show', compact('place'));
    }

    public function destroy(Place $place)
    {
        abort_if(Gate::denies('place_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $place->delete();

        return back();
    }

    public function massDestroy(MassDestroyPlaceRequest $request)
    {
        Place::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('place_create') && Gate::denies('place_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Place();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
