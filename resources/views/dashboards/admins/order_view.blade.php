@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title', 'Laravel')

@section('content')

    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary">
                            <h5>Buyurtmalar</h5>
                        </div><!-- /.card-header -->
                        <div class="card-body">

                            <div class="row mt-4">
                                <div class="col-md-12">
                                    <table id="orders_table" class="table table-bordred">
                                        <thead>
                                            <tr>
                                                <th>Statusi</th>
                                                <th>Buyurtma Nomeri</th>
                                                <th>Haridor Kodi</th>
                                                <th>Ismi</th>
                                                <th>Manzili </th>
                                                <th>Maxsulot Soni</th>
                                                <th>Jami Summasi</th>
                                                <th>Agent</th>
                                                <th>Action</th>
                                                <th>Print</th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-sm">
                                            @if (isset($orders))
                                                @foreach ($orders as $order)
                                                    <tr
                                                        class="@if ($order->order_status == 1) bg-secondary @else bg-light @endif">
                                                        <td>
                                                            @if ($order->order_status == 1)
                                                                <span class="badge badge-success"> <i
                                                                        class="fa fa-check"></i></span>
                                                            @else
                                                                <span class="badge badge-warning"> <i
                                                                        class="fa fa-spinner"></i></span>
                                                            @endif

                                                        </td>
                                                        <td>{{ $order->serial_number }}</td>
                                                        <td><span
                                                                class="badge badge-warning">{{ $order->customer_code }}</span>
                                                        </td>
                                                        <td>{{ $order->customer_name }}</span></td>
                                                        <td>{{ $order->customer_address }}</td>
                                                        <td><span
                                                                class="badge badge-pill badge-info text-md">{{ $order->count }}
                                                        </td>
                                                        <td>{{ number_format($order->total_price, 0, '.', ' ') }}</td>
                                                        <td>{{ $order->name }}</td>
                                                        <td>
                                                            <form action="{{ route('admin.order_table_add') }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="form-group">
                                                                    <input type="hidden"
                                                                        value="{{ $order->serial_number }}"
                                                                        name="serial_number_input">
                                                                    <button type="submit" class="btn btn-primary"><i
                                                                            class="fa fa-eye"></i></button>
                                                                </div>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            @if($order->order_status == 1)
                                                             <a class="btn btn-warning" href="{{ route('admin.order_print',$order->serial_number) }}"><i class="fa fa-print"></i></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif


                                        </tbody>
                                    </table>
                                </div>
                            </div>


                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->


@endsection
@section('script')
    <script>
        $("#orders_table").DataTable({
            columnDefs: [{
                orderable: false,
                targets: 0
            }],
            order: [
                [1, 'desc']
            ]
        })
        $(document).ready(function() {

        })
    </script>
@endsection
