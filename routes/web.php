<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['middleware'=>'PreventBackHistory'])->group(function () {
    Auth::routes();
});


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['prefix'=>'admin', 'middleware'=>['isAdmin','auth','PreventBackHistory']], function(){
        Route::get('dashboard',[AdminController::class,'index'])->name('admin.dashboard');
        Route::get('profile',[AdminController::class,'profile'])->name('admin.profile');
        Route::get('settings',[AdminController::class,'settings'])->name('admin.settings');
        Route::get('add_product',[AdminController::class,'add_product'])->name('admin.add_product');
        Route::get('all_product',[AdminController::class,'all_product'])->name('admin.all_product');
        Route::get('branches',[AdminController::class,'branches'])->name('admin.branches');
        Route::get('customers',[AdminController::class,'customers'])->name('admin.customers');
        Route::get('orders',[AdminController::class,'orders'])->name('admin.orders');
        Route::get('order_product',[AdminController::class,'order_product'])->name('admin.order_product');
        Route::get('order_view',[AdminController::class,'order_view'])->name('admin.order_view');
        Route::post('order_table_add',[AdminController::class,'order_table_add'])->name('admin.order_table_add');
        Route::get('debit_cash', [AdminController::class,'debit_cash'])->name('admin.debit_cash');
        Route::get('expense_cash', [AdminController::class,'expense_cash'])->name('admin.expense_cash');
        Route::get('order_print/{id}', [AdminController::class,'order_print'])->name('admin.order_print');
        Route::post('update-profile-info',[AdminController::class,'updateInfo'])->name('adminUpdateInfo');
        Route::post('change-profile-picture',[AdminController::class,'updatePicture'])->name('adminPictureUpdate');
        Route::post('change-password',[AdminController::class,'changePassword'])->name('adminChangePassword');

        // Forma Routelari
        Route::post('add_branch_form',[AdminController::class,'add_branch_form'])->name('admin.add_branch_form');
        Route::post('add_customer_form',[AdminController::class,'add_customer_form'])->name('admin.add_customer_form');
        Route::put('edit_customer_form',[AdminController::class,'edit_customer_form'])->name('admin.edit_customer_form');
        Route::get('delete_customer/{id}',[AdminController::class, 'delete_customer'])->name('admin.delete_customer');
        Route::get('edit_customer/{id}',[AdminController::class, 'edit_customer'])->name('admin.edit_customer');
        Route::post('order_form_product',[AdminController::class,'order_form_product'])->name('admin.order_form_product');
        Route::get('edit_order/{id}', [AdminController::class,'edit_order'])->name('admin.edit_order');
        Route::post('delete_order', [AdminController::class, 'delete_order'])->name('admin.delete_order');
        Route::put('edit_order_form', [AdminController::class, 'edit_order_form'])->name('admin.edit_order_form');
        Route::post('debit_customer_form',[AdminController::class,'debit_customer_form'])->name('admin.debit_customer_form');
        Route::post('expense_form', [AdminController::class,'expense_form'])->name('admin.expense_form');
        // Ajax Route
        // ***** Type Brend Ajax ****//
        Route::post('add_type_brend_ajax',[AdminController::class,'add_type_brend_ajax'])->name('admin.add_type_brend_ajax');
        // ***** Data Table Data Ajax Add ******//
        Route::get('table_add_product',[AdminController::class,'table_add_product'])->name('admin.table_add_product');
        // **** Modal Add Ajax ****//
        Route::post('modal_data_add',[AdminController::class,'modal_data_add'])->name('admin.modal_data_add');
        // **** Insert Add_Product Insert Ajax
        Route::post('add_product_insert',[AdminController::class,'add_product_insert'])->name('admin.add_product_insert');
        // **** Add Product Tekshiruv Block Ajax****//
        Route::get('tekshiruv_add_product',[AdminController::class,'tekshiruv_add_product'])->name('admin.tekshiruv_add_product');
        // **** Delete Product Add_Tovar Ajax ****//
        Route::post('delete_add_product',[AdminController::class,'delete_add_product'])->name('admin.delete_add_product');
        // **** Form Send Ajax Insert Product BAse ****//
        Route::post('form_send_ajax',[AdminController::class,'form_send_ajax'])->name('admin.form_send_ajax');
        //  **** Total Invoice Ajax
        Route::post('total_invoice',[AdminController::class,'total_invoice'])->name('admin.total_invoice');
        //  **** Order Product Append Ajax ****//
        Route::post('order_product_ajax',[AdminController::class,'order_product_ajax'])->name('admin.order_product_ajax');
        //  **** Order Checked and Sale Product
        Route::post('sales_order',[AdminController::class,'sales_order'])->name('admin.sales_order');
        //  **** Customer Debd Ajax **** //
        Route::post('customer_debt_ajax',[AdminController::class,'customer_debt_ajax'])->name('admin.customer_debt_ajax');
});

Route::group(['prefix'=>'user', 'middleware'=>['isUser','auth','PreventBackHistory']], function(){
    // Auth::routes(['register' => false]);
    Route::get('dashboard',[UserController::class,'index'])->name('user.dashboard');
    Route::get('profile',[UserController::class,'profile'])->name('user.profile');
    Route::get('settings',[UserController::class,'settings'])->name('user.settings');

});
