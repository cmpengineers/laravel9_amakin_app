<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyHomeSliderRequest;
use App\Http\Requests\StoreHomeSliderRequest;
use App\Http\Requests\UpdateHomeSliderRequest;
use App\Models\HomeSlider;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class HomeSliderController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('home_slider_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $homeSliders = HomeSlider::with(['media'])->get();

        return view('admin.homeSliders.index', compact('homeSliders'));
    }

    public function create()
    {
        abort_if(Gate::denies('home_slider_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.homeSliders.create');
    }

    public function store(StoreHomeSliderRequest $request)
    {
        $homeSlider = HomeSlider::create($request->all());

        foreach ($request->input('home_sliders', []) as $file) {
            $homeSlider->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('home_sliders');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $homeSlider->id]);
        }

        return redirect()->route('admin.home-sliders.index');
    }

    public function edit(HomeSlider $homeSlider)
    {
        abort_if(Gate::denies('home_slider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.homeSliders.edit', compact('homeSlider'));
    }

    public function update(UpdateHomeSliderRequest $request, HomeSlider $homeSlider)
    {
        $homeSlider->update($request->all());

        if (count($homeSlider->home_sliders) > 0) {
            foreach ($homeSlider->home_sliders as $media) {
                if (!in_array($media->file_name, $request->input('home_sliders', []))) {
                    $media->delete();
                }
            }
        }
        $media = $homeSlider->home_sliders->pluck('file_name')->toArray();
        foreach ($request->input('home_sliders', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $homeSlider->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('home_sliders');
            }
        }

        return redirect()->route('admin.home-sliders.index');
    }

    public function show(HomeSlider $homeSlider)
    {
        abort_if(Gate::denies('home_slider_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.homeSliders.show', compact('homeSlider'));
    }

    public function destroy(HomeSlider $homeSlider)
    {
        abort_if(Gate::denies('home_slider_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $homeSlider->delete();

        return back();
    }

    public function massDestroy(MassDestroyHomeSliderRequest $request)
    {
        HomeSlider::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('home_slider_create') && Gate::denies('home_slider_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new HomeSlider();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
