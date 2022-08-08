@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title', 'Customers')

@section('content')
    <div class="row"></div>
    <section class="content mt-5">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="card-title">Mijoz Qo'shish Bo'limi</h3>
                        </div>
                        <div class="col-lg-6">
                            <button id="add_customer" class="btn btn-info float-right"><i class="fa fa-plus"></i> &nbsp;
                                Mijoz
                                Qo'shish</button>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="add_customer_blok">
                    {{-- <strong>Filial Nomi</strong> --}}
                    <form action="{{ route('admin.add_customer_form') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Mijoz Nomi</button>
                                    </div>
                                    <input aria-describedby="customer_name_sm" id="customer_name"
                                        onkeypress="clsAlphaNoOnly(event)" onpaste="return false;" required type="text"
                                        class="form-control @error('customer_name') is-invalid @enderror"
                                        name="customer_name" placeholder="Mijoz Nomini Kirting...">
                                    @error('customer_name')
                                        <small id="customer_name_sm" class="form-text text-muted text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Mijoz Manzili</button>
                                    </div>
                                    <input aria-describedby="customer_address_sm" type="text" id="customer_address"
                                        class="form-control @error('customer_address') is-invalid @enderror"
                                        name="customer_address" placeholder="Mijoz Manzilini Kiriting...">
                                    @error('customer_address')
                                        <small id="customer_address_sm" class="form-text text-muted text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Telefon Raqami</button>
                                    </div>
                                    <input aria-describedby="customer_phone_sm" type="text" name="customer_phone"
                                        class="form-control @error('customer_phone') is-invalid @enderror"
                                        data-inputmask='"mask": "99-999-99-99"' data-mask>
                                    @error('customer_phone')
                                        <small id="customer_phone_sm" class="form-text text-muted text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Mijoz Kodi</button>
                                    </div>
                                    <input readonly aria-describedby="customer_code_sm"
                                        value="<?php
                                        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                        $charactersLength = strlen($characters);
                                        $randomString = '';
                                        for ($i = 0; $i < 2; $i++) {
                                            $randomString .= $characters[rand(0, $charactersLength - 1)];
                                        }
                                        echo $randomString . '-10';
                                        ?>{{ $last_id->customer_id ?? 0 }}" type="text"
                                        id="customer_code" class="form-control @error('customer_code') is-invalid @enderror"
                                        name="customer_code" placeholder="Mijoz Kodini Kiriting...">
                                    @error('customer_code')
                                        <small id="customer_address_sm" class="form-text text-muted text-danger">
                                            {{ $message }}
                                        </small>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="offset-md-6"></div>
                            <div class="col-md-6 text-right">

                                <input type="submit" value="Tasdiqlash" class="btn btn-success">
                                <input type="reset" value="Bekor Qilish" class="btn btn-danger">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="content mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        @if ($message = Session::get('mess'))
                            <div class="alert alert-info alert-block text-center">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        @if ($message = Session::get('messd'))
                            <div class="alert alert-danger alert-block text-center">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <div class="card-header">
                            <h3 class="card-title">Mijozlar Ro'yxati</h3>
                        </div>
                        <div class="card-body">
                            <div id="customer_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="customers_table" class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th>№</th>
                                                    <th>Mijozni Ismi</th>
                                                    <th>Manzili</th>
                                                    <th>Telefon Raqami</th>
                                                    <th>Kodi</th>
                                                    <th>Amallar</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $a = 1; ?>
                                                @foreach ($customers as $customer)
                                                    <tr>
                                                        <td><?php echo $a; ?></td>
                                                        <td>{{ $customer->customer_name }}</td>
                                                        <td>{{ $customer->customer_address }}</td>
                                                        <td>{{ $customer->phone_number }}</td>
                                                        <td>{{ $customer->customer_code }}</td>
                                                        <td>
                                                            <a href="{{ route('admin.edit_customer', $customer->customer_id) }}"
                                                                class="btn btn-info"><i class="fas fa-pen"></i></a>
                                                            <button data-id="{{ $customer->customer_id }}" onclick="delete_confirm()"
                                                                class="del_custom btn btn-danger"><i class="fas fa-trash"></i></button>

                                                            {{-- <a href="{{ route('admin.customer_delete') }}"></a> --}}
                                                        </td>
                                                    </tr>
                                                    <?php $a++; ?>
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
        </div>

    </section>
@endsection
@section('script')
    <script>
        function delete_confirm()
        {
            var cust_ID = $(".del_custom").attr('data-id');
            // alert(cust_ID);
            Swal.fire({
                title: "Aniq O'chirasizmi ?",
                text: "Agar Tasdiqlasangiz Bu Mijoz O'chiriladi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tasdiqlash',
                cancelButtonText: 'Bekor Qilish'
            }).then((result) => {
                    if (result.isConfirmed)
                    {
                        var url ='{{ route("admin.delete_customer", ":id") }}';
                        url = url.replace(':id',cust_ID);
                        window.location.href = url;
                        Swal.fire({
                            icon: 'success',
                            title: "Mijoz O'chirildi!",
                            showConfirmButton: false,
                            timer: 1500
                        });



                    }
                })
        }
        $(document).ready(function() {


            $("#customers_table").DataTable({
                "responsive": true, "lengthChange": false, "autoWidth": false,
                "buttons": ["copy",  "excel", "pdf", "print"]
            }).buttons().container().appendTo('#customer_wrapper .col-md-6:eq(0)');

            $("#add_customer_blok").hide();
            $("#add_customer").click(function() {
                $("#add_customer_blok").toggle(1000);
            });
        });
    </script>
@endsection
