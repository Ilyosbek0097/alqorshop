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
                                    <label>Bazadagi Tovarning Qolgan Miqdori</label>
                                    <input readonly type="text" class="form-control text-danger" value="{{ $one_order_data->product_amount }}" >
                                </div>
                                <div class="form-group">
                                    <label>Tovar Miqdori</label>
                                    <input required name="ammount" id="order_amount" step="0.01" class="form-control" type="number" value="{{ $one_order_data->ammount }}">
                                    <input type="hidden" id="base_amount" value="{{ $one_order_data->product_amount }}" >
                                </div>

                                <div class="form-group">
                                    <label>Tovar Narxi</label>
                                    <input id="price_selling" required name="selling_price" class="form-control" type="text" value="{{ $one_order_data->selling_price }}">
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
@section('script')
    <script>
        $(document).ready(function(){
            var base_amount = $('#base_amount').val();
            if(parseFloat(base_amount) <= 0)
            {
                Swal.fire({
                    icon: 'warning',
                    iconColor: 'red',
                    title: 'Diqqat!',
                    text: 'Bazada Bu Tovardan Qolmagan! Iltimos Ortga Qaytib Buyurtmadan Ushbu Maxsulotni O`chiring',
                    showConfirmButton: true,
                });
                $("#order_amount").prop('disabled', true);
                $("#price_selling").prop('disabled', true);
            }
            $(document).on('blur', '#order_amount', function(){
                var value = $(this).val();
                if(parseFloat(value) > 0)
                {
                    if(parseFloat(value) > parseFloat(base_amount) )
                    {
                        Swal.fire({
                            icon: 'warning',
                            title: 'Diqqat!',
                            text: 'Bazada Buncha Miqdor Qolmagan!',
                            showConfirmButton: false,
                            timer: 2500
                        })

                        $(this).val('');
                    }
                }
                else{
                    Swal.fire({
                        icon: 'error',
                        iconColor: 'red',
                        title: 'Diqqat!',
                        text: 'Miqdor Noto`g`ri Kiritildi!',
                        showConfirmButton: false,
                        timer: 2500
                    })
                    $(this).val('');
                }




            });
        });
    </script>
@endsection
