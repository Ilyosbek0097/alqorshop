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
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Izox:</h5>
              Bu sahifa chop etish uchun kengaytirilgan. Tekshirish uchun hisob-fakturaning pastki qismidagi chop etish tugmasini bosing.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> AlqorShop.uz
                    <small class="float-right">Buyurtma Sanasi: <b>2/10/2014</b></small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  <address>
                    <strong>Agent:</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (804) 123-5432<br>
                    Email: info@almasaeedstudio.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">

                  <address>

                    <strong>Mijoz:</strong><br>
                    795 Folsom Ave, Suite 600<br>
                    San Francisco, CA 94107<br>
                    Phone: (555) 539-1037<br>
                    Email: john.doe@example.com
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Buyurtma:</b><br>
                  Buyurtma №: <b>4F3S8J</b><br>
                  Buyurtma Sanasi: <b>2/22/2014</b><br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>№</th>
                      <th>Maxsulot Nomi</th>
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
                                <td>{{ $order_product->ammount }}</td>
                                <td>{{ number_format($order_product->selling_price, 0, '.',' ') }}</td>
                                <td>{{number_format($order_product->selling_price * $order_product->ammount,0,'.',' ') }}</td>
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
                  <p class="lead">Jami</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Jami Summa:</th>
                        <td>$250.30</td>
                      </tr>
                      <tr>
                        <th>Jami Maxsulot Miqdori</th>
                        <td>$10.34</td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                  <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-print"></i> Print
                  </button>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->



@endsection
