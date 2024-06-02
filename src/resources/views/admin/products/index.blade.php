@extends('layouts.admin')
@section('content')
@can('product_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.products.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.product.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.product.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Product">
                <thead>
                    <tr>
                        <th width="10"></th>
                        <th>{{ trans('cruds.product.fields.id') }}</th>
                        <th>{{ trans('cruds.product.fields.name') }}</th>
                        <th>{{ trans('cruds.product.fields.faculty') }}</th> <!-- Change this to whatever property your product has -->
                        <th>{{ trans('cruds.product.fields.department') }}</th> <!-- Change this to whatever property your product has -->
                        <th>{{ trans('cruds.product.fields.email') }}</th>
                        <th>{{ trans('cruds.product.fields.birth_date') }}</th>
                        <th>{{ trans('cruds.product.fields.phone') }}</th>
                        <th>{{ trans('cruds.product.fields.address') }}</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $product)
                        <tr data-entry-id="{{ $product->id }}">
                            <td></td>
                            <td>{{ $product->id ?? '' }}</td>
                            <td>{{ $product->name ?? '' }}</td>
                            <td>{{ $product->faculty ?? '' }}</td> <!-- Change this to whatever property your product has -->
                            <td>{{ $product->department ?? '' }}</td> <!-- Change this to whatever property your product has -->
                            <td>{{ $product->email ?? '' }}</td>
                            <td>{{ $product->birth_date ?? '' }}</td>
                            <td>{{ $product->phone ?? '' }}</td>
                            <td>{{ $product->address ?? '' }}</td>
                            <td>
                                @can('product_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.products.show', $product->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('product_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.products.edit', $product->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('product_delete')
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        @csrf
                                        @method('DELETE')
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
@endsection

@section('scripts')
@parent
<script>
    $(function () {
        let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);

        $.extend(true, $.fn.dataTable.defaults, {
            orderCellsTop: true,
            order: [[ 1, 'desc' ]],
            pageLength: 100,
        });

        let table = $('.datatable-Product:not(.ajaxTable)').DataTable({ buttons: dtButtons });

        $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
            $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
        });
    });
</script>
@endsection
