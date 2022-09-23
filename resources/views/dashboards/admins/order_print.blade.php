@extends('dashboards.admins.layouts.admin-dash-layout')
@section('title','Profile')

@section('content')


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Bosh Sahifa</a></li>
              <li class="breadcrumb-item active">Buyurtma</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
          <div class="row no-print  mb-3">
              <div class="col-12 text-right">
                  <a id="print_pdf" type="button" target="_blank" class="btn btn-warning "><i class="fas fa-print"></i> Print</a>
                  {{--                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">--}}
                  {{--                    <i class="fas fa-print"></i> Print--}}
                  {{--                  </button>--}}
              </div>
          </div>
        <div class="row">
          <div class="col-12" >
{{--            <div class="callout callout-info">--}}
{{--              <h5><i class="fas fa-info"></i> Izox:</h5>--}}
{{--              Bu sahifa chop etish uchun kengaytirilgan. Tekshirish uchun hisob-fakturaning pastki qismidagi chop etish tugmasini bosing.--}}
{{--            </div>--}}


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row" style="border: 2px solid blue;">
                <div class="col-12 text-center">
                  <h4>
{{--                    <i class="fas fa-globe"></i>--}}
                      <img  width="50%" src="{{URL::to('/img/logo1.png')}}">
{{--                    <small class="float-right">Buyurtma Sanasi: <b>2/10/2014</b></small>--}}
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info mb-3" style="margin-top: 60px; border: 2px solid blue;">
                <div class="col-sm-4 invoice-col">
                  <address>
                    <strong>Biz Bilan Bog'lanish:</strong><br>
                      <b>Manzil:</b> Farg'ona Viloyati<br>
                    Buvayda Tumani, Alqor Qishlog'i<br>
                      <b>Telefonlarimiz:</b> (95) 056-40-90<br>
                      <b>Telegram Manzilimiz:</b> @redmarkuz
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">

                  <address>
{{--                    {{ dd($order_products[0]) }}--}}
                    <strong>Mijoz:</strong><br>
                      <b>FISH: </b>{{$order_products[0]->customer_name}} <br>
                      <b>Manzil: </b>{{$order_products[0]->customer_address}}<br>
                      <b>Telefoni: </b>{{$order_products[0]->phone_number}}<br>
                      <b>Kodi: </b>{{$order_products[0]->customer_code}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Buyurtma:</b><br>
                  Buyurtma №: <b>{{$order_products[0]->serial_number}}</b><br>
                  Buyurtma Sanasi: <b>{{$order_products[0]->created_at}}</b><br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-bordered">
                    <thead>
                    <tr>
                      <th>№</th>
                      <th>Maxsulot Nomi</th>
                      <th>Maxsulot Kodi</th>
                      <th>Maxsulot Miqdori #</th>
                      <th>Maxsulot Narxi</th>
                      <th>Jami Summa</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($order_products as $order_product)
                            <tr>
                                <td>{{ $a++ }}</td>
                                <td>{{ $order_product->product_name }}</td>
                                <td>{{ $order_product->barcode }}</td>
                                <td>{{ $order_product->ammount }}</td>
                                <td>{{ number_format($order_product->selling_price, 0, '.',' ') }}</td>
                                <td>{{ number_format($order_product->selling_price * $order_product->ammount,0,'.',' ') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                  <div class="col-6"></div>
                <!-- /.col -->
                <div class="col-6">
{{--                  <p class="lead">Jami</p>--}}

                  <div class="table-responsive mt-3">
                    <table class="table">

                      <tr>
                        <th style="width:50%">Jami Summa:</th>
                        <td class="text-bold" style="font-size: 18px;">{{ number_format($total_sum->total_sum,0,'.',' '); }} {!!  "<i>SO`M</i>" !!}</td>
                      </tr>
                      <tr>
                        <th>Jami Maxsulot Miqdori</th>
                        <td  class="text-bold" style="font-size: 18px;">{{ number_format($total_sum->total_amount,2,'.',' ' ) }}</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->

            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $("#print_pdf").click(function(){
                window.print();
            });
        });
    </script>
@endsection
