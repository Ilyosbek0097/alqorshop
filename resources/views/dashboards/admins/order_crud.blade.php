@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title', 'Branches')

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="card-title">Buyurtmalarni Tahrirlash</h3>
                        </div>

                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="offset-lg-1"></div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-primary" style="height: 170px">
                                <div class="inner">
                                    <p class="text-center">Mijoz Malumoti</p>
                                    <h5>Ismi: {{ $serial_order[0]->customer_name }}</h5>
                                    <p>Manzili:
                                        {{ $serial_order[0]->customer_address }}
                                    </p>
                                    <p>Teli:
                                        {{ $serial_order[0]->phone_number }}
                                    </p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-success" style="height: 170px">
                                <div class="inner">
                                    <p class="text-center">Agent Malumoti</p>
                                    <h5>Ismi: {{ $serial_order[0]->name }}</h5>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-user-secret"></i>
                                </div>
                                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
                            </div>
                        </div>
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning" style="height: 170px">
                                <div class="inner">
                                    <p class="text-center">Buyurtma Malumoti</p>
                                    <h5>Buyurtma №: <span class="text-success h3"
                                                          style="font-weight:900">{{ $serial_order[0]->serial_number }}</span>
                                    </h5>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-cube"></i>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        @if ($serial_order[0]->order_status == 1)

                        @else
                            <div class="col-md-4 mb-3">
                                <button data-id="{{ $serial_order[0]->serial_number }}" id="checked"
                                        class="form-control btn  btn-success"><i class="fa fa-check"></i> &nbsp;
                                    Tasdiqlash
                                </button>
                            </div>
                            <div class="col-md-4 mb-3"></div>
                            <div class="col-md-4 mb-3">
                                <button id="delete" data-id="{{ $serial_order[0]->serial_number }}"
                                        class="form-control btn  btn-danger"><i class="fa fa-trash"></i> &nbsp;
                                    Buyurtmalarni
                                    O'chirish
                                </button>
                            </div>
                        @endif

                        <div class="col-md-12">
                            @if ($errors->any())
                                <div class="alert alert-success alert-block text-center">
                                    <button type="button" id="close_btn" class="close"
                                            data-dismiss="alert">×
                                    </button>
                                    <strong>{{ $errors->first() }}</strong>
                                </div>
                            @endif
                            <table id="order_crud_table" class="table  display">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Maxsulot Nomi</th>
                                    <th>Buyurtma Miqdori</th>
                                    <th>Bazadagi Miqdori</th>
                                    <th>Maxsulot Narxi</th>
                                    <th>Jami Narxi</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{-- {{ ($serial_order[0]) }} --}}
                                @php
                                    $a = 1;
                                    $big_amount = 0;
                                @endphp
                                {{--                                    {{ dd($serial_order) }}--}}
                                @foreach ($serial_order as $order)
                                    @if($order->ammount <= $order->product_amount)
                                        <tr>
                                            <td>{{ $a }}</td>
                                            <td>{{ $order->product_name }}</td>
                                            <td>{{ $order->ammount }}</td>
                                            <td>{{ $order->product_amount }}</td>
                                            <td>{{ number_format($order->selling_price,0,'.',' ') }}</td>
                                            <td>{{ number_format($order->selling_price * $order->ammount,0,'.',' ') }}</td>
                                            <td>
                                                <div class="form-group">

                                                    @if ($order->order_status == 1)

                                                    @else
                                                        <a class="btn btn-info"
                                                           href="{{ route('admin.edit_order', $order->order_id) }}"><i
                                                                class="fa fa-pen"></i></a>
                                                        <button onclick="delete_confirm()" type="button"
                                                                class="ml-2 del_order btn btn-danger"><i
                                                                class="fa fa-trash"></i></button>
                                                    @endif

                                                </div>
                                            </td>
                                        </tr>
                                    @else
                                        <tr class="text-danger test_amount" data-amount='{{$big_amount+1}}'>
                                            <td>{{ $a }}</td>
                                            <td>{{ $order->product_name }}</td>
                                            <td>{{ $order->ammount }}</td>
                                            <td>{{ $order->product_amount }}</td>
                                            <td>{{ number_format($order->selling_price,0,'.',' ') }}</td>
                                            <td>{{ number_format($order->selling_price * $order->ammount,0,'.',' ') }}</td>
                                            <td>
                                                <div class="form-group">

                                                    @if ($order->order_status == 1)

                                                    @else
                                                        <a class="btn btn-info"
                                                           href="{{ route('admin.edit_order', $order->order_id) }}"><i
                                                                class="fa fa-pen"></i></a>
                                                        <button onclick="delete_confirm()" type="button"
                                                                class="ml-2 del_order btn btn-danger"><i
                                                                class="fa fa-trash"></i></button>
                                                    @endif

                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    @php
                                        $a++;
                                    @endphp
                                @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $("#order_crud_table").DataTable({});
        $(document).ready(function () {
            $("#checked").click(function () {
                var order_ID = $(this).data('id');
                var big_amount = $(".test_amount").data('amount');
                if (big_amount == 1) {
                    Swal.fire({
                        icon: 'warning',
                        iconColor: 'red',
                        title: 'Diqqat!',
                        text: 'Buyurtmadagi Maxsulotlar Miqdori Bazada Qolmagan! Iltimos Buyurtmani Tahrirlang!',
                        showConfirmButton: false,
                        timer: 3000
                    })
                } else {
                    Swal.fire({
                        title: "Tasdiqlaysizmi ?",
                        text: "Agar Tasdiqlasangiz Ushbu Buyurtmalar Sotiladi",
                        icon: 'info',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Tasdiqlash',
                        cancelButtonText: 'Bekor Qilish'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // console.log($order_ID);
                            $.ajax({
                                type: "POST",
                                url: "{{ route('admin.sales_order') }}",
                                data: {
                                    'serial_number': order_ID
                                },
                                success: function (response) {
                                    if (response == 1) {
                                        Swal.fire({
                                            icon: 'success',
                                            title: "Buyurtmalar Sotildi",
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        url = '{{ route('admin.order_view') }}'
                                        window.location.href = url;
                                    } else {
                                        console.log(response);
                                        Swal.fire({
                                            icon: 'error',
                                            title: "Xatolik Sodir Bo'ldi",
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                    }
                                }
                            });


                        }
                    })
                }

            });
            $("#delete").click(function () {
                var order_ID = $(this).data('id');
                Swal.fire({
                    title: "Aniq O'chirasizmi ?",
                    text: "Agar Tasdiqlasangiz Ushbu Buyurtmalar O'chiriladi!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Tasdiqlash',
                    cancelButtonText: 'Bekor Qilish'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // console.log($order_ID);
                        $.ajax({
                            type: "POST",
                            url: "{{ route('admin.delete_order') }}",
                            data: {
                                'serial_number': order_ID
                            },
                            success: function (response) {
                                console.log(response);
                            }
                        });
                        Swal.fire({
                            icon: 'success',
                            title: "Mijoz O'chirildi!",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        url = '{{ route('admin.order_view') }}'
                        window.location.href = url;
                    }
                })
            });
            var table = $('#order_crud_table').DataTable();
            $('#order_crud_table tbody').on('click', 'tr', function () {
                $(this).toggleClass('bg-warning');
                // $(this).addClass('bg-warning');
            });

            // $('#confirmation').click( function () {
            //    var row = table.rows('.selected').data();
            //    console.log(row);
            //     // for (let index = 0; index < row.length; index++) {
            //     //     const element = row[index];
            //     //     console.log(element);

            //     // }
            // } );
        });
    </script>
@endsection
