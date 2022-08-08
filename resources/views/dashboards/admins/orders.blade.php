@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title', 'Dashboard')

@section('content')

    <div class="row m-1">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">Sotish Bo'limi</h3>
                </div>
                <div class="card-body p-0">
                    <div class="bs-stepper">
                        <div class="bs-stepper-header" role="tablist">
                            <!-- your steps here -->
                            <div class="step" data-target="#mijoz_info">
                                <button type="button" class="step-trigger" role="tab" aria-controls="mijoz_info"
                                    id="mijoz_info-trigger">
                                    <span class="bs-stepper-square">1</span>
                                    <span class="bs-stepper-label">Sotuv Ma'lumoti</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#product_add">
                                <button type="button" class="step-trigger" role="tab" aria-controls="product_add"
                                    id="product_add-trigger">
                                    <span class="bs-stepper-square">2</span>
                                    <span class="bs-stepper-label">Sotuv Ma'lumoti</span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#product_sale">
                                <button type="button" class="step-trigger" role="tab" aria-controls="product_sale"
                                    id="product_sale-trigger">
                                    <span class="bs-stepper-square">3</span>
                                    <span class="bs-stepper-label">Various information</span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content p-1">
                            <!-- your steps content here -->
                            <div id="mijoz_info" class="content" role="tabpanel"
                                aria-labelledby="mijoz_info-trigger">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group text-center">
                                            <label>Mijozni Tanlang</label>
                                            <select class="form-control select2" style="width: 100%;">
                                                @foreach ($customer as $custom)
                                                    <option value="{{ $custom->customer_id }}">
                                                        {{ $custom->customer_name }}------{{ $custom->customer_code }}------{{ $custom->customer_address }}------{{ $custom->phone_number }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <label>Buyurtma Sanasi:</label>
                                            <input type="date" class="form-control text-center" >
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group text-center">
                                            <label>Buyurtma Raqami</label>
                                            <input readonly type="text" class="form-control text-center" value="12545">
                                        </div>
                                    </div>
                                </div>


                                <button class="btn btn-primary float-right" onclick="stepper.next()">Keyingisi</button>
                            </div>
                            <div id="product_add" class="content" role="tabpanel"
                                aria-labelledby="product_add-trigger">
                                <table id="order_table" class="table no-footer dataTable dtr-inline">
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
                                            <th>Amal</th>
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
                                                <td rowspan="1" colspan="1">
                                                    <a type="button" data-toggle="modal" data-target="#order-product"
                                                        class="btn btn-primary order_add"
                                                        data-id="{{ $product->all_product_id }}"><i
                                                            class="nav-icon fas fa-plus-circle"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <button type="button" class="btn btn-primary float-right ml-3 mt-5"
                                    onclick="stepper.next()">Keyingisi</button>
                                <button class="btn btn-outline-primary float-right  mt-5"
                                    onclick="stepper.previous()">Avvalgisi</button>

                            </div>
                            <div id="product_sale" class="content" role="tabpanel"
                                aria-labelledby="product_sale-trigger">
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right ml-3">Tasdiqlash</button>
                                <button class="btn btn-outline-primary float-right "
                                    onclick="stepper.previous()">Avvalgisi</button>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                    {{-- Visit <a href="https://github.com/Johann-S/bs-stepper/#how-to-use-it">bs-stepper documentation</a> for more examples and information about the plugin. --}}
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
    <div class="modal fade" id="order-product">
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
                        <div class="col-md-12 mb-3 text-center   text-center mb-1 alert alert-light">
                            <small class="text-md text-primary">
                                Tovar Nomi:
                            </small><br>
                            <b class="text-md text-warning" id="product_name"></b>

                        </div>
                        <div class="col-md-6  mb-3 text-left alert alert-light text-center">
                            <small class="text-md text-primary">
                                <i class="text-md nav-icon fas fa-barcode"></i> Shtrix Kodi:
                            </small><br>
                            <b class="text-md text-warning" id="barcode"></b>
                        </div>
                        <div class="col-md-6 mb-3 text-right alert alert-light text-center">
                            <small class="text-md text-primary">
                                Tovar Eski Kodi:
                            </small><br>
                            <b class="text-md text-warning" id="product_code"></b>
                        </div>
                        <div class="col-md-6  pb-1 mb-4 alert alert-light text-center">
                            <small class="text-md text-primary">
                               Kirim Narxi So'mda:
                            </small><br>
                            <b class="text-md text-warning" id="body_price_uzs"></b>

                            <input  type="text" name="uzs" id="uzs" placeholder="So'mda Kiriting " class="form-control d-none"
                                onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                            <input type="hidden" id="all_product_id" name="all_product_id">
                        </div>
                        <div class="col-md-6 text-right   pb-1 mb-4 alert alert-light text-center">
                            <small class="text-md text-primary">
                                Kirim Narxi Dollarda:
                            </small><br>
                            <b class="text-md text-warning" id="body_price_usd"></b>

                            <input type="text" name="usd" id="usd" placeholder="Dollarda Kiriting" class="form-control d-none"
                                onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
                        </div>
                        <div class="col-md-6    pb-1 mb-4">
                            <small class="text-md text-primary">
                                <i class="text-md nav-icon fas fa-money"></i> Miqdori: <small class="text-sm text-warning"
                                    id="product_amount"></small>
                            </small><br>
                            <input type="text" name="miqdori" id="miqdori" placeholder="Miqdorini Kriting"
                                class="form-control" onkeypress='return event.charCode >= 48 && event.charCode <= 57'>
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
                    <button id="modal_cancel_btn" type="button" class="btn btn-danger" data-dismiss="modal">Chiqish</button>
                    <button type="button" class="btn btn-primary" id="modal_save_product">Saqlash</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            window.stepper = new Stepper(document.querySelector('.bs-stepper'))
        })
        $("#order_table").DataTable({});
        $(document).on('click', '.order_add', function() {
            // console.log($(this).data('id'));
            var product_id = $(this).data('id');
            $.ajax({
                    type: "POST",
                    url: "{{ route('admin.modal_data_add') }}",
                    data: {
                        'id': product_id
                    },
                    success: function(response) {
                        if (response)
                        {
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
                                $("#product_amount").text(product_amount);
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
        $(document).on('blur','#miqdori',function(){
            var miqdori = parseInt($(this).val());
            var max_miqdori = parseInt($('#product_amount').text());
            // console.log(miqdori+max_miqdori);
            if(miqdori > max_miqdori)
            {
                Swal.fire({
                    icon: 'error',
                    title: 'Xatolik...',
                    text: "Bazada Buncha Maxsulot Yo`q!",
                    showConfirmButton: false,
                    timer: 1500

                });
                $(this).focus();
                $(this).val('');
            }

            // alert('da');
        });
        
    </script>
@endsection
