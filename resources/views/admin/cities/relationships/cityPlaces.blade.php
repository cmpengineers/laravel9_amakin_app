@can('place_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.places.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.place.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.place.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-cityPlaces">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.place.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.place.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.place.fields.brief') }}
                        </th>
                        <th>
                            {{ trans('cruds.place.fields.address') }}
                        </th>
                        <th>
                            {{ trans('cruds.place.fields.phone') }}
                        </th>
                        <th>
                            {{ trans('cruds.place.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.place.fields.website') }}
                        </th>
                        <th>
                            {{ trans('cruds.place.fields.vimeo_url') }}
                        </th>
                        <th>
                            {{ trans('cruds.place.fields.longitude') }}
                        </th>
                        <th>
                            {{ trans('cruds.place.fields.latitude') }}
                        </th>
                        <th>
                            {{ trans('cruds.place.fields.country') }}
                        </th>
                        <th>
                            {{ trans('cruds.place.fields.city') }}
                        </th>
                        <th>
                            {{ trans('cruds.place.fields.area') }}
                        </th>
                        <th>
                            {{ trans('cruds.place.fields.category') }}
                        </th>
                        <th>
                            {{ trans('cruds.place.fields.latest_place') }}
                        </th>
                        <th>
                            {{ trans('cruds.place.fields.popular_place') }}
                        </th>
                        <th>
                            {{ trans('cruds.place.fields.banner_image') }}
                        </th>
                        <th>
                            {{ trans('cruds.place.fields.main_image') }}
                        </th>
                        <th>
                            {{ trans('cruds.place.fields.feature') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($places as $key => $place)
                        <tr data-entry-id="{{ $place->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $place->id ?? '' }}
                            </td>
                            <td>
                                {{ $place->name ?? '' }}
                            </td>
                            <td>
                                {{ $place->brief ?? '' }}
                            </td>
                            <td>
                                {{ $place->address ?? '' }}
                            </td>
                            <td>
                                {{ $place->phone ?? '' }}
                            </td>
                            <td>
                                {{ $place->email ?? '' }}
                            </td>
                            <td>
                                {{ $place->website ?? '' }}
                            </td>
                            <td>
                                {{ $place->vimeo_url ?? '' }}
                            </td>
                            <td>
                                {{ $place->longitude ?? '' }}
                            </td>
                            <td>
                                {{ $place->latitude ?? '' }}
                            </td>
                            <td>
                                {{ $place->country->name ?? '' }}
                            </td>
                            <td>
                                {{ $place->city->name ?? '' }}
                            </td>
                            <td>
                                {{ $place->area->name ?? '' }}
                            </td>
                            <td>
                                {{ $place->category->name ?? '' }}
                            </td>
                            <td>
                                <span style="display:none">{{ $place->latest_place ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $place->latest_place ? 'checked' : '' }}>
                            </td>
                            <td>
                                <span style="display:none">{{ $place->popular_place ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $place->popular_place ? 'checked' : '' }}>
                            </td>
                            <td>
                                @if($place->banner_image)
                                    <a href="{{ $place->banner_image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $place->banner_image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($place->main_image)
                                    <a href="{{ $place->main_image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $place->main_image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @foreach($place->features as $key => $item)
                                    <span class="badge badge-info">{{ $item->name }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('place_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.places.show', $place->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('place_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.places.edit', $place->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('place_delete')
                                    <form action="{{ route('admin.places.destroy', $place->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('place_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.places.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-cityPlaces:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection