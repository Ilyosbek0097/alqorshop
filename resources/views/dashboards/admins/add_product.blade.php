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
                            <form action="#">
                                <!-- your steps content here -->
                                <div id="datainfo-part" class="content" role="tabpanel"
                                    aria-labelledby="datainfo-part-trigger">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="add_date">Tovar Qo'shilayotgan Sana</label>
                                                <input type="date" class="form-control" id="add_date"
                                                    placeholder="31.12.9999" name="add_date">
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
                                    <button type="button" class="btn btn-primary"
                                        onclick="stepper.next()">Keyingisi</button>
                                </div>
                                {{-- addproduct part content --}}
                                <div id="addproduct-part" class="content" role="tabpanel"
                                    aria-labelledby="addproduct-part-trigger">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="modal fade" id="modal-lg" aria-hidden="true" style="display: none;">
                                                <div class="modal-dialog modal-lg">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title text-md">Yangi Tovar Qo'shish</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <strong>Tovar Turi</strong>
                                                                    <div class="input-group mb-3">
                                                                        <span class="input-group-append">
                                                                            <button id="add_input" type="button" class="btn btn-info btn-flat ml-1" style="height: 90%; border-radius: 2px; text-center"><i class="text-md nav-icon fas fa-plus-circle pb-2"></i></button>
                                                                        </span>
                                                                        <select class="form-control select2" style="width: 80%;" id="product_type">
                                                                                <option selected="selected" value="">-------Turni Tanlang-------</option>
                                                                            @foreach ($product_types as $product_type )
                                                                                <option  value="{{ $product_type->type_id }}">{{ $product_type->type_name }}</option>
                                                                            @endforeach
                                                                          </select>

                                                                    </div>
                                                                </div>
                                                                <div id="block_type" class="col-md-6 d-none" >
                                                                    <strong>Yangi Turi</strong>
                                                                    <div class="input-group mb-3">
                                                                        <input id="new_type" type="text" class="form-control" name="new_type" placeholder="Yangi Turni Kiriting...">

                                                                    </div>
                                                                </div>
                                                                <div id="block_brend" class="col-md-6">
                                                                    <strong>Tovar Brendi Va Nomi</strong>
                                                                    <div class="input-group mb-3">
                                                                        <input id="product_brend" type="text" class="form-control" placeholder="Tovar Brendi Va Nomini Kiritning..." name="product_brend">
                                                                    </div>
                                                                </div>
                                                                <div id="block_artikl" class="col-md-6">
                                                                    <strong>Tovarning Eski Kodi</strong>
                                                                    <div class="input-group mb-3">
                                                                        <input id="old_code" type="text" class="form-control" placeholder="Tovarning Eski Kodini Kiriting..." name="old_code">
                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <div class="modal-footer justify-content-between">
                                                            <button id="modal_cancel" type="button" class="btn btn-danger"
                                                                data-dismiss="modal">Chiqish</button>
                                                            <button id="modal_submit" type="button" class="btn btn-primary">Saqlash</button>
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
                                                            <button type="button" class="btn btn-warning" data-toggle="modal"
                                                                data-target="#modal-lg">
                                                                <i class="nav-icon fas fa-plus mr-2"></i> Yangi Nom Qo'shish
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- /.card-header -->
                                                <div class="card-body">
                                                  <table id="example1" class="table table-bordered table-striped">
                                                    <thead>
                                                    <tr>
                                                      <th>Rendering engine</th>
                                                      <th>Browser</th>
                                                      <th>Platform(s)</th>
                                                      <th>Engine version</th>
                                                      <th>CSS grade</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                      <td>Trident</td>
                                                      <td>Internet
                                                        Explorer 4.0
                                                      </td>
                                                      <td>Win 95+</td>
                                                      <td> 4</td>
                                                      <td>X</td>
                                                    </tr>
                                                    <tr>
                                                      <td>Misc</td>
                                                      <td>NetFront 3.4</td>
                                                      <td>Embedded devices</td>
                                                      <td>-</td>
                                                      <td>A</td>
                                                    </tr>
                                                    <tr>
                                                      <td>Misc</td>
                                                      <td>Dillo 0.8</td>
                                                      <td>Embedded devices</td>
                                                      <td>-</td>
                                                      <td>X</td>
                                                    </tr>
                                                    <tr>
                                                      <td>Misc</td>
                                                      <td>Links</td>
                                                      <td>Text only</td>
                                                      <td>-</td>
                                                      <td>X</td>
                                                    </tr>
                                                    <tr>
                                                      <td>Misc</td>
                                                      <td>Lynx</td>
                                                      <td>Text only</td>
                                                      <td>-</td>
                                                      <td>X</td>
                                                    </tr>
                                                    <tr>
                                                      <td>Misc</td>
                                                      <td>IE Mobile</td>
                                                      <td>Windows Mobile 6</td>
                                                      <td>-</td>
                                                      <td>C</td>
                                                    </tr>
                                                    <tr>
                                                      <td>Misc</td>
                                                      <td>PSP browser</td>
                                                      <td>PSP</td>
                                                      <td>-</td>
                                                      <td>C</td>
                                                    </tr>
                                                    <tr>
                                                      <td>Other browsers</td>
                                                      <td>All others</td>
                                                      <td>-</td>
                                                      <td>-</td>
                                                      <td>U</td>
                                                    </tr>
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                      <th>Rendering engine</th>
                                                      <th>Browser</th>
                                                      <th>Platform(s)</th>
                                                      <th>Engine version</th>
                                                      <th>CSS grade</th>
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
                                    <button type="button" class="btn btn-primary"
                                        onclick="stepper.next()">Keyingisi</button>
                                </div>
                                <div id="information-part" class="content" role="tabpanel"
                                    aria-labelledby="information-part-trigger">
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
                                    <button type="button" class="btn btn-outline-primary mr-2"
                                        onclick="stepper.previous()">Avvalgisi</button>
                                    <button type="submit" class="btn btn-success">Tasdiqlash</button>
                                </div>
                            </form>
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

@endsection
@section('script')
   <script>
        $(document).ready(function(){
            $("#add_input").click(function(){
                d_none()
            });
            function d_none()
            {
                var class_name = $("#block_type").attr('class');
                // console.log(class_name);
                if(class_name.indexOf('d-none') == -1)
                {
                    $("#block_type").addClass('d-none');
                    $('#product_type').attr('disabled', false);
                }
                else
                {
                    $('#block_type').removeClass('d-none');
                    $("#product_type").prop('selectedIndex', 0).change();
                    $('#product_type').attr('disabled', true);
                    $("#new_type").focus();
                }
            }
            // Type Add Ajax Sellect Option

            // Modal Clear Input Function
            function clear_input()
            {
                $("#new_type").val('');
                $("#product_brend").val('');
                $("#old_code").val('');
            }
            // Modal Cancel Button Click
            $("#modal_cancel").click(function(){
                clear_input();
                var class_name = $("#block_type").attr('class');
                if(class_name.indexOf('d-none') == -1)
                {
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

            // Modal
            $("#modal_submit").click(function(){
               var product_type = $("#product_type").val();
               var product_brend = $("#product_brend").val();
               var new_type = $("#new_type").val();
               var old_code = $("#old_code").val();
               if(product_type == "" && product_brend != "" && new_type !="")
               {
                   $.ajax({
                       type: "POST",
                       url: "{{ route('admin.add_type_brend_ajax') }}",
                       data: {
                           'new_type': new_type,
                           'product_brend': product_brend,
                           'old_code': old_code
                        },
                       success: function (response) {
                            // console.log(response);
                            if(response)
                            {
                                var type_id =  response.type_id;
                                var type_name = response.type_name;
                               $("#modal_cancel").click();


                               if ($('#product_type').find("option[value='" +type_id + "']").length)
                                {
                                    $('#product_type').val(type_id).trigger('change');
                                }
                                else
                                {
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
                                    })


                            }
                       }
                   });
               }
               else if(product_type != "" && product_brend != "" && new_type =="")
               {
                   $.ajax({
                       type: "POST",
                       url: "{{ route('admin.add_type_brend_ajax') }}",
                       data: {
                            // 'new_type': new_type,
                            'product_type': product_type,
                            'product_brend': product_brend,
                            'old_code': old_code
                       },
                       success: function (response) {
                        $("#modal_cancel").click();
                        Swal.fire({
                            icon: 'success',
                            title: "Ma'lumotlar Bazaga Kiritildi!",
                            showConfirmButton: false,
                            timer: 1500
                        })
                       }
                   });
               }
               else
               {
                    alert('xatolik');
               }
            });
        })
   </script>
@endsection
