@can('item_review_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.item-reviews.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.itemReview.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.itemReview.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-placeItemReviews">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.itemReview.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.itemReview.fields.quality') }}
                        </th>
                        <th>
                            {{ trans('cruds.itemReview.fields.location') }}
                        </th>
                        <th>
                            {{ trans('cruds.itemReview.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.itemReview.fields.service') }}
                        </th>
                        <th>
                            {{ trans('cruds.itemReview.fields.wifi') }}
                        </th>
                        <th>
                            {{ trans('cruds.itemReview.fields.attitude') }}
                        </th>
                        <th>
                            {{ trans('cruds.itemReview.fields.noise') }}
                        </th>
                        <th>
                            {{ trans('cruds.itemReview.fields.quietness') }}
                        </th>
                        <th>
                            {{ trans('cruds.itemReview.fields.star') }}
                        </th>
                        <th>
                            {{ trans('cruds.itemReview.fields.total_score') }}
                        </th>
                        <th>
                            {{ trans('cruds.itemReview.fields.place') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($itemReviews as $key => $itemReview)
                        <tr data-entry-id="{{ $itemReview->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $itemReview->id ?? '' }}
                            </td>
                            <td>
                                {{ $itemReview->quality ?? '' }}
                            </td>
                            <td>
                                {{ $itemReview->location ?? '' }}
                            </td>
                            <td>
                                {{ $itemReview->price ?? '' }}
                            </td>
                            <td>
                                {{ $itemReview->service ?? '' }}
                            </td>
                            <td>
                                {{ $itemReview->wifi ?? '' }}
                            </td>
                            <td>
                                {{ $itemReview->attitude ?? '' }}
                            </td>
                            <td>
                                {{ $itemReview->noise ?? '' }}
                            </td>
                            <td>
                                {{ $itemReview->quietness ?? '' }}
                            </td>
                            <td>
                                {{ $itemReview->star ?? '' }}
                            </td>
                            <td>
                                {{ $itemReview->total_score ?? '' }}
                            </td>
                            <td>
                                {{ $itemReview->place->name ?? '' }}
                            </td>
                            <td>
                                @can('item_review_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.item-reviews.show', $itemReview->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('item_review_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.item-reviews.edit', $itemReview->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('item_review_delete')
                                    <form action="{{ route('admin.item-reviews.destroy', $itemReview->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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
@can('item_review_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.item-reviews.massDestroy') }}",
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
  let table = $('.datatable-placeItemReviews:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection