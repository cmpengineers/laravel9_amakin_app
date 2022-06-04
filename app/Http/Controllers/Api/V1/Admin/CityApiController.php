<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreCityRequest;
use App\Http\Requests\UpdateCityRequest;
use App\Http\Resources\Admin\CityResource;
use App\Models\City;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CityApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('city_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CityResource(City::with(['country'])->get());
    }

    public function store(StoreCityRequest $request)
    {
        $city = City::create($request->all());

        if ($request->input('city_image', false)) {
            $city->addMedia(storage_path('tmp/uploads/' . basename($request->input('city_image'))))->toMediaCollection('city_image');
        }

        return (new CityResource($city))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(City $city)
    {
        abort_if(Gate::denies('city_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new CityResource($city->load(['country']));
    }

    public function update(UpdateCityRequest $request, City $city)
    {
        $city->update($request->all());

        if ($request->input('city_image', false)) {
            if (!$city->city_image || $request->input('city_image') !== $city->city_image->file_name) {
                if ($city->city_image) {
                    $city->city_image->delete();
                }
                $city->addMedia(storage_path('tmp/uploads/' . basename($request->input('city_image'))))->toMediaCollection('city_image');
            }
        } elseif ($city->city_image) {
            $city->city_image->delete();
        }

        return (new CityResource($city))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(City $city)
    {
        abort_if(Gate::denies('city_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $city->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
