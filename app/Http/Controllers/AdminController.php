<?php

namespace App\Http\Controllers;

use Auth;
use DataTables;
use App\Models\User;
use App\Models\Orders;
use App\Models\Branche;
use Barryvdh\DomPDF\PDF;
use App\Models\Customers;
use App\Models\AddProduct;
use App\Models\AllProduct;
use App\Models\TotalSales;
use App\Models\ProductType;
use App\Models\AlqorProduct;
use App\Models\ProductBrand;
use App\Models\SalesProcess;
use Illuminate\Http\Request;
use App\Models\IncomeExpenses;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
        public function index(){

            return view('dashboards.admins.index');
        }

        public function profile(){
            return view('dashboards.admins.profile');
        }
       public function settings(){
           return view('dashboards.admins.settings');
       }

       public function updateInfo(Request $request){

               $validator = \Validator::make($request->all(),[
                   'name'=>'required',
                   'email'=> 'required|email|unique:users,email,'.Auth::user()->id,
                   'favoritecolor'=>'required',
               ]);

               if(!$validator->passes()){
                   return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
               }else{
                    $query = User::find(Auth::user()->id)->update([
                         'name'=>$request->name,
                         'email'=>$request->email,
                         'favoriteColor'=>$request->favoritecolor,
                    ]);

                    if(!$query){
                        return response()->json(['status'=>0,'msg'=>'Something went wrong.']);
                    }else{
                        return response()->json(['status'=>1,'msg'=>'Your profile info has been update successfuly.']);
                    }
               }
       }

       public function updatePicture(Request $request){
           $path = 'users/images/';
           $file = $request->file('admin_image');
           $new_name = 'UIMG_'.date('Ymd').uniqid().'.jpg';

           //Upload new image
           $upload = $file->move(public_path($path), $new_name);

           if( !$upload ){
               return response()->json(['status'=>0,'msg'=>'Something went wrong, upload new picture failed.']);
           }else{
               //Get Old picture
               $oldPicture = User::find(Auth::user()->id)->getAttributes()['picture'];

               if( $oldPicture != '' ){
                   if( \File::exists(public_path($path.$oldPicture))){
                       \File::delete(public_path($path.$oldPicture));
                   }
               }

               //Update DB
               $update = User::find(Auth::user()->id)->update(['picture'=>$new_name]);

               if( !$upload ){
                   return response()->json(['status'=>0,'msg'=>'Something went wrong, updating picture in db failed.']);
               }else{
                   return response()->json(['status'=>1,'msg'=>'Your profile picture has been updated successfully']);
               }
           }
       }


       public function changePassword(Request $request){
           //Validate form
           $validator = \Validator::make($request->all(),[
               'oldpassword'=>[
                   'required', function($attribute, $value, $fail){
                       if( !\Hash::check($value, Auth::user()->password) ){
                           return $fail(__('The current password is incorrect'));
                       }
                   },
                   'min:8',
                   'max:30'
                ],
                'newpassword'=>'required|min:8|max:30',
                'cnewpassword'=>'required|same:newpassword'
            ],[
                'oldpassword.required'=>'Enter your current password',
                'oldpassword.min'=>'Old password must have atleast 8 characters',
                'oldpassword.max'=>'Old password must not be greater than 30 characters',
                'newpassword.required'=>'Enter new password',
                'newpassword.min'=>'New password must have atleast 8 characters',
                'newpassword.max'=>'New password must not be greater than 30 characters',
                'cnewpassword.required'=>'ReEnter your new password',
                'cnewpassword.same'=>'New password and Confirm new password must match'
            ]);

           if( !$validator->passes() ){
               return response()->json(['status'=>0,'error'=>$validator->errors()->toArray()]);
           }else{

            $update = User::find(Auth::user()->id)->update(['password'=>\Hash::make($request->newpassword)]);

            if( !$update ){
                return response()->json(['status'=>0,'msg'=>'Something went wrong, Failed to update password in db']);
            }else{
                return response()->json(['status'=>1,'msg'=>'Your password has been changed successfully']);
            }
           }
       }
       public function add_product()
       {
           $product_types = ProductType::all();
           $latest_invoice = AddProduct::latest('invoice_order')->first();

           return view('dashboards.admins.add_product', compact('product_types','latest_invoice'));
       }
       public function all_product()
       {
            $alqor_products = AlqorProduct::leftJoin('all_products','alqor_products.product_id','=','all_products.all_product_id')->get();

           return view('dashboards.admins.all_product', compact('alqor_products'));
       }
       public function branches()
       {
           return view('dashboards.admins.branches');
       }
       public function orders()
       {
           $customer = Customers::all();
           $alqor_products = AlqorProduct::leftJoin('all_products','alqor_products.product_id','=','all_products.all_product_id')->get();
           return view('dashboards.admins.orders',compact('customer','alqor_products'));
       }
       public function customers()
       {
           $last_id = Customers::latest('customer_id')->first();
           $customers = Customers::all();
           return view('dashboards.admins.customers', compact('last_id','customers'));
       }
    //    Order Product
       public function order_product()
       {
           $products = AlqorProduct::leftJoin('all_products','alqor_products.product_id','=','all_products.all_product_id')->get();
           $customers = Customers::all();
           $last_order = Orders::select('serial_number')->orderBy('order_id','DESC')->first();

           return view('dashboards.admins.order_product', compact('products','customers','last_order'));
       }
        public function add_customer_form(Request $request)
        {
            $customer = new Customers;
            $customer->customer_name = $request->customer_name;
            $customer->customer_address = $request->customer_address;
            $customer->phone_number = $request->customer_phone;
            $customer->customer_code = $request->customer_code;
            $customer->save();
            return redirect()->route('admin.customers');

        }
        public function edit_customer_form(Request $request)
        {
            $customer = Customers::where('customer_id','=',$request->customer_id)->first();
            // return $customer;
            $customer->customer_name = $request->customer_name;
            $customer->customer_address = $request->customer_address;
            $customer->phone_number = $request->customer_phone;
            $customer->customer_code = $request->customer_code;
            $customer->save();
            return redirect()->route('admin.customers')->with('mess',"Mijoz Ma'lumotlari Tahrirlandi!");
        }
        public function edit_customer($id)
        {
            $edit_customer = Customers::where('customer_id','=',$id)->first();
            return view('dashboards.admins.edit_customer', compact('edit_customer'));
        }
        public function delete_customer($id)
        {
            Customers::findOrFail($id)->delete();
            return redirect()->route('admin.customers')->with('messd',"Mijoz O'chirildi!");
        }
        //    Forma actionlari
        public function add_branch_form(Request $request)
        {
            $request->validate([
                'branch_name' => 'required|min:2|max:15',
                'branch_address' => 'required|min:2|max:100',
                'branch_phone' => 'required|min:5|max:15',
                'table_name' => 'required|min:5|max:50',
            ]);
            // Branche::insert($request->input());
            $branch_selects = Branche::all();
            foreach ($branch_selects as $branch_select) {
                if($branch_select->branch_name == $request->branch_name)
                {
                    return redirect()->route('admin.branches');
                }
            }


            $branch = new Branche();
            $branch->branch_name = $request->branch_name;
            $branch->address = $request->branch_address;
            $branch->phone = $request->branch_phone;
            $branch->table_name = $request->table_name;
            $branch->save();
            return redirect()->route('admin.branches');

        }

        public function add_type_brend_ajax(Request $request)
        {
            $product_type = $request->product_type;
            $new_type = $request->new_type;
            $product_brend = $request->product_brend;
            $product_code = $request->old_code;

            if(!$product_type && $new_type)
            {
                DB::beginTransaction();
                try{
                    // Insert Type
                    $type = new ProductType;
                    // $type_find = ProductType::where('type_name','=',$new_type);
                    // $type->type_name = $product_type;
                    $type->type_name = $new_type;
                    $type->save();

                    // Insert Brend
                    $brend = new ProductBrand;
                    $brend->brand_name = $product_brend;
                    $brend->product_type_id = $type->id;
                    $brend->save();

                    // Insert AllProduct
                    $all_product = new AllProduct;
                    $all_product->product_code = $product_code;
                    $all_product_select = AllProduct::latest('barcode')->first();
                    if($all_product_select)
                    {
                        $all_product->barcode = $all_product_select->barcode+1;
                    }
                    else
                    {
                        $all_product->barcode = 1000;
                    }
                    $all_product->product_name = $new_type.' '.$product_brend;
                    $all_product->save();


                    DB::commit();
                    return response()->json([
                        'type_id' => $type->id,
                        'type_name' => $new_type
                    ]);
                }
                catch(\Exception $e){
                    DB::rollback();
                    return $e;
                }


            }
            else if($product_type && !$new_type)
            {
                // return $request;
                DB::beginTransaction();
                try{
                    // Insert Type
                    // $type = new ProductType;
                    // $type_find = ProductType::where('type_name','=',$new_type);
                    // $type->type_name = $product_type;
                    // $type->type_name = $new_type;
                    // $type->save();

                    // Insert Brend
                    $brend = new ProductBrand;
                    $brend->brand_name = $product_brend;
                    $brend->product_type_id = $product_type;
                    $brend->save();

                    // Insert AllProduct
                    $all_product = new AllProduct;
                    $all_product->product_code = $product_code;
                    $all_product_select = AllProduct::latest('barcode')->first();
                    if($all_product_select)
                    {
                        $all_product->barcode = $all_product_select->barcode+1;
                    }
                    else
                    {
                        $all_product->barcode = 100000;
                    }
                    $type_name = ProductType::where('type_id',$product_type)->get('type_name');
                    $all_product->product_name = $type_name[0]->type_name.' '.$product_brend;
                    $all_product->save();


                    DB::commit();
                    return 1;
                }
                catch(\Exception $e){
                    DB::rollback();
                    return $e;
                }
            }


        }

        // Add Table Ajax Action
        public function table_add_product(Request $request)
        {
            if($request->ajax())
            {
                // $product_id = AllProduct::all();
                // $all_products = AllProduct::latest()->get();
                //  $all_products = AllProduct::find(5)->alqor_product;
                $all_products = AllProduct::leftJoin('alqor_products', 'all_products.all_product_id','=','alqor_products.product_id')
                                            ->orderBy('all_products.all_product_id','DESC')->get();

                return DataTables::of($all_products)
                    ->addIndexColumn()
                    ->addColumn('action', function($all_products){
                        $actionBtn = '<a type="button" data-toggle="modal" data-target="#modal-product" class="btn btn-primary add_product_btn" data-id="'.$all_products->all_product_id.'"><i class="nav-icon fas fa-plus-circle"></i></a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);

            }
        }
        // Modal Add Data Ajax
        public function modal_data_add(Request $request)
        {
            $one_product = AllProduct::leftJoin('alqor_products', 'all_products.all_product_id','=','alqor_products.product_id')
                        ->where('all_products.all_product_id','=',$request->id)->get();
            return  $one_product[0];
        }
        // Add_Product Insert Ajax
        public function add_product_insert(Request $request)
        {
            $all_product_id = $request->all_product_id;
            $usd = $request->usd;
            $uzs = $request->uzs;
            $miqdori = $request->miqdori;
            $sotish_narxi = $request->sotish_narxi;
            // return $request;
            DB::beginTransaction();
            try{
                $add_product = new AddProduct;
                $add_product->date = $request->date;
                $add_product->all_product_id = $request->all_product_id;
                $add_product->supplier = $request->supplier;
                $add_product->body_price_usd = $request->usd;
                $add_product->body_price_uzs = $request->uzs;
                $add_product->amount = $request->miqdori;
                $add_product->selling_price = $request->sotish_narxi;
                $add_product->user_id = Auth()->user()->id;
                $add_product->invoice_order = $request->latest_invoice;
                $add_product->check_status = 0;
                $add_product->add_comment = $request->izox;
                $add_product->save();

                DB::commit();
                return 1;
            }
            catch(\Exception $e){
                DB::rollback();
                return $e;
            }
        }
        public function tekshiruv_add_product(Request $request)
        {
            // $invoice_order = $request->invoice_order;

            // return $data_product;
            if ($request->ajax()) {

                $params = $request->params;
                $invoice_order = $params['invoice_order'];

                $data_product = AddProduct::leftJoin('all_products','add_products.all_product_id','=','all_products.all_product_id')
                ->leftJoin('users','add_products.user_id','=','users.id')
                ->where('add_products.invoice_order', '=', $invoice_order)
                ->where('add_products.check_status', '=', 0)
                ->orderBy('add_products.add_product_id','DESC')
                ->get();
                return Datatables::of($data_product)
                    ->addIndexColumn()
                    ->addColumn('action', function($data_product){
                        $actionBtn = '<a type="button" class="btn btn-danger text-light btn-sm delete_btn"  data-id="' . $data_product->add_product_id . '"><i class="fa fa-trash"></i></a>';
                        return $actionBtn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);


            }
        }
        // Delete Add_Tovar Row
        public function delete_add_product(Request $request)
        {
            // return $request;
            $add_product_id = $request->add_product_id;

            DB::beginTransaction();
            try{
                AddProduct::where('add_product_id', '=', $add_product_id)->delete();
                DB::commit();
                return 1;
            }
            catch(Exception $e)
            {
                DB::rollback();
                return 0;
            }
        }

        public function form_send_ajax(Request $request)
        {
            $invoice_order = $request->invoice_order;
            $products = AddProduct::where('invoice_order', '=', $invoice_order)
                                    ->where('check_status', '=', 0)
                                    ->get();
            $count = AddProduct::where('invoice_order', '=', $invoice_order)
                        ->where('check_status', '=', 0)
                        ->count();
            if($count > 0)
            {
                // return $count;
                DB::beginTransaction();
                try{
                    foreach ($products as $product)
                    {
                        $tekshirish = AlqorProduct::where('product_id','=',$product->all_product_id)->first();
                        if($tekshirish)
                        {
                            $update = AlqorProduct::where('product_id','=',$product->all_product_id)
                                                    ->limit(1)
                                                    ->update( [
                                                        'product_amount' => $tekshirish->product_amount + $product->amount,
                                                        'body_price_usd' => $product->body_price_usd,
                                                        'body_price_uzs' => $product->body_price_uzs,
                                                        'selling_price'  => $product->selling_price,
                                                    ]);
                        }
                        else
                        {
                            $alqor_product = new AlqorProduct;
                            $alqor_product->product_id = $product->all_product_id;
                            $alqor_product->product_amount = $product->amount;
                            $alqor_product->body_price_usd = $product->body_price_usd;
                            $alqor_product->body_price_uzs = $product->body_price_uzs;
                            $alqor_product->selling_price = $product->selling_price;
                            $alqor_product->save();
                        }

                        $update_check_status = AddProduct::where('invoice_order','=',$invoice_order)
                        ->where('all_product_id', '=', $product->all_product_id)
                        ->limit(1)
                        ->update( [
                            'check_status' => 1
                        ]);


                    }

                    DB::commit();
                    return 1;
               }
               catch(Exception $e)
               {
                    DB::rollback();
                    return $e;
               }
            }
            else
            {
                return 0;

            }



        }

        // Total Invoice Ajax
        public function total_invoice(Request $request)
        {
            $invoice_order = $request->invoice_order;
            $jami =  AddProduct::select(\DB::raw('SUM(amount) as total_amount, Count(add_product_id) as count_product, SUM(amount*body_price_usd) as total_usd, SUM(amount*body_price_uzs) as total_uzs'))
                                ->where('invoice_order', '=', $invoice_order)
                                ->first();
            return $jami;
        }
        // Order Product Append Ajax
        public function order_product_ajax(Request $request)
        {
            $order_number = $request->order_number + 1;
            $one_product = AllProduct::leftJoin('alqor_products', 'all_products.all_product_id','=','alqor_products.product_id')
                        ->where('all_products.all_product_id','=',$request->product_id)->get();

            return response()->json([
                'order_id' => $order_number,
                'one_product' => $one_product[0]
            ]);
        }
        public function order_form_product(Request $request)
        {
            $product_id = [];
            $product_id = $request->product_id;

            $product_amount = [];
            $product_amount = $request->sale_amount;

            $product_price = [];
            $product_price = $request->sale_price;

            $order_comment = [];
            $order_comment = $request->order_comment;
            $last_order = Orders::select('serial_number')->orderBy('order_id','DESC')->first();
            DB::beginTransaction();
            try{

                foreach ($product_id as $k => $id) {
                    $order = new Orders;
                    $order->all_product_id = $id;
                    $order->ammount = $product_amount[$k];
                    $order->selling_price = $product_price[$k];
                    $order->order_status = 0;
                    $order->order_comment = $order_comment[$k] ?? '';
                    $order->serial_number = ($last_order == '')? 1 : $last_order->serial_number + 1;
                    $order->user_id = Auth()->user()->id;
                    $order->customer_id = $request->customer;
                    $order->save();


                }



                DB::commit();
                return redirect()->route('admin.order_product')->with('mess', 'Buyurtma Bazaga Kiritildi');
            }
            catch(\Exception $e){
                DB::rollback();
                return $e;
            }
        }

        public function order_view()
        {


            // $orders = Orders::all();
            $orders = Orders::select("orders.serial_number","orders.order_status","customers.customer_name","customers.customer_address","customers.customer_code","users.name", DB::raw("COUNT(orders.order_id) as count, SUM(orders.selling_price*orders.ammount) as total_price"))
            ->leftJoin('customers','orders.customer_id','=','customers.customer_id')
            ->leftJoin('users','orders.user_id','=','users.id')
            ->groupBy('orders.serial_number','orders.order_status','customers.customer_name',"customers.customer_address","customers.customer_code","users.name")
            ->orderBy('orders.serial_number','asc')
            ->get();
            return view('dashboards.admins.order_view', compact('orders'));
        }
        public function order_table_add(Request $request)
        {
            $serial_number = $request->serial_number_input;
            $serial_order = Orders::leftJoin('customers','orders.customer_id','=','customers.customer_id')
                ->leftJoin('users','orders.user_id','=','users.id')
                ->leftJoin('all_products','orders.all_product_id','=','all_products.all_product_id')
                ->leftJoin('alqor_products','orders.all_product_id','=','alqor_products.product_id')
                ->where('serial_number','=',$serial_number)->get();
            return view('dashboards.admins.order_crud', compact('serial_order'));
            // return redirect()->route('admin.order_view',['serial_order'=> $serial_order]);
        }


        public function edit_order($id)
        {
            $one_order_data = Orders::leftJoin('customers','orders.customer_id','=','customers.customer_id')
                ->leftJoin('users','orders.user_id','=','users.id')
                ->leftJoin('all_products','orders.all_product_id','=','all_products.all_product_id')
                ->leftJoin('alqor_products', 'orders.all_product_id', '=', 'alqor_products.product_id')
                ->where('order_id','=',$id)->first();
            return view('dashboards.admins.edit_order_view', compact('one_order_data'));

        }
        public function delete_order(Request $request)
        {
            // return $request;
            $delete = Orders::where('serial_number','=',$request->serial_number)->delete();
            if($delete)
            {
                return 1;
            }
            else
            {
                return 0;
            }
        //    return redirect()->back()->withErrors(['message'=>"Buyurtma O'chirildi"]);
        }

        public function edit_order_form(Request $request)
        {
            DB::beginTransaction();
            try {

                Orders::where('order_id', $request->order_id)
                        ->update([
                            'ammount' => $request->ammount,
                            'selling_price' => $request->selling_price
                        ]);
                DB::commit();
                 return redirect()->back()->with('mess_edit','Buyurtma Narxi Tahrirlandi!');;
            } catch (\Exception $e) {
                //throw $th;
                return 0
                ;
            }
            return $request;
        }
        public function sales_order(Request $request)
        {
           DB::beginTransaction();
            try {
                $select_order = Orders::where('serial_number', '=', $request->serial_number)
                                        ->where('order_status','=','0')->get();

                if($select_order)
                {

                    foreach ($select_order as $order) {
                        $really_amount = AlqorProduct::select('product_amount')->where('product_id','=', $order->all_product_id)->first();
                        // return $really_amount->product_amount;
                        if($order->amount < $really_amount->product_amount )
                        {
                            $sales = new SalesProcess;
                            $sales->customer_id = $order->customer_id;
                            $sales->sales_date = date('Y-m-d');
                            $sales->all_product_id = $order->all_product_id;
                            $sales->sales_price_final = $order->selling_price;
                            $sales->sales_amount = $order->ammount;
                            $sales->order_id = $order->order_id;
                            $sales->order_number = $order->serial_number;
                            $sales->save();
                            AlqorProduct::where('product_id','=', $order->all_product_id)
                                        ->decrement('product_amount',$order->ammount);
                        }
                        else{
                            DB::rollback();
                        }

                    }

                }
                $update_order = Orders::where('serial_number', '=', $request->serial_number)
                                ->update([
                                    'order_status' => 1
                                ]);

                $order_sum = SalesProcess::select(DB::raw("SUM(sales_price_final * sales_amount) as total_sum"))
                ->where('order_number', '=', $request->serial_number)
                ->first();
                if($order_sum)
                {
                    $total = new TotalSales;
                    $total->order_number = $request->serial_number;
                    $total->total_cost = $order_sum->total_sum;
                    $total->save();
                    $inc_exp = new IncomeExpenses;
                    $inc_exp->summa = $order_sum -> total_sum;
                    $inc_exp->date = date('Y-m-d');
                    $inc_exp->comment = '01';
                    // 0-Chiqim
                    // 1-Kirim
                    $inc_exp->status = 0;
                    $inc_exp-> customer_id = $select_order[0]->customer_id;
                    $inc_exp->order_number = $request->serial_number;
                    $inc_exp->save();
                }






                DB::commit();
                return 1;
            } catch (\Exception $e) {

                DB::rollback();
                return $e;
            }
        }

        public function debit_cash()
        {
            // $arrdebit = [];
//            $income = IncomeExpenses::select(DB::raw("SUM(income_expenses.summa) as chiqim,income_expenses.customer_id, customers.customer_name, customers.customer_address, customers.phone_number"))
//                                    ->leftJoin('customers','income_expenses.customer_id','=', 'customers.customer_id')
//                                    ->where('income_expenses.customer_id','!=','0')
//                                    ->where('income_expenses.status','=', '0')
//                                    ->where('income_expenses.tip','=', '0')
//                                    ->where('income_expenses.delete_status','=', '0')
//                                    ->groupBy('customers.customer_name', 'customers.customer_address', 'customers.phone_number', 'income_expenses.customer_id')
//                                    ->get();
            $expense  = IncomeExpenses::select(DB::raw("SUM(income_expenses.summa) as kirim, income_expenses.date, income_expenses.customer_id, customers.customer_name, customers.customer_address, customers.phone_number"))
                                        ->leftJoin('customers','income_expenses.customer_id','=', 'customers.customer_id')
                                        ->where('income_expenses.customer_id','!=','0')
                                        ->where('income_expenses.status','=', '1')
                                        ->where('income_expenses.tip','=', '0')
                                        ->where('income_expenses.delete_status','=', '0')
                                        ->groupBy('customers.customer_name', 'income_expenses.date', 'customers.customer_address', 'customers.phone_number', 'income_expenses.customer_id')
                                        ->get();


                // array_push($arrDebit,$expense);

            $income = IncomeExpenses::select(DB::raw("SUM(income_expenses.summa) as chiqim,income_expenses.customer_id"))
                                    ->where('income_expenses.customer_id','!=','0')
                                    ->where('income_expenses.status','=', '0')
                                    ->where('income_expenses.tip','=', '0')
                                    ->where('income_expenses.delete_status','=', '0')
                                    ->groupBy('income_expenses.customer_id')
                                    ->get()->toArray();
            $customers = Customers::all();
            $income_expenses = IncomeExpenses::leftJoin('customers','income_expenses.customer_id','=','customers.customer_id')->where('income_expenses.delete_status','=', '0')->get();
            return view('dashboards.admins.debit_cash', compact('customers','income_expenses','income','expense'));
        }
        public function expense_cash()
        {
            return view('dashboards.admins.expense_cash');
        }
        public function customer_debt_ajax(Request $request)
        {

            $expense = IncomeExpenses::selectRaw('sum(summa) as total_expense')->where([
                'status' => 0,
                'customer_id'=> $request->customer_id
            ])->first();
            $income = IncomeExpenses::selectRaw('sum(summa) as total_income')->where([
                'status' => 1,
                'customer_id'=> $request->customer_id
            ])->first();
            $debt = number_format($expense->total_expense-$income->total_income, 0,'.', ' ');
            return $debt;
        }
        public function debit_customer_form(Request $request)
        {
            DB::beginTransaction();
            try {

                $inc_exp = new IncomeExpenses;
                $inc_exp->summa = $request->summa;
                $inc_exp->date = date('Y-m-d');
                $inc_exp->comment = $request->comment;
                $inc_exp->status = 1;
                $inc_exp->customer_id = $request->customer_id;
                $inc_exp->order_number = '0';
                $inc_exp->save();
                DB::commit();
                return redirect()->back()->with('message','Kirim Summa Kiritildi!');
            } catch (\Exception $e) {
                return 0;
                // return redirect()->route('admin.debit_cash')->with('err','Xatolik Sodir Boldi!');
            }
        }

        public function expense_form(Request $request)
        {
            // return $request;
            DB::beginTransaction();
            try{

                $inc_exp = new IncomeExpenses;
                $inc_exp->summa = $request->summa;
                $inc_exp->date = date('Y-m-d');
                $inc_exp->comment = $request->person."  ".$request->comment;
                $inc_exp->status = 1;
                $inc_exp->tip = 1;
                $inc_exp->customer_id = 0;
                $inc_exp->order_number = 0;

                $inc_exp->save();
                DB::commit();

                return redirect()->back()->with('mess','Chiqim Kiritildi!');
            }
            catch(\Exception $e)
            {
                return redirect()->back()->with('err','Xatolik! Iltimos Takroran Kiriting!');

            }
        }
        public function order_print($id)
        {
            $order_products = Orders::leftJoin('customers','orders.customer_id','=','customers.customer_id')
            ->leftJoin('users','orders.user_id','=','users.id')
            ->leftJoin('all_products','orders.all_product_id','=','all_products.all_product_id')
            ->where('serial_number','=',$id)->get();
            $total_sum = Orders::select(\DB::raw('SUM(ammount) as total_amount, SUM(ammount*selling_price) as total_sum'))
                ->where('serial_number','=',$id)->first();
            $a=1;

            return view('dashboards.admins.order_print', compact('order_products','a', 'total_sum'));
        }


}
