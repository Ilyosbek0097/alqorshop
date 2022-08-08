@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title', 'Settings')

@section('content')

    <div class="row m-2">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Tovar Qo'shish</h3>
                </div>
                <div class="card-body p-0">
                    <div class="bs-stepper">
                        <div class="bs-stepper-header" role="tablist">
                            <!-- your steps here -->
                            <div class="step" data-target="#datainfo-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="datainfo-part"
                                    id="datainfo-part-trigger">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label">Yuk Malumotlari</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#addproduct-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="addproduct-part"
                                    id="addproduct-part-trigger">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label">Tovar Qo'shish</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#information-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="information-part"
                                    id="information-part-trigger">
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label">Tekshiruv</span>
                                </button>

                            </div>
                        </div>
                        <div class="bs-stepper-content">
                                <!-- your steps content here -->
                                <div id="datainfo-part" class="content" role="tabpanel"
                                    aria-labelledby="datainfo-part-trigger">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="add_date">Tovar Qo'shilayotgan Sana</label>
                                                <input type="date" class="form-control" id="add_date" name="add_date">
                                                <input type="hidden" name="invoice"
                                                    value="{{ ($latest_invoice == "") ? 0 : $latest_invoice->invoice_order+1}}" id="latest_invoice">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="supplier">Qayerdan Kelyapti</label>
                                                <input type="text" class="form-control" id="supplier"
                                                    placeholder="Qayerdan Kelayotganini Kiriting...">
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" id="next_1" class="btn btn-primary">Keyingisi</button>
                                </div>
                                {{-- addproduct part content --}}
                                <div id="addproduct-part" class="content" role="tabpanel"
                                    aria-labelledby="addproduct-part-trigger">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="modal fade" id="modal-lg" aria-hidden="true"
                                                style="display: none;">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title text-md">Yangi Tovar Nomini Qo'shish</h4>
                                                            <button type="button" class="close"
                                                                data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <strong>Tovar Turi</strong>
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-append">
                                                                            <button id="add_input" type="button"
                                                                                class="btn btn-info btn-flat ml-1"
                                                                                style="height: 90%; border-radius: 2px; text-center"><i
                                                                                    class="text-md nav-icon fas fa-plus-circle pb-2"></i></button>
                                                                        </span>
                                                                        <select class="form-control select2"
                                                                            style="width: 80%;" id="product_type">
                                                                            <option selected="selected" value="">
                                                                                -------Turni Tanlang-------</option>
                                                                            @foreach ($product_types as $product_type)
                                                                                <option
                                                                                    value="{{ $product_type->type_id }}">
                                                                                    {{ $product_type->type_name }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>

                                                                    </div>
                                                                </div>
                                                                <div id="block_type" class="col-md-6 d-none">
                                                                    <strong>Yangi Turi</strong>
                                                                    <div class="input-group mb-3">
                                                                        <input id="new_type" type="text"
                                                                            class="form-control" name="new_type"
                                                                            placeholder="Yangi Turni Kiriting...">

                                                                    </div>
                                                                </div>
                                                                <div class="w-100"></div>
                                                                <div id="block_brend" class="col-md-6">
                                                                    <strong>Tovar Brendi Va Nomi</strong>
                                                                    <div class="input-group mb-3">
                                                                        <input id="product_brend" type="text"
                                                                            class="form-control"
                                                                            placeholder="Tovar Brendi Va Nomini Kiritning..."
                                                                            name="product_brend">
                                                                    </div>
                                                                </div>
                                                                <div id="block_artikl" class="col-md-6">
                                                                    <strong>Tovarning Eski Kodi <i class="fa fa-barcode"></i></strong>
                                                                    <div class="input-group mb-3">
                                                                        <input id="old_code" type="text"
                                                                            class="form-control"
                                                                            placeholder="Tovarning Eski Kodini Kiriting..."
                                                                            name="old_code">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button id="modal_cancel" type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Chiqish</button>
                                                            <button id="modal_submit" type="button"
                                                                class="btn btn-primary">Saqlash</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mt-2">
                                            <div class="card ">
                                                <div class="card-header bg-primary">
                                                    <div class="row">
                                                        {{-- <div class="col-md-6">
                                                            <h3 class="card-title">Mavjud Tovarlar</h3>
                                                        </div> --}}
                                                        <div class="col-md-6">
                                                            <button type="button" class="btn btn-warning"
                                                                data-toggle="modal" data-target="#modal-lg">
                                                                <i class="nav-icon fas fa-plus mr-2"></i> Yangi Nom Qo'shish
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                {{-- id="example1" --}}
                                                <div class="card-body">
                                                    <table class="text-sm table table-bordered table-striped grid my_table"
                                                        style="
                                                                                margin: 0 auto;
                                                                                width: 100%;
                                                                                clear: both;
                                                                                border-collapse: collapse;
                                                                                /* table-layout: fixed; */
                                                                                word-wrap:break-word;
                                                                              ">
                                                        <thead>
                                                            <tr>
                                                                <th>№</th>
                                                                <th>Nomi</th>
                                                                <th>Eski Kodi</th>
                                                                <th>Shtrix Kodi</th>
                                                                <th>Miqdori</th>
                                                                <th>Kirim Dollarda</th>
                                                                <th>Kirim So'mda</th>
                                                                <th>Sotish Narxi</th>
                                                                <th>Amallar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <th>№</th>
                                                                <th>Nomi</th>
                                                                <th>Eski Kodi</th>
                                                                <th>Shtrix Kodi</th>
                                                                <th>Miqdori</th>
                                                                <th>Kirim Dollarda</th>
                                                                <th>Kirim So'mda</th>
                                                                <th>Sotish Narxi</th>
                                                                <th>Amallar</th>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                                <!-- /.card-body -->
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-outline-primary mr-2"
                                        onclick="stepper.previous()">Avvalgisi</button>
                                    <button id="tekshiruv_open_btn" type="button" class="btn btn-primary"
                                        onclick="stepper.next()">Keyingisi</button>
                                </div>
                                <div id="information-part" class="content" role="tabpanel"
                                    aria-labelledby="information-part-trigger">
                                    <div class="card-body">
                                        <button id="total" class="form-control btn btn-success">Jami Hisobni Ko'rish</button>
                                        <div class="row" id="total_block">
                                            <div class="col-md-3 text-center">
                                                <small class="text-md text-primary">
                                                    Jami Maxsulot Turi:
                                                </small><br>
                                                <b class="text-sm text-center text-success" id="count_product"></b>
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <small class="text-md text-primary">
                                                    Jami Maxsulot Miqdori:
                                                </small><br>
                                                <b class="text-sm text-center text-success" id="total_amount"></b>
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <small class="text-md text-primary">
                                                    Jami Dollarda:
                                                </small><br>
                                                <b class="text-sm text-center text-success" id="total_usd"></b>
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <small class="text-md text-primary">
                                                    Jami So`mda:
                                                </small><br>
                                                <b class="text-sm text-center text-success" id="total_uzs"></b>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body bg-light">
                                        <table class="text-sm table  table-striped table-bordered table-sm"
                                            id="tekshiruv_table" style="
                                                                    margin: 0 auto;
                                                                    width: 100%;
                                                                    clear: both;
                                                                    border-collapse: collapse;
                                                                    /* table-layout: fixed; */
                                                                    word-wrap:break-word;
                                                                  ">
                                            <thead class="thead-dark ">
                                                <tr style="font-size: 10px">
                                                    <th>№</th>
                                                    <th>Nomi</th>
                                                    <th>Eski Kodi</th>
                                                    <th>Shtrix Kodi</th>
                                                    <th>Miqdori</th>
                                                    <th>Kirim Dollarda</th>
                                                    <th>Kirim So'mda</th>
                                                    <th>Sotish Narxi</th>
                                                    <th>Sanasi</th>
                                                    <th>Qayerdan Kelayapti</th>
                                                    <th>Kirituvchi</th>
                                                    <th>Amallar</th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                            </tbody>
                                            <tfoot>
                                                <tr style="font-size: 10px;">
                                                    <th>№</th>
                                                    <th>Nomi</th>
                                                    <th>Eski Kodi</th>
                                                    <th>Shtrix Kodi</th>
                                                    <th>Miqdori</th>
                                                    <th>Kirim Dollarda</th>
                                                    <th>Kirim So'mda</th>
                                                    <th>Sotish Narxi</th>
                                                    <th>Sanasi</th>
                                                    <th>Qayerdan Kelayapti</th>
                                                    <th>Kirituvchi</th>
                                                    <th>Amallar</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                    <button type="button" class="btn btn-outline-primary mr-2"
                                        onclick="stepper.previous()">Avvalgisi</button>
                                    <button type="button" id="btn_submit"  class="btn btn-success">Tasdiqlash</button>
                                </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{-- Visit <a href="https://github.com/Johann-S/bs-stepper/#how-to-use-it">bs-stepper documentation</a> for more examples and information about the plugin. --}}
                </div>
            </div>
            <div class="modal fade" id="modal-product">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h4 class="modal-title">Tovar qo'shish</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 text-center   text-center mb-1">
                                    <small class="text-md text-primary">
                                        Tovar Nomi:
                                    </small><br>
                                    <b class="text-md text-warning" id="product_name"></b>

                                </div>
                                <div class="col-md-6  mb-3 text-left">
                                    <small class="text-md text-primary">
                                        <i class="text-md nav-icon fas fa-barcode"></i> Shtrix Kodi:
                                    </small><br>
                                    <b class="text-md text-warning" id="barcode"></b>
                                </div>
                                <div class="col-md-6 mb-3 text-right">
                                    <small class="text-md text-primary">
                                        Tovar Eski Kodi:
                                    </small><br>
                                    <b class="text-md text-warning" id="product_code"></b>
                                </div>
                                <div class="col-md-6  pb-1 mb-1">
                                    <small class="text-md text-primary">
                                        <i class="text-md nav-icon fas fa-money"></i> Kirim Narxi So'mda: <small
                                            class="text-sm text-warning" id="body_price_uzs"></small>
                                    </small><br>
                                    <input type="text" name="uzs" id="uzs" placeholder="So'mda Kiriting "
                                        class="form-control"
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                    <input type="hidden" id="all_product_id" name="all_product_id">
                                </div>
                                <div class="col-md-6    pb-1 mb-1">
                                    <small class="text-md text-primary">
                                        <i class="text-md nav-icon fas fa-money"></i> Kirim Narxi Do'llarda: <small
                                            class="text-sm text-warning" id="body_price_usd"></small>
                                    </small><br>
                                    <input type="text" name="usd" id="usd" placeholder="Dollarda Kiriting"
                                        class="form-control"
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                </div>
                                <div class="col-md-6    pb-1 mb-1">
                                    <small class="text-md text-primary">
                                        <i class="text-md nav-icon fas fa-money"></i> Miqdori: <small
                                            class="text-sm text-warning" id="product_amount"></small>
                                    </small><br>
                                    <input type="text" name="miqdori" id="miqdori" placeholder="Miqdorini Kriting"
                                        class="form-control"
                                        onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                                </div>
                                <div class="col-md-6  pb-1 mb-1">
                                    <small class="text-md text-primary">
                                        <i class="text-md nav-icon fas fa-money"></i> Sotish Narxi: <small
                                            class="text-sm text-warning" id="selling_price"></small>
                                    </small><br>
                                    <input type="text" onkeypress='return event.charCode >= 48 && event.charCode <= 57'
                                        name="sotish_narxi" id="sotish_narxi" placeholder="Sotish Narxini Kiriting...."
                                        class="form-control">
                                </div>
                                <div class="col-md-12  pb-1 mb-1">
                                    <small class="text-md text-primary">
                                        Izox:
                                    </small><br>
                                    <textarea name="izox" id="izox" cols="30" rows="2" class="form-control"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button id="modal_cancel_btn" type="button" class="btn btn-danger"
                                data-dismiss="modal">Chiqish</button>
                            <button type="button" class="btn btn-primary" id="modal_save_product">Saqlash</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'));
        });
        function clear_input_modal_2() {
            $("#uzs").val('');
            $("#usd").val('');
            $("#miqdori").val('');
            $("#all_product_id").val('');
            $("#sotish_narxi").val('');
            $("#izox").val('');

        }
        //******************************
        $(document).on('click','#btn_submit',function(e){
            e.preventDefault();
            $('#btn_submit').attr('disabled',true);
            var latest_invoice = $("#latest_invoice").val();

            Swal.fire({
                title: "Tasdiqlaysizmi?",
                text: "Agar Tasdiqlasangiz Barcha Maxsulotlar Bazaga Kiritiladi!",
                icon: 'success',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tasdiqlash',
                cancelButtonText: 'Bekor Qilish'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.form_send_ajax') }}",
                        data: {
                            'invoice_order': latest_invoice
                        },
                        success: function (response) {
                            // console.log(response);
                           if(response == 1)
                           {
                                Swal.fire({
                                    icon: 'success',
                                    title: "Ma'lumotlar Bazaga Kiritildi!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                window.location.reload(true);
                           }
                           else{
                                Swal.fire({
                                        icon: 'error',
                                        title: "Xatolik Sodir Bo'ldi!",
                                        text: "Balki Tovar Qo'shmagandirsiz!",
                                        showConfirmButton: false,
                                        timer: 1500
                                    });
                           }

                        $('#btn_submit').attr('disabled',false);
                        }

                    });

                }
            })
        });
        //******************************
        $(document).on('click', '.delete_btn', function() {
            var add_product_id = $(this).data('id');
            Swal.fire({
                title: "Aniq O'chirasizmi ?",
                text: "Agar Tasdiqlasangiz Bu Maxsulot O'chiriladi!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Tasdiqlash',
                cancelButtonText: 'Bekor Qilish'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.delete_add_product') }}",
                        data: {
                            'add_product_id': add_product_id
                        },
                        success: function(response) {
                            if (response == 1) {
                                Swal.fire({
                                    icon: 'success',
                                    title: "Maxsulot O'chirildi!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $("#tekshiruv_open_btn").click();
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: "Xatolik Sodir Bo'ldi!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $("#tekshiruv_open_btn").click();
                            }
                        }
                    });
                    $('#total').click();
                }
            })
            // console.log(add_product_id);

        });

        // Jami Hisobni Ko'rish
        // $(document).on('click','#total',function(){

        // })
        $(document).ready(function(){
            $('#total_block').hide();
            $("#total").click(function(){
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.total_invoice') }}",
                    data: {
                        'invoice_order': $("#latest_invoice").val()
                    },
                    success: function (response) {
                        var total_amount = response.total_amount;
                        $("#total_amount").text(total_amount);
                        var count_product = response.count_product;
                        $("#count_product").text(count_product);
                        var total_usd = response.total_usd;
                        $("#total_usd").text(total_usd + ' $');
                        var total_uzs = response.total_uzs;
                        $("#total_uzs").text(total_uzs + " SO`M");

                    }
                });
                $('#total_block').toggle(1000);
            });
        });

        $(document).on('click', '#tekshiruv_open_btn', function(e) {
            e.preventDefault();
            // +++++++++++++++++++
            var table_test = $('#tekshiruv_table').DataTable({
                processing: true,
                serverSide: true,
                destroy: true,
                ajax: {
                    url: "{{ route('admin.tekshiruv_add_product') }}",
                    data: function(data) {
                        data.params = {
                            invoice_order: $("#latest_invoice").val()
                        }
                    }
                },
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'product_code',
                        name: 'product_code'
                    },
                    {
                        data: 'barcode',
                        name: 'barcode'
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'body_price_usd',
                        name: 'body_price_usd'
                    },
                    {
                        data: 'body_price_uzs',
                        name: 'body_price_uzs'
                    },
                    {
                        data: 'selling_price',
                        name: 'selling_price'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'supplier',
                        name: 'supplier'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true
                    },
                ]
            });
            // +++++++++++++++++++

        });
        $(document).on('click', '#modal_cancel_btn', function(e) {
            e.preventDefault();
            clear_input_modal_2();
        })
        $(document).on('click', '.add_product_btn', function(e) {
            e.preventDefault();

            // Product Data Add Modal
            var row_id = $(this).data('id');
            $.ajax({
                type: "POST",
                url: "{{ route('admin.modal_data_add') }}",
                data: {
                    'id': row_id
                },
                success: function(response) {
                    if (response) {
                        // console.log(response);
                        var all_product_id = response.all_product_id;
                        $("#all_product_id").val(all_product_id);
                        var product_name = response.product_name;
                        $("#product_name").text(product_name);
                        var product_code = response.product_code;
                        $("#product_code").text(product_code);
                        var barcode = response.barcode;
                        $("#barcode").text(barcode);
                        var body_price_usd = response.body_price_usd;
                        if (body_price_usd == null) {
                            $("#body_price_usd").text('mavjud emas');
                        } else {
                            $("#body_price_usd").text($.number(body_price_usd, 0, '.', ' ') + ' $');
                        }

                        var body_price_uzs = response.body_price_uzs;
                        if (body_price_uzs == null) {
                            $("#body_price_uzs").text('mavjud emas');
                        } else {
                            $("#body_price_uzs").text($.number(body_price_uzs, 0, '.', ' ') + ' SO`M');
                        }

                        var product_amount = response.product_amount;
                        if (product_amount == null) {
                            $("#product_amount").text('mavjud emas');
                        } else {
                            $("#product_amount").text($.number(product_amount, 0, '.', ' '));
                        }

                        var selling_price = response.selling_price;
                        if (selling_price == null) {
                            $("#selling_price").text('mavjud emas');
                        } else {
                            $("#selling_price").text($.number(selling_price, 0, '.', ' '));
                        }



                        //    obj = jQuery.parseJSON(response);

                    }
                }

            });
        });
        // Modal Data Save
        $(document).on('click', '#modal_save_product', function(e) {
            e.preventDefault();

            var all_product_id = $("#all_product_id").val();

            var date = $("#add_date").val();
            var supplier = $("#supplier").val();
            var latest_invoice = $("#latest_invoice").val();

            var uzs = $("#uzs").val();
            var usd = $("#usd").val();
            var miqdori = $("#miqdori").val();
            var izox = $("#izox").val();
            var sotish_narxi = $("#sotish_narxi").val();


            if (all_product_id != "" && uzs != "" && usd != "" && miqdori != "" && sotish_narxi != "") {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.add_product_insert') }}",
                    data: {
                        'date': date,
                        'supplier': supplier,
                        'all_product_id': all_product_id,
                        'uzs': uzs,
                        'usd': usd,
                        'miqdori': miqdori,
                        'sotish_narxi': sotish_narxi,
                        'izox': izox,
                        'latest_invoice': latest_invoice
                    },
                    success: function(response) {
                        if (response == 1) {
                            Swal.fire({
                                icon: 'success',
                                title: "Ma'lumotlar Bazaga Kiritildi!",
                                showConfirmButton: false,
                                timer: 1500
                            });

                            $("#modal_cancel_btn").click();
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: "Xatolik Sodir Bo'ldi!",
                                showConfirmButton: false,
                                timer: 1500
                            });
                        }
                    }
                });
            } else {
                Swal.fire({
                    icon: 'warning',
                    title: "Bo'sh Maydonlarni To'ldiring!",
                    showConfirmButton: false,
                    timer: 1500
                });
            }


        });

        $(document).on('blur', '#uzs', function() {
            if ($(this).val() > 0) {
                $("#usd").val('0');
            }
        });
        $(document).on('blur', '#usd', function() {
            if ($(this).val() > 0) {
                $("#uzs").val('0');
            }
        });
        $(document).ready(function() {
            $("#next_1").click(function() {
                var add_date = $("#add_date").val();
                var supplier = $("#supplier").val();
                if (add_date == "" || supplier == "") {
                    Swal.fire({
                        icon: 'warning',
                        title: "Bo'sh Maydonlarni To'ldiring!",
                        showConfirmButton: false,
                        timer: 1500
                    })

                } else {
                    // onclick=""
                    stepper.next();
                }
            });

            $("#add_input").click(function() {
                d_none()
            });

            function d_none() {
                var class_name = $("#block_type").attr('class');
                // console.log(class_name);
                if (class_name.indexOf('d-none') == -1) {
                    $("#block_type").addClass('d-none');
                    $('#product_type').attr('disabled', false);
                } else {
                    $('#block_type').removeClass('d-none');
                    $("#product_type").prop('selectedIndex', 0).change();
                    $('#product_type').attr('disabled', true);
                    $("#new_type").focus();
                }
            }
            // Type Add Ajax Sellect Option

            // Modal Clear Input Function
            function clear_input() {
                $("#new_type").val('');
                $("#product_brend").val('');
                $("#old_code").val('');
            }
            // Modal Cancel Button Click
            $("#modal_cancel").click(function() {
                clear_input();
                var class_name = $("#block_type").attr('class');
                if (class_name.indexOf('d-none') == -1) {
                    $("#block_type").addClass('d-none');
                    $('#product_type').attr('disabled', false);
                }
                // else
                // {
                //     $('#block_type').removeClass('d-none');
                //     $("#product_type").prop('selectedIndex', 0).change();
                //     $('#product_type').attr('disabled', true);
                //     $("#new_type").focus();
                // }
            });
            var table = $('.my_table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.table_add_product') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'product_name',
                        name: 'product_name'
                    },
                    {
                        data: 'product_code',
                        name: 'product_code'
                    },
                    {
                        data: 'barcode',
                        name: 'barcode'
                    },
                    {
                        data: 'product_amount',
                        name: 'product_amount'
                    },
                    {
                        data: 'body_price_usd',
                        name: 'body_price_usd'
                    },
                    {
                        data: 'body_price_uzs',
                        name: 'body_price_uzs'
                    },
                    {
                        data: 'selling_price',
                        name: 'selling_price'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true,

                    }
                ]
            });
            // Modal
            $("#modal_submit").click(function() {
                var product_type = $("#product_type").val();
                var product_brend = $("#product_brend").val();
                var new_type = $("#new_type").val();
                var old_code = $("#old_code").val();
                if (product_type == "" && product_brend != "" && new_type != "") {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.add_type_brend_ajax') }}",
                        data: {
                            'new_type': new_type,
                            'product_brend': product_brend,
                            'old_code': old_code
                        },
                        success: function(response) {
                            // console.log(response);
                            if (response) {
                                var type_id = response.type_id;
                                var type_name = response.type_name;
                                $("#modal_cancel").click();


                                if ($('#product_type').find("option[value='" + type_id + "']")
                                    .length) {
                                    $('#product_type').val(type_id).trigger('change');
                                } else {
                                    // Create a DOM Option and pre-select by default
                                    var newOption = new Option(type_name, type_id, true, true);
                                    // Append it to the select
                                    $('#product_type').append(newOption).trigger('change');
                                }

                                Swal.fire({
                                    icon: 'success',
                                    title: "Ma'lumotlar Bazaga Kiritildi!",
                                    showConfirmButton: false,
                                    timer: 1500
                                });


                            }
                        }
                    });
                } else if (product_type != "" && product_brend != "" && new_type == "") {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.add_type_brend_ajax') }}",
                        data: {
                            // 'new_type': new_type,
                            'product_type': product_type,
                            'product_brend': product_brend,
                            'old_code': old_code
                        },
                        success: function(response) {
                            $("#modal_cancel").click();
                            Swal.fire({
                                icon: 'success',
                                title: "Ma'lumotlar Bazaga Kiritildi!",
                                showConfirmButton: false,
                                timer: 1500
                            });

                            // $('.my_table').DataTable().ajax.reload();
                            // window.LaravelDataTables[".my_table"].ajax.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: "Bo'sh Maydonlarni To'ldiring!",
                        showConfirmButton: false,
                        timer: 1500
                    })
                }

                table.ajax.reload();
            });




        })
    </script>
@endsection
