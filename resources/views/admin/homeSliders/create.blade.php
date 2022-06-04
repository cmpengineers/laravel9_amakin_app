@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.homeSlider.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.home-sliders.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="home_sliders">{{ trans('cruds.homeSlider.fields.home_sliders') }}</label>
                <div class="needsclick dropzone {{ $errors->has('home_sliders') ? 'is-invalid' : '' }}" id="home_sliders-dropzone">
                </div>
                @if($errors->has('home_sliders'))
                    <div class="invalid-feedback">
                        {{ $errors->first('home_sliders') }}
                    </div>
                @endif
                <span class="help-block">{{ trans('cruds.homeSlider.fields.home_sliders_helper') }}</span>
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

@section('scripts')
<script>
    var uploadedHomeSlidersMap = {}
Dropzone.options.homeSlidersDropzone = {
    url: '{{ route('admin.home-sliders.storeMedia') }}',
    maxFilesize: 1, // MB
    acceptedFiles: '.jpeg,.jpg,.png,.gif',
    addRemoveLinks: true,
    headers: {
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    params: {
      size: 1,
      width: 4096,
      height: 4096
    },
    success: function (file, response) {
      $('form').append('<input type="hidden" name="home_sliders[]" value="' + response.name + '">')
      uploadedHomeSlidersMap[file.name] = response.name
    },
    removedfile: function (file) {
      console.log(file)
      file.previewElement.remove()
      var name = ''
      if (typeof file.file_name !== 'undefined') {
        name = file.file_name
      } else {
        name = uploadedHomeSlidersMap[file.name]
      }
      $('form').find('input[name="home_sliders[]"][value="' + name + '"]').remove()
    },
    init: function () {
@if(isset($homeSlider) && $homeSlider->home_sliders)
      var files = {!! json_encode($homeSlider->home_sliders) !!}
          for (var i in files) {
          var file = files[i]
          this.options.addedfile.call(this, file)
          this.options.thumbnail.call(this, file, file.preview)
          file.previewElement.classList.add('dz-complete')
          $('form').append('<input type="hidden" name="home_sliders[]" value="' + file.file_name + '">')
        }
@endif
    },
     error: function (file, response) {
         if ($.type(response) === 'string') {
             var message = response //dropzone sends it's own error messages in string
         } else {
             var message = response.errors.file
         }
         file.previewElement.classList.add('dz-error')
         _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
         _results = []
         for (_i = 0, _len = _ref.length; _i < _len; _i++) {
             node = _ref[_i]
             _results.push(node.textContent = message)
         }

         return _results
     }
}
</script>
@endsection