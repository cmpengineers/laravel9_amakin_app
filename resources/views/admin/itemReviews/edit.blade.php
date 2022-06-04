@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.itemReview.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.item-reviews.update", [$itemReview->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="quality">{{ trans('cruds.itemReview.fields.quality') }}</label>
                <input class="form-control {{ $errors->has('quality') ? 'is-invalid' : '' }}" type="number" name="quality" id="quality" value="{{ old('quality', $itemReview->quality) }}" step="1" required>
                @if($errors->has('quality'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quality') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.itemReview.fields.quality_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="location">{{ trans('cruds.itemReview.fields.location') }}</label>
                <input class="form-control {{ $errors->has('location') ? 'is-invalid' : '' }}" type="number" name="location" id="location" value="{{ old('location', $itemReview->location) }}" step="1" required>
                @if($errors->has('location'))
                    <div class="invalid-feedback">
                        {{ $errors->first('location') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.itemReview.fields.location_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="price">{{ trans('cruds.itemReview.fields.price') }}</label>
                <input class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" type="number" name="price" id="price" value="{{ old('price', $itemReview->price) }}" step="1" required>
                @if($errors->has('price'))
                    <div class="invalid-feedback">
                        {{ $errors->first('price') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.itemReview.fields.price_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="service">{{ trans('cruds.itemReview.fields.service') }}</label>
                <input class="form-control {{ $errors->has('service') ? 'is-invalid' : '' }}" type="number" name="service" id="service" value="{{ old('service', $itemReview->service) }}" step="1" required>
                @if($errors->has('service'))
                    <div class="invalid-feedback">
                        {{ $errors->first('service') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.itemReview.fields.service_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="wifi">{{ trans('cruds.itemReview.fields.wifi') }}</label>
                <input class="form-control {{ $errors->has('wifi') ? 'is-invalid' : '' }}" type="number" name="wifi" id="wifi" value="{{ old('wifi', $itemReview->wifi) }}" step="1" required>
                @if($errors->has('wifi'))
                    <div class="invalid-feedback">
                        {{ $errors->first('wifi') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.itemReview.fields.wifi_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="attitude">{{ trans('cruds.itemReview.fields.attitude') }}</label>
                <input class="form-control {{ $errors->has('attitude') ? 'is-invalid' : '' }}" type="text" name="attitude" id="attitude" value="{{ old('attitude', $itemReview->attitude) }}" required>
                @if($errors->has('attitude'))
                    <div class="invalid-feedback">
                        {{ $errors->first('attitude') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.itemReview.fields.attitude_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="noise">{{ trans('cruds.itemReview.fields.noise') }}</label>
                <input class="form-control {{ $errors->has('noise') ? 'is-invalid' : '' }}" type="number" name="noise" id="noise" value="{{ old('noise', $itemReview->noise) }}" step="1" required>
                @if($errors->has('noise'))
                    <div class="invalid-feedback">
                        {{ $errors->first('noise') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.itemReview.fields.noise_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="quietness">{{ trans('cruds.itemReview.fields.quietness') }}</label>
                <input class="form-control {{ $errors->has('quietness') ? 'is-invalid' : '' }}" type="number" name="quietness" id="quietness" value="{{ old('quietness', $itemReview->quietness) }}" step="1" required>
                @if($errors->has('quietness'))
                    <div class="invalid-feedback">
                        {{ $errors->first('quietness') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.itemReview.fields.quietness_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="star">{{ trans('cruds.itemReview.fields.star') }}</label>
                <input class="form-control {{ $errors->has('star') ? 'is-invalid' : '' }}" type="number" name="star" id="star" value="{{ old('star', $itemReview->star) }}" step="1">
                @if($errors->has('star'))
                    <div class="invalid-feedback">
                        {{ $errors->first('star') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.itemReview.fields.star_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="total_score">{{ trans('cruds.itemReview.fields.total_score') }}</label>
                <input class="form-control {{ $errors->has('total_score') ? 'is-invalid' : '' }}" type="number" name="total_score" id="total_score" value="{{ old('total_score', $itemReview->total_score) }}" step="1" required>
                @if($errors->has('total_score'))
                    <div class="invalid-feedback">
                        {{ $errors->first('total_score') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.itemReview.fields.total_score_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="place_id">{{ trans('cruds.itemReview.fields.place') }}</label>
                <select class="form-control select2 {{ $errors->has('place') ? 'is-invalid' : '' }}" name="place_id" id="place_id" required>
                    @foreach($places as $id => $entry)
                        <option value="{{ $id }}" {{ (old('place_id') ? old('place_id') : $itemReview->place->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('place'))
                    <div class="invalid-feedback">
                        {{ $errors->first('place') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.itemReview.fields.place_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection