@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title', 'Branches')

@section('content')
   <div class="row"></div>
    <section class="content mt-5">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <h3 class="card-title">Filial Qo'shish</h3>
                        </div>
                        <div class="col-lg-6">
                            <button id="add_branch" class="btn btn-info float-right"><i class="fa fa-plus"></i> &nbsp; Filial
                                Qo'shish</button>
                        </div>
                    </div>
                </div>
                <div class="card-body" id="add_branch_blok">
                    {{-- <strong>Filial Nomi</strong> --}}
                    <form action="{{ route('admin.add_branch_form') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Filial Nomi</button>
                                    </div>
                                    <input aria-describedby="branch_name_sm"  id="branch_name" onkeypress="clsAlphaNoOnly(event)" onpaste="return false;" required type="text" class="form-control @error('branch_name') is-invalid @enderror" name="branch_name" placeholder="Filial Nomini Kirting...">
                                    @error('branch_name')
                                        <small id="branch_name_sm" class="form-text text-muted text-danger">
                                            {{ $message }}
                                        </small>
                                     @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-success">Filial Manzili</button>
                                    </div>
                                    <input aria-describedby="branch_address_sm" type="text" id="branch_address" class="form-control @error('branch_address') is-invalid @enderror" name="branch_address" placeholder="Filial Manzilini Kiriting...">
                                    @error('branch_address')
                                        <small id="branch_address_sm" class="form-text text-muted text-danger">
                                            {{ $message }}
                                        </small>
                                     @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-info">Telefon Raqami</button>
                                    </div>
                                    <input aria-describedby="branch_phone_sm" type="text" class="form-control @error('branch_phone') is-invalid @enderror" name="branch_phone" placeholder="Telefon Raqamini Kiriting...">
                                    @error('branch_phone')
                                        <small id="branch_phone_sm" class="form-text text-muted text-danger">
                                            {{ $message }}
                                        </small>
                                     @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <button type="button" class="btn btn-success">Jadvali Nomi</button>
                                    </div>
                                    <input aria-describedby="table_name_sm" readonly id="table_name" type="text" class="form-control @error('table_name') is-invalid @enderror" name="table_name" placeholder="Jadval Nomini Kiriting...">

                                     @error('table_name')
                                        <small id="table_name_sm" class="form-text text-muted text-danger">
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
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Filillar Ro'yxati</h3>
                        </div>

                        <div class="card-body">
                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable dtr-inline"
                                            aria-describedby="example1_info">
                                            <thead>
                                                <tr>
                                                    <th class="sorting sorting_asc" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1" aria-sort="ascending"
                                                        aria-label="Rendering engine: activate to sort column descending">
                                                        Rendering engine</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Browser: activate to sort column ascending">Browser</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Platform(s): activate to sort column ascending">
                                                        Platform(s)</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="Engine version: activate to sort column ascending">
                                                        Engine version</th>
                                                    <th class="sorting" tabindex="0" aria-controls="example1"
                                                        rowspan="1" colspan="1"
                                                        aria-label="CSS grade: activate to sort column ascending">CSS grade
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="odd">
                                                    <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                                                    <td>Firefox 1.0</td>
                                                    <td>Win 98+ / OSX.2+</td>
                                                    <td>1.7</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                                                    <td>Firefox 1.5</td>
                                                    <td>Win 98+ / OSX.2+</td>
                                                    <td>1.8</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="odd">
                                                    <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                                                    <td>Firefox 2.0</td>
                                                    <td>Win 98+ / OSX.2+</td>
                                                    <td>1.8</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                                                    <td>Firefox 3.0</td>
                                                    <td>Win 2k+ / OSX.3+</td>
                                                    <td>1.9</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="odd">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Camino 1.0</td>
                                                    <td>OSX.2+</td>
                                                    <td>1.8</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Camino 1.5</td>
                                                    <td>OSX.3+</td>
                                                    <td>1.8</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="odd">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Netscape 7.2</td>
                                                    <td>Win 95+ / Mac OS 8.6-9.2</td>
                                                    <td>1.7</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Netscape Browser 8</td>
                                                    <td>Win 98SE+</td>
                                                    <td>1.7</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="odd">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Netscape Navigator 9</td>
                                                    <td>Win 98+ / OSX.2+</td>
                                                    <td>1.8</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Mozilla 1.0</td>
                                                    <td>Win 95+ / OSX.1+</td>
                                                    <td>1</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                                                    <td>Firefox 3.0</td>
                                                    <td>Win 2k+ / OSX.3+</td>
                                                    <td>1.9</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="odd">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Camino 1.0</td>
                                                    <td>OSX.2+</td>
                                                    <td>1.8</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Camino 1.5</td>
                                                    <td>OSX.3+</td>
                                                    <td>1.8</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="odd">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Netscape 7.2</td>
                                                    <td>Win 95+ / Mac OS 8.6-9.2</td>
                                                    <td>1.7</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Netscape Browser 8</td>
                                                    <td>Win 98SE+</td>
                                                    <td>1.7</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="odd">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Netscape Navigator 9</td>
                                                    <td>Win 98+ / OSX.2+</td>
                                                    <td>1.8</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Mozilla 1.0</td>
                                                    <td>Win 95+ / OSX.1+</td>
                                                    <td>1</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                                                    <td>Firefox 3.0</td>
                                                    <td>Win 2k+ / OSX.3+</td>
                                                    <td>1.9</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="odd">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Camino 1.0</td>
                                                    <td>OSX.2+</td>
                                                    <td>1.8</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Camino 1.5</td>
                                                    <td>OSX.3+</td>
                                                    <td>1.8</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="odd">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Netscape 7.2</td>
                                                    <td>Win 95+ / Mac OS 8.6-9.2</td>
                                                    <td>1.7</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Netscape Browser 8</td>
                                                    <td>Win 98SE+</td>
                                                    <td>1.7</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="odd">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Netscape Navigator 9</td>
                                                    <td>Win 98+ / OSX.2+</td>
                                                    <td>1.8</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Mozilla 1.0</td>
                                                    <td>Win 95+ / OSX.1+</td>
                                                    <td>1</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="dtr-control sorting_1" tabindex="0">Gecko</td>
                                                    <td>Firefox 3.0</td>
                                                    <td>Win 2k+ / OSX.3+</td>
                                                    <td>1.9</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="odd">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Camino 1.0</td>
                                                    <td>OSX.2+</td>
                                                    <td>1.8</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Camino 1.5</td>
                                                    <td>OSX.3+</td>
                                                    <td>1.8</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="odd">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Netscape 7.2</td>
                                                    <td>Win 95+ / Mac OS 8.6-9.2</td>
                                                    <td>1.7</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Netscape Browser 8</td>
                                                    <td>Win 98SE+</td>
                                                    <td>1.7</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="odd">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Netscape Navigator 9</td>
                                                    <td>Win 98+ / OSX.2+</td>
                                                    <td>1.8</td>
                                                    <td>A</td>
                                                </tr>
                                                <tr class="even">
                                                    <td class="sorting_1 dtr-control">Gecko</td>
                                                    <td>Mozilla 1.0</td>
                                                    <td>Win 95+ / OSX.1+</td>
                                                    <td>1</td>
                                                    <td>A</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th rowspan="1" colspan="1">Rendering engine</th>
                                                    <th rowspan="1" colspan="1">Browser</th>
                                                    <th rowspan="1" colspan="1">Platform(s)</th>
                                                    <th rowspan="1" colspan="1">Engine version</th>
                                                    <th rowspan="1" colspan="1">CSS grade</th>
                                                </tr>
                                            </tfoot>
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
    <script src="{{ URL::to('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::to('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::to('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ URL::to('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::to('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ URL::to('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ URL::to('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ URL::to('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ URL::to('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ URL::to('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ URL::to('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ URL::to('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $("#add_branch_blok").hide();
            $("#add_branch").click(function (e) {
                e.preventDefault();
                $("#add_branch_blok").toggle();
            });

            $("#branch_name").blur(function (e) {
                e.preventDefault();
               let name = $("#branch_name").val().toLocaleLowerCase();
            //    let name_for = "";
             arr_name = '';
                for (let index = 0; index < name.length; index++) {
                    // const element = array[index];

                        if(name[index] !== ' ')
                        {
                            arr_name+=name[index];

                        }


                }
                // console.log(arr_name);
                $("#table_name").val(arr_name+'_products');
            });
        });
        function clsAlphaNoOnly (e)
        {  // Accept only alpha numerics, no special characters
                var regex = new RegExp("^[a-zA-Z0-9 ]+$");
                var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                if (regex.test(str)) {
                    return true;
                }
                e.preventDefault();
                return false;
        }
    </script>
@endsection
