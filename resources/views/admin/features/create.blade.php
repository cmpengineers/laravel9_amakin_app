@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.feature.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.features.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="name">{{ trans('cruds.feature.fields.name') }}</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" id="name" value="{{ old('name', '') }}" required>
                @if($errors->has('name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.feature.fields.name_helper') }}</span>
            </div>
            <div class="form-group">
                <label class="required" for="class_name">{{ trans('cruds.feature.fields.class_name') }}</label>
                <input class="form-control {{ $errors->has('class_name') ? 'is-invalid' : '' }}" type="text" name="class_name" id="class_name" value="{{ old('class_name', '') }}" required>
                @if($errors->has('class_name'))
                    <div class="invalid-feedback">
                        {{ $errors->first('class_name') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.feature.fields.class_name_helper') }}</span>
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