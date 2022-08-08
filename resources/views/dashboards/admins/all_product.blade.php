@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title','Settings')

@section('content')

<div class="row m-1 p-1">
    <div class="col-md-12">
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">Barcha Maxsulotlar </h3>
            </div>
            <div class="card-body p-0">
                <div class="row p-2">
                    <div class="col-md-12">
                        <table id="all_product_table" class="table no-footer dataTable dtr-inline">
                            <thead class="thead-dark">
                                <tr style="font-size: 12px">
                                    <th>ID</th>
                                    <th>Nomi</th>
                                    <th>Shtrix Kodi</th>
                                    <th>Eski Kodi</th>
                                    <th>Miqdori</th>
                                    <th>Kirim Narxi UZS</th>
                                    <th>Kirim Narxi USD</th>
                                    <th>Sotish Narxi</th>
                                    {{-- <th>Amal</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                {{-- {{ $alqor_products }} --}}
                                @foreach ($alqor_products as $product)
                                <tr class="even">
                                    <td class="sorting_1 dtr-control">{{ $product->all_product_id }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->barcode }}</td>
                                    <td>{{ $product->product_code }}</td>
                                    <td>{{ $product->product_amount }}</td>
                                    <td>{{ $product->body_price_uzs }}</td>
                                    <td>{{ $product->body_price_usd }}</td>
                                    <td>{{ $product->selling_price }}</td>
                                    {{-- <td rowspan="1" colspan="1">
                                        <button class="btn btn-primary">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </td> --}}
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>

    </div>

</div>

@endsection
@section('script')
    <script>
        $("#all_product_table").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy",  "excel", "pdf", "print"]
            }).buttons().container().appendTo('#all_product_table_wrapper .col-md-6:eq(0)');

    </script>
@endsection
