<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StorePlaceRequest;
use App\Http\Requests\UpdatePlaceRequest;
use App\Http\Resources\Admin\PlaceResource;
use App\Models\Place;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class PlaceApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('place_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PlaceResource(Place::with(['country', 'city', 'area', 'category', 'features'])->get());
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

        return (new PlaceResource($place))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Place $place)
    {
        abort_if(Gate::denies('place_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new PlaceResource($place->load(['country', 'city', 'area', 'category', 'features']));
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

        return (new PlaceResource($place))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Place $place)
    {
        abort_if(Gate::denies('place_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $place->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
