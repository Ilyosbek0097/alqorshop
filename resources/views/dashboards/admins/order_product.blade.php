@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title', 'Index')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-md-12">
                    @if ($message = Session::get('mess'))
                        <div class="alert alert-success alert-block text-center">
                            <button type="button" id="close_btn" class="close" data-dismiss="alert">×</button>
                                <strong><strong class="text-warning">{{ $last_order->serial_number }}</strong>-{{ $message }}</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <form action="{{ route('admin.order_form_product') }}" method="POST">
        @csrf
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Buyurtma Berish</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-primary" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-group text-center">
                                {{-- <label>Navbatdagi Buyurtma Raqami </label><br>
                                <small class="text-danger h4">{{ ($last_order == '')? 1 : $last_order->serial_number + 1  }}</small>
                                <input name="serial_number" type="hidden" value="{{ ($last_order == '')? 1 : $last_order->serial_number + 1  }}" class="form-control form-control-border" readonly> --}}
                            </div>
                            <div class="form-group">
                                <label for="customer">Mijozni Tanlash</label>
                                <select required name="customer" id="customer" class="form-control select2">
                                    <option value="">----Mijozni Tanlang-----</option>
                                    @foreach ($customers as $customer)
                                        <option value="{{ $customer->customer_id }}">{{ $customer->customer_name }} -
                                            {{ $customer->customer_address }} - {{ $customer->phone_number }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product">Maxsulot Tanlash</label>
                                <select  id="product" class="form-control select2">
                                    <option value="">-----------------</option>
                                    @foreach ($products as $product)
                                        <option value="{{ $product->product_id }}">
                                            {{ $product->barcode }}--{{ $product->product_name }}--({{ $product->product_amount }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                        <!-- /.card-body -->
                        <div class="card-footer">

                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- Default box -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Buyurtmalar</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-primary" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="order_product_table" class="table table-bordered table-light">
                                <thead class="text-center thead-dark">
                                    <tr style="font-size: 12px">
                                        <th>#</th>
                                        <th>Buyurtmadagi Tovarlar</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">

                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit">
                                Tasdiqlash
                            </button>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
    </form>
@endsection
@section('script')
    <script>
        $(document).ready(function() {
            $("#customer").change(function() {
                var customer = $(this).val();
                // console.log(customer);
            });
            $("#product").change(function() {
                var product_id = $(this).val();
                var order_number_str = $('tr  td:first').text() ? $('tr td:first').text() : '0';
                var order_number = parseInt(order_number_str);
                // alert(order_number);
                var customer = $("#customer").val();
                if(customer == "")
                {
                    Swal.fire({
                        icon: 'info',
                        title: "Siz Mijozni Tanlamadingiz!",
                        showConfirmButton: false,
                        timer: 2000
                    });
                    $("#product").prop('selectedIndex', 0);
                    return false;
                }
                var tekshiruv = 0;
                $("#order_product_table").find('tr').each(function() {
                    var attr_id = $(this).attr('id');
                    if ('qator_' + product_id == attr_id) {
                        tekshiruv++;
                    }
                });
                if (tekshiruv > 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: "Bu Maxsulot Avval Qo'shilgan!",
                        showConfirmButton: false,
                        timer: 2000
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.order_product_ajax') }}",
                        data: {
                            'product_id': product_id,
                            'order_number': order_number,

                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Yuklanmoqda...',
                                html: 'Iltimos Kuting...',
                                allowEscapeKey: false,
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading()
                                }
                            });
                        },
                        success: function(response) {
                            if (response) {
                                var name = response.one_product.product_name;
                                var amount = response.one_product.product_amount;
                                var selling_price = response.one_product.selling_price;
                                var all_product_id = response.one_product.all_product_id;

                                // if()
                                // {

                                // }
                                // console.log(response.one_product.product_name);
                                if (parseInt(amount) == 0) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: "Bu Maxsulot Bazada Qolmagan!",
                                        showConfirmButton: false,
                                        timer: 2000
                                    });
                                } else {

                                    $('#order_product_table tbody').prepend('<tr class="table-secondary text-center" data-id="' +
                                        product_id + '" id="qator_' + product_id + '">' +
                                        '<td>' + response.order_id + '</td>' +
                                        '<td>' +
                                        '<small style="font-size: 12px; color:green">Nomi:</small><br>' +
                                        '<i id="name_text">' + name + '</i><br>' +
                                        '<small style="font-size: 12px; color:green">Qoldig`i:</small><br>' +
                                    '<i id="amount_text_'+product_id+'">' + amount + '</i><br>' +
                                    '<small style="font-size: 12px; color:green">Summasi:</small><br>' +
                                    '<i id="price_text_'+product_id+'">' + selling_price + '</i><br>' +
                                    '<small style="font-size: 12px; color:green">Sotish Narxi:</small><br>' +
                                    '<input required name="sale_price[]" type="number" value="'+selling_price+'" class="form-control form-control-border sale_price" placeholder="Summasini Kiriting"><br>' +
                                    '<small style="font-size: 12px; color:green">Sotish Miqdori:</small><br>' +
                                    '<input name="product_id[]" type="hidden" value="'+product_id+'">'+
                                    '<input step="0.01" required name="sale_amount[]" type="number"  class="form-control form-control-border sale_amount" placeholder="Miqdorini Kiriting"><br>' +
                                    '<small style="font-size: 12px; color:green">Izox:</small><br>' +
                                    '<textarea class="form-control " name="order_comment[]"></textarea><br>'+
                                    '<small style="font-size: 12px; color:green">O`chirish:</small><br>' +
                                        '<button data-id="' + product_id +
                                        '" class=" btn btn-danger text-sm delete_row"><i class="fa fa-trash"></i></button>' +
                                        '</td>' +
                                        '</tr>');
                                    Swal.fire({
                                        icon: 'success',
                                        title: "Tovar qo'shildi",
                                        showConfirmButton: false,
                                        timer: 1000
                                    });
                                    $("#close_btn").click();
                                }

                            }
                        }
                    });
                }



            });
            // Delete Row Button
            // $(".delete_row").click(function(){
            //     var delete_id = $(this).data('id');
            //     console.log(delete_id);
            // });
            $("#customer").change(function(){
                $("#order_product_table tbody > tr").remove();
                // $("#product").prop('selectedIndex', 0);
            });
        });
        $(document).on('click', '.delete_row', function() {
            var delete_id = $(this).data('id');
            // console.log(delete_id);
            $("#qator_" + delete_id).remove();
            Swal.fire({
                icon: 'success',
                title:"Tovar O'chirildi",
                showConfirmButton:false,
                timer:1500
            })

        });
        $(document).on('blur','.sale_amount',function(){
            var amount = $(this);
            var sale_amount = parseFloat(amount.val());
            var row_id = amount.closest('tr').data('id');
            var base_amount = parseFloat($("#amount_text_"+row_id).text());
            if(sale_amount <= 0)
            {
                Swal.fire({
                    icon: 'info',
                    iconColor: 'red',
                    title: "Noto`g`ri Miqdor Kiritildi!",
                    showConfirmButton: false,
                    timer: 2000
                });
                amount.val('');
            }
            if(sale_amount > base_amount)
            {
                Swal.fire({
                            icon: 'info',
                            title: "Bazada Buncha Miqdor Qolmagan!",
                            showConfirmButton: false,
                            timer: 2000
                        });
                        amount.val('');
            }

        });
        $(document).on('blur','.sale_price', function(){
            var price = $(this);
            var sale_price = parseInt(price.val());
            var row_id2 = price.closest('tr').data('id');
            var base_price = parseInt($("#price_text_"+row_id2).text());
            // console.log(base_price);

            if(sale_price < base_price)
            {
                var farq = base_price-sale_price;
                Swal.fire({
                            icon: 'info',
                            title: "Maxsulotni "+farq+" SO`M Arzonga Sotayapsiz!",
                            showConfirmButton: false,
                            timer: 2000
                        });
                        // price.val('');
            }

        });


    </script>
@endsection
