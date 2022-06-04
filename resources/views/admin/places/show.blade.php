@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.place.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.places.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.id') }}
                        </th>
                        <td>
                            {{ $place->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.name') }}
                        </th>
                        <td>
                            {{ $place->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.description') }}
                        </th>
                        <td>
                            {!! $place->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.brief') }}
                        </th>
                        <td>
                            {{ $place->brief }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.address') }}
                        </th>
                        <td>
                            {{ $place->address }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.phone') }}
                        </th>
                        <td>
                            {{ $place->phone }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.email') }}
                        </th>
                        <td>
                            {{ $place->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.website') }}
                        </th>
                        <td>
                            {{ $place->website }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.vimeo_url') }}
                        </th>
                        <td>
                            {{ $place->vimeo_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.longitude') }}
                        </th>
                        <td>
                            {{ $place->longitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.latitude') }}
                        </th>
                        <td>
                            {{ $place->latitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.country') }}
                        </th>
                        <td>
                            {{ $place->country->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.city') }}
                        </th>
                        <td>
                            {{ $place->city->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.area') }}
                        </th>
                        <td>
                            {{ $place->area->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.category') }}
                        </th>
                        <td>
                            {{ $place->category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.latest_place') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $place->latest_place ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.popular_place') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $place->popular_place ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.banner_image') }}
                        </th>
                        <td>
                            @if($place->banner_image)
                                <a href="{{ $place->banner_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $place->banner_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.main_image') }}
                        </th>
                        <td>
                            @if($place->main_image)
                                <a href="{{ $place->main_image->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $place->main_image->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.place.fields.feature') }}
                        </th>
                        <td>
                            @foreach($place->features as $key => $feature)
                                <span class="label label-info">{{ $feature->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.places.index') }}">
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
            <a class="nav-link" href="#place_item_reviews" role="tab" data-toggle="tab">
                {{ trans('cruds.itemReview.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="place_item_reviews">
            @includeIf('admin.places.relationships.placeItemReviews', ['itemReviews' => $place->placeItemReviews])
        </div>
    </div>
</div>

@endsection