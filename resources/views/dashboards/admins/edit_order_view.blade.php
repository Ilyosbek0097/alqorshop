@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title', 'Profile')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Buyurtmani Tahrirlash</h1>
                    <small>Faqat Narxi O'zgartirish Mumkin</small>
                </div>
                <div class="col-sm-6 text-right ">
                    <form action="{{ route('admin.order_table_add') }}"
                        method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="hidden"
                                value="{{ $one_order_data->serial_number }}"
                                name="serial_number_input">
                            <button type="submit" class="btn btn-primary"><i
                                    class="fa fa-arrow-circle-left"></i> Ortga Qaytish</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <form action="{{ route('admin.edit_order_form')  }}" method="POST">
                                @method('PUT')
                                @csrf
                                {{-- {{ $one_order_data}} --}}
                                <div class="form-group">
                                    <label>Tovar Nomi</label>
                                    <input readonly type="text" class="form-control" value="{{ $one_order_data->product_name }}">
                                    <input readonly class="form-control" name="order_id" type="hidden" value="{{ $one_order_data->order_id }}">
                                </div>
                                <div class="form-group">
                                    <label>Tovar Miqdori</label>
                                    <input readonly name="ammount" class="form-control" type="text" value="{{ $one_order_data->ammount }}">
                                </div>
                                <div class="form-group">
                                    <label>Tovar Narxi</label>
                                    <input required name="selling_price" class="form-control" type="text" value="{{ $one_order_data->selling_price }}">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" value="Tasdiqlash">
                                    <input type="reset" class="btn btn-danger" value="Bekor Qilish">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
