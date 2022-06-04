@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.itemReview.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.item-reviews.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.itemReview.fields.id') }}
                        </th>
                        <td>
                            {{ $itemReview->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.itemReview.fields.quality') }}
                        </th>
                        <td>
                            {{ $itemReview->quality }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.itemReview.fields.location') }}
                        </th>
                        <td>
                            {{ $itemReview->location }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.itemReview.fields.price') }}
                        </th>
                        <td>
                            {{ $itemReview->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.itemReview.fields.service') }}
                        </th>
                        <td>
                            {{ $itemReview->service }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.itemReview.fields.wifi') }}
                        </th>
                        <td>
                            {{ $itemReview->wifi }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.itemReview.fields.attitude') }}
                        </th>
                        <td>
                            {{ $itemReview->attitude }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.itemReview.fields.noise') }}
                        </th>
                        <td>
                            {{ $itemReview->noise }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.itemReview.fields.quietness') }}
                        </th>
                        <td>
                            {{ $itemReview->quietness }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.itemReview.fields.star') }}
                        </th>
                        <td>
                            {{ $itemReview->star }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.itemReview.fields.total_score') }}
                        </th>
                        <td>
                            {{ $itemReview->total_score }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.itemReview.fields.place') }}
                        </th>
                        <td>
                            {{ $itemReview->place->name ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.item-reviews.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection