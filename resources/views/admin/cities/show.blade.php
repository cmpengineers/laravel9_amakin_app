@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.city.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.city.fields.id') }}
                        </th>
                        <td>
                            {{ $city->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.city.fields.name') }}
                        </th>
                        <td>
                            {{ $city->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.city.fields.country') }}
                        </th>
                        <td>
                            {{ $city->country->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.city.fields.city_image') }}
                        </th>
                        <td>
                            @if($city->city_image)
                                <a href="{{ $city->city_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $city->city_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.cities.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#city_areas" role="tab" data-toggle="tab">
                {{ trans('cruds.area.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#city_places" role="tab" data-toggle="tab">
                {{ trans('cruds.place.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="city_areas">
            @includeIf('admin.cities.relationships.cityAreas', ['areas' => $city->cityAreas])
        </div>
        <div class="tab-pane" role="tabpanel" id="city_places">
            @includeIf('admin.cities.relationships.cityPlaces', ['places' => $city->cityPlaces])
        </div>
    </div>
</div>

@endsection