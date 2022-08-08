
@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title', 'Kirim Kassa')

@section('content')
    <div class="row"></div>
    <section class="content mt-2">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex p-0">
                    <h3 class="card-title p-3">Kassa Bo'limi</h3>
                    <ul class="nav nav-pills ml-auto p-2">
                        <li class="nav-item"><a class="nav-link active" href="#tabo_1" data-toggle="tab">Kirim
                                Qilish</a></li>
                        <li class="nav-item mr-3"><a class="nav-link " href="#tabo_2" data-toggle="tab">Chiqim
                                Qilish</a></li>
                        {{-- <li class="nav-item mr-3"><a class="nav-link" href="#tab_3" data-toggle="tab">Chiqimlar</a></li> --}}
                        <li class="nav-item">
                            <div class="card-tools text-right">
                                <button type="button" class="btn btn-primary" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </li>
                    </ul>
                </div>
                <div class="card-body">

                    @if ($message = Session::get('mess'))
                        <div class="alert alert-info alert-block text-center">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @if ($message = Session::get('err'))
                        <div class="alert alert-danger alert-block text-center">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabo_1">

                            @if ($message = Session::get('message'))
                                <div class="alert alert-success alert-block text-center">
                                    <button type="button" class="close text-danger" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            <form method="POST" action="{{ route('admin.debit_customer_form') }}">
                                @csrf
                                <div class="row">
                                    <div class="offset-md-3"></div>
                                    <div class="col-md-6">
                                        <h5 class="text-success text-center">Kirim Qilinyapti</h5>
                                        <div class="form-group">
                                            <label>Mijozni Tanlang</label>
                                            <select required name="customer_id" class="form-control select2" id="customer">
                                                <option value="">---Mijozni Tanlang---</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->customer_id }}">
                                                        {{ $customer->customer_name }}
                                                        -
                                                        {{ $customer->customer_address }} -
                                                        {{ $customer->phone_number }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Summani Kiriting</label>
                                            <input required type="number" name="summa" class="form-control">
                                            <small id="small_text" class=" pl-2">Mijoz Jami Qarzi: <span
                                                    id="text_debt" class="text-danger">125 000</span></small>
                                        </div>
                                        <div class="form-group">
                                            <label>Izox</label>
                                            <textarea type="text" name="comment" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group mt-5 text-right">
                                            <input type="submit" name="btn_confirm" value="Tasdiqlash"
                                                class="btn btn-success mr-3">
                                            <input type="reset" name="btn_reset" value="Bekor Qilish"
                                                class="btn btn-danger">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="tabo_2">

                            <form method="POST" action=" {{ route('admin.expense_form') }}">
                                @csrf
                                <div class="row">
                                    <div class="offset-md-3">
                                    </div>
                                    <div class="col-md-6 bg-secondary">
                                        <h5 class="text-warning text-center mt-2">Chiqim Qilinyapti</h5>
                                        <div class="form-group">
                                            <label>Kimga Berilyapti</label>
                                            <input required class="form-control" type="text" name="person">
                                        </div>
                                        <div class="form-group">
                                            <label>Summa</label>
                                            <input required class="form-control" type="number" name="summa">
                                        </div>
                                        <div class="form-group">
                                            <label>Izox</label>
                                            <textarea type="text" name="comment" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group mt-5 text-right">
                                            <input type="submit" name="btn_confirm" value="Tasdiqlash"
                                                class="btn btn-success mr-3">
                                            <input type="reset" name="btn_reset" value="Bekor Qilish"
                                                class="btn btn-danger">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="content mt-0">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex p-0">
                    <h3 class="card-title p-3">Kassa Malumotlari</h3>
                    <ul class="nav nav-pills ml-auto p-2">
                        <li class="nav-item"><a class="nav-link active" href="#tab_1" data-toggle="tab">Barchasi</a>
                        </li>
                        <li class="nav-item"><a class="nav-link " href="#tab_2" data-toggle="tab">Qarzdorlar</a>
                        </li>
                        <li class="nav-item mr-3"><a class="nav-link" href="#tab_3" data-toggle="tab">Chiqimlar</a>
                        </li>
                        <li class="nav-item">
                            <div class="card-tools text-right">
                                <button type="button" class="btn btn-primary" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </li>
                    </ul>
                </div>
                <div class="card-body">

                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1">
                            <table id="debit_table" class="table table-bordred text-sm">
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Statusi</th>
                                        <th>Fish</th>
                                        <th>Manzili</th>
                                        <th>Telefoni</th>
                                        <th>Summasi</th>
                                        <th>Izoxi</th>
                                        <th>O'chirish</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $a = 1;
                                    @endphp
                                    @foreach ($income_expenses as $inc_exp)
                                        <tr>
                                            <td>{{ $a }}</td>
                                            <td>
                                                @if ($inc_exp->status == 1 && $inc_exp->tip == 0)
                                                    <span class="badge badge-success">Kirim</span>
                                                @else
                                                    <span class="badge badge-danger">Chiqim</span>
                                                @endif

                                            </td>
                                            <td>{{ $inc_exp->customer_name ?? '-' }}</td>
                                            <td>{{ $inc_exp->customer_address ?? '-'  }}</td>
                                            <td>{{ $inc_exp->phone_number ?? '-' }}</td>
                                            <td>{{ $inc_exp->summa }}</td>
                                            <td>
                                                @if ($inc_exp->comment == '01')
                                                    {{ $inc_exp->order_number }}-{{ 'buyurtma' }}
                                                @else
                                                    {{ $inc_exp->comment }}
                                                @endif

                                            </td>
                                            <td>
                                                <button onclick="delete_confirm({{ $inc_exp->income_expene_id }})"
                                                    class="btn btn-info btn-sm"> <i class="fa fa-print"></i></button>
                                                <button onclick="delete_confirm({{ $inc_exp->income_expene_id }})"
                                                    class="btn btn-danger btn-sm"> <i class="fa fa-trash"></i></button>
                                            </td>

                                        </tr>
                                        @php
                                            $a++;
                                        @endphp
                                    @endforeach


                                </tbody>
                                <tfoot>

                                </tfoot>
                            </table>
                        </div>

                        <div class="tab-pane" id="tab_2">

                            <table id="expenses_table" class="table table-bordred" >
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Ismi</th>
                                        <th>Manzili</th>
                                        <th>Telefoni</th>
                                        <th>Jami Qarzi</th>
                                        <th>Holati</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($income as $inc)
                                    {{-- $expense[$k]->customer_id == $inc->customer_id --}}
                                        @if (true)

                                            <tr>
                                                <td>{{ 1 }}</td>
                                                <td>{{ $inc->customer_name }}</td>
                                                <td>{{ $inc->customer_address }}</td>
                                                <td>{{ $inc->phone_number }}</td>
                                                <td>
                                                    {{-- @if ($inc->kirim - $expense[$k]->chiqim >= 0)
                                                        <p class="text-success">+{{ number_format($inc->kirim - $expense[$k]->chiqim, 0,'.', ' ')  }}</p>
                                                    @else
                                                        <p class="text-danger">{{ number_format($inc->kirim - $expense[$k]->chiqim, 0,'.', ' ')  }}</p>
                                                    @endif --}}
                                                </td>
                                                <td>
                                                    <span class="badge badge-danger">Qarzdor</span>
                                                </td>
                                            </tr>
                                        @else
                                        <tr>
                                            <td>{{ 1 }}</td>
                                            <td>{{ $inc->customer_name }}</td>
                                            <td>{{ $inc->customer_address }}</td>
                                            <td>{{ $inc->phone_number }}</td>
                                            <td>
                                                <p class="text-danger">-{{ number_format($inc->kirim, 0,'.', ' ')  }}</p>
                                            </td>
                                            <td>
                                                <span class="badge badge-danger">Qarzdor</span>
                                            </td>
                                        </tr>
                                        @endif
                                 @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" id="tab_3">
                            <table id="costs_table" class="table table-bordred">
                                <thead>
                                    <tr>
                                        <th>№</th>
                                        <th>Sanasi</th>
                                        <th>Summasi</th>
                                        <th>Sababi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $a=1;
                                    @endphp
                                    @foreach ($income_expenses as $k=>$inc_expe)
                                        @if ($inc_expe->status == 1 && $inc_expe->tip == 1)
                                            <tr>
                                                <td>
                                                    {{ $a }}
                                                </td>
                                                <td>
                                                    {{ $inc_expe->date }}
                                                </td>
                                                <td>
                                                    {{ $inc_expe->summa }}
                                                </td>
                                                <td>
                                                    {{ $inc_expe->comment }}
                                                </td>
                                            </tr>

                                        @php
                                            $a++;
                                        @endphp
                                        @endif
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
        $(document).ready(function() {

            $("#debit_table").DataTable({
                columnDefs: [{
                    orderable: false,
                    targets: 0
                }],
                order: [
                    [0, 'desc']
                ]
            });
            $("#expenses_table").DataTable({

            });

            $("#costs_table").DataTable({

            });
            $("#small_text").hide();
            $("#customer").change(function() {
                $.ajax({
                    type: "POST",
                    url: "{{ route('admin.customer_debt_ajax') }}",
                    data: {
                        'customer_id': $(this).val()
                    },
                    success: function(response) {
                        $("#small_text").show();
                        $("#text_debt").text(response);
                    }
                });
            });
        });
    </script>
@endsection
