<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Branche;
use App\Models\AllProduct;
use App\Models\ProductType;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    function index(){

        return view('dashboards.admins.index');
       }

       function profile(){
           return view('dashboards.admins.profile');
       }
       function settings(){
           return view('dashboards.admins.settings');
       }

       function updateInfo(Request $request){

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

       function updatePicture(Request $request){
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


       function changePassword(Request $request){
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
           return view('dashboards.admins.add_product', compact('product_types'));
       }
       public function all_product()
       {
           return view('dashboards.admins.all_product');
       }
       public function branches()
       {
           return view('dashboards.admins.branches');
       }
       public function orders()
       {
           return view('dashboards.admins.orders');
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
                        $all_product->barcode = 100000;
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
}
