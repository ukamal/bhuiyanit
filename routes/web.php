<?php

use App\Http\Controllers\admin\BankController;
use App\Http\Controllers\admin\CustomerController;
use App\Http\Controllers\admin\ExpenseController;
use App\Http\Controllers\admin\IncomeExpenseController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\admin\QoutationController;
use App\Http\Controllers\admin\SalesController;
use App\Http\Controllers\admin\SetupController;
use App\Http\Controllers\admin\StockController;
use App\Http\Controllers\admin\SupplierController;
use App\Http\Controllers\admin\ServiceSaleController;
use App\Http\Controllers\admin\PackageController;
use App\Http\Controllers\admin\ServiceController;
use App\Http\Controllers\admin\PackegeSaleController;
use App\Http\Controllers\admin\DefaultController;
use App\Http\Controllers\admin\PurchaseController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SaleRetunrController;
use App\Http\Controllers\admin\BrandController;

use App\Models\Expense;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
    // return view('welcome');
});

Route::get('reboot', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    return '<center><h1>System Rebooted!</h1></center>';
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/dashboard', [SetupController::class, 'dashboard'])->name('admin.dashboard');
Route::resource('/admin/customer',CustomerController::class);
Route::resource('/admin/supplier',SupplierController::class);


Route::get('/admin/projects', [IncomeExpenseController::class, 'index'])->name('admin.projects');
Route::post('/admin/project/store', [IncomeExpenseController::class, 'project_store'])->name('admin.project.store');
Route::get('/admin/project/transaction', [IncomeExpenseController::class, 'bank_tansaction'])->name('admin.project.transaction');
Route::post('/admin/project/transaction/store', [IncomeExpenseController::class, 'bank_tansaction_store'])->name('admin.project.transaction.store');

Route::get('/admin/bank', [BankController::class, 'index'])->name('admin.bank');
Route::post('/admin/bank/store', [BankController::class, 'store'])->name('bank.store');
Route::get('/admin/bank/destroy/{id}', [BankController::class, 'destroy'])->name('bank.destroy');
Route::post('/admin/bank/update/{id}', [BankController::class, 'update'])->name('bank.update');

Route::get('/admin/bank/transaction', [BankController::class, 'bank_tansaction'])->name('admin.bank.transaction');
Route::post('/admin/bank/transaction/store', [BankController::class, 'bank_tansaction_store'])->name('admin.transaction.store');

Route::get('/admin/bank/expense', [ExpenseController::class, 'expense'])->name('admin.expense');
Route::post('/admin/expense/head/store', [ExpenseController::class, 'expense_head_store'])->name('expense.head.store');
Route::get('/admin/daily/expense', [ExpenseController::class, 'daily_expense'])->name('admin.daily.expense');
Route::post('/admin/transaction/expense/store', [ExpenseController::class, 'daily_expense_store'])->name('admin.expense.transaction.store');
Route::get('/admin/expense/destroy/{id}', [ExpenseController::class, 'expenseDestroy'])->name('expense_destroy');
Route::get('/admin/expense/transaction/destroy/{id}', [ExpenseController::class, 'dailyExpenseRemove'])->name('daily_expense_remove');

Route::get('/admin/product', [ProductsController::class, 'index'])->name('admin.index');
Route::post('/admin/product/store', [ProductsController::class, 'store'])->name('product.store');
Route::get('/admin/product/destroy/{id}', [ProductsController::class, 'destroy'])->name('product.destroy');
Route::post('/admin/product/update/{id}', [ProductsController::class, 'update'])->name('product.update');
Route::get('/admin/product/{product_id}', [ProductsController::class, 'getProduct'])->name('admin.product.search');

Route::get('/admin/add/order', [OrderController::class, 'index'])->name('admin.add.order');
Route::get('/admin/add/order/list', [OrderController::class, 'order_list'])->name('admin.add.order_list');
Route::post('/admin/add/order/store', [OrderController::class, 'store'])->name('admin.add.order.store');
Route::get('/admin/order/details/{id}', [OrderController::class, 'order_details'])->name('admin.order_details');
Route::get('/admin/order/pdf/{id}', [OrderController::class, 'order_pdf'])->name('admin.order_pdf');
Route::get('/admin/order/challan/pdf/{id}', [OrderController::class, 'order_challan_pdf'])->name('admin.order_challan_pdf');

Route::get('/admin/customer/order/list', [OrderController::class, 'customer_order_list'])->name('admin.customer.order.list');
Route::get('/admin/supplier/order/list', [OrderController::class, 'supplier_order_list'])->name('admin.supplier.order.list');

Route::get('/admin/stock/add', [StockController::class, 'stock'])->name('admin.stock.add');
Route::post('/admin/stock/add/store', [StockController::class, 'stock_store'])->name('admin.add.stock.store');
Route::get('/admin/stock/add/list', [StockController::class, 'stock_list'])->name('admin.add.stock.list');
Route::get('/admin/order/list/get/{order_no}', [StockController::class, 'order_get'])->name('admin.supplier.order.get');

Route::post('/admin/search/glass/stock', [StockController::class, 'glass_stock_search'])->name('admin.search.glass.stock');

//Sale are start
Route::get('/admin/sales/add', [SalesController::class, 'index'])->name('admin.sales.add');
Route::get('/admin/glass/sales/add', [SalesController::class, 'indexGlass'])->name('admin.glass.sales.add');
Route::post('/admin/sales/store', [SalesController::class, 'store'])->name('admin.sales.store');
Route::get('/admin/sales/list', [SalesController::class, 'list'])->name('admin.sales.list');
Route::get('/admin/only/sales/details/{id}', [SalesController::class, 'onlySaleDetails'])->name('saleDetails');
Route::get('/sale-return/{id}', [SalesController::class, 'saleReturn'])->name('sale_return_from_list');
Route::get('/admin/sales/pdf/{id}', [SalesController::class, 'salePdf'])->name('sale_pdf');
Route::get('/admin/sales/delete/{id}', [SalesController::class, 'saleDelete'])->name('sale_delete');
//Sale are end

Route::get('/admin/qoutation/add', [QoutationController::class, 'index'])->name('admin.qoutation.add');
Route::post('/admin/qoutation/store', [QoutationController::class, 'store'])->name('admin.qoutation.store');
Route::get('/admin/qoutation/list', [QoutationController::class, 'list'])->name('admin.qoutation.list');
Route::get('/admin/qoutation/details/{sale_id}', [QoutationController::class, 'qoutation_details'])->name('admin.qoutation_details');
Route::get('/admin/qoutation/qoutation_details_print/{sale_id}', [QoutationController::class, 'qoutation_details_print'])->name('admin.qoutation_details_print');
//service sales
Route::get('/admin/service/sales/add', [ServiceSaleController::class, 'index'])->name('admin.service_sales.add');
Route::post('/admin/service/sales/store', [ServiceSaleController::class, 'store'])->name('admin.service_sales.store');
Route::get('/admin/service/sales/list', [ServiceSaleController::class, 'list'])->name('admin.service_sales.list');
Route::get('/admin/service/sales/details/{id}', [ServiceSaleController::class, 'details'])->name('admin.service_sales.details');
Route::get('/admin/service/sales/pdf/{id}', [ServiceSaleController::class, 'pdf'])->name('admin.service_sales_pdf');
Route::get('/admin/service/remove/{id}', [ServiceSaleController::class, 'serviceSaleRemove'])->name('service_sale_remove');


Route::get('/admin/customer/receive/payment', [SalesController::class, 'receive_payment'])->name('admin.customer.receive.payment');
Route::post('/admin/customer/receive/payment/store', [SalesController::class, 'receive_payment_store'])->name('admin.customer.receive.payment.store');
Route::get('/receive_payment_print/{id}', [SalesController::class, 'receive_payment_print'])->name('receive_payment_print');
Route::get('/receive_report_print/{id}', [SalesController::class, 'receive_report_print'])->name('receive_report_print');
Route::get('/admin/customer/due/{cutomer_id}', [SalesController::class, 'customer_due'])->name('admin.customer.due');
Route::get('/admin/customer/recieve/report', [SalesController::class, 'receive_report'])->name('admin.customer.receive.report');

Route::get('/admin/payment/report', [SalesController::class, 'payment_report'])->name('admin.payment.report');

Route::post('/admin/payment/report/additionComm', [SalesController::class, 'payment_report_additiona_comm']);

Route::get('/admin/supplier/payment/index', [SalesController::class, 'supplier_payment'])->name('admin.supplier.payment.index');
Route::post('/admin/supplier/payment/store', [SalesController::class, 'supplier_payment_store'])->name('admin.supplier.payment.store');
Route::get('/supplier_payment_print/{id}', [SalesController::class, 'supplier_payment_print'])->name('supplier_payment_print');
Route::get('/supplier_payment_report_pdf/{id}', [SalesController::class, 'supplier_payment_report_pdf'])->name('supplier_payment_report_pdf');
Route::get('/admin/supplier/due/{cutomer_id}', [SalesController::class, 'supplier_due'])->name('admin.supplier.due');

Route::get('/admin/supplier/get/{supplier_id}', [SetupController::class, 'get_supplier_info'])->name('admin.supplier.get');
Route::get('/admin/customer/get/{cutomer_id}', [SetupController::class, 'get_customer_info'])->name('admin.customer.get');
// Route::get('/admin/glass_product/get/{glass_product_id}', [SetupController::class, 'get_glass_product_info'])->name('admin.glass_product.get');

Route::get('/add/new/package', [PackageController::class, 'addNewPackage'])->name('add.new.package');
Route::post('/store/packege', [PackageController::class, 'storePackege'])->name('store.packege');
Route::post('/update/package/{id}', [PackageController::class, 'updatePackege'])->name('update.package');
Route::get('/delete/package/{id}', [PackageController::class, 'deletePackege'])->name('delete.package');


Route::get('/add/new/service', [ServiceController::class, 'addNewService'])->name('add.new.service');
Route::post('/store/service', [ServiceController::class, 'storeService'])->name('store.service');
Route::get('/edit/service/{id}', [ServiceController::class, 'editService'])->name('edit.service');
Route::post('/update/service/{id}', [ServiceController::class, 'updateService'])->name('update.service');
Route::get('/delete/service/{id}', [ServiceController::class, 'deleteService'])->name('delete.service');

//Packege sale
Route::get('/admin/Package/sales',[PackegeSaleController::class,'index'])->name('admin.Package_sales');
Route::post('/admin/packege/sales/store',[PackegeSaleController::class,'store'])->name('admin.packege_sales.store');
Route::get('/admin/packege/sales/history',[PackegeSaleController::class,'PackageHistoryView'])->name('admin_package_sale_history');
Route::get('/view/sale/details/{id}',[PackegeSaleController::class,'PackageHistoryDetails'])->name('admin_package_sale_details');

Route::get('/admin/sales/package/list', [PackegeSaleController::class, 'packageList'])->name('admin.package_sales_list');
Route::get('/admin/sales/details/{id}', [PackegeSaleController::class, 'sale_details'])->name('admin.sale_details');
Route::get('/admin/sales/sale_details_print/{id}', [PackegeSaleController::class, 'sale_details_print'])
->name('admin.sale_details_print');
// Update quantity
Route::post('/updateQuantity/{id}',[PackegeSaleController::class,'updateQuantity'])->name('updateQuantity');


//purchase Module
// Route::get('/admin.purchase.add',[PurchaseController::class,'purchaseAdd'])->name('admin.purchase.add');
// Route::get('/admin.purchase.add',[PurchaseController::class,'purchaseAdd'])->name('purchase_sale_list');

//Start of purchase route
Route::controller(PurchaseController::class)->group(function () {
    Route::get('/admin.purchase.add', 'purchaseAdd')->name('admin.purchase.add');
    Route::get('/admin/purchase/list', 'purchaseList')->name('purchase_sale_list');
    Route::post('/purchase/store', 'purchaseStore')->name('purchase_store');
    Route::get('/admin/purchase/details/{id}', 'purchaseDetails')->name('purchase_details');
    Route::get('/admin/purchase/pdf/{id}', 'purchasePdf')->name('purchase_pdf');
    Route::get('/admin/purchase/delete/{id}', 'removePurchase')->name('remove_purchase');

    Route::get('/get-supplier-mobile/{supplierId}', 'getSupplierMobile');
    Route::get('/get-sizes/{productId}', 'getSizes');
    Route::get('/get-rates/{colorId}', 'getRate');
    Route::post('/get-new-row', 'getNewRow');

});


//Start of purchase route
Route::controller(SaleRetunrController::class)->group(function () {
    Route::get('/sale_return', 'saleRetrun')->name('sale_return');
    Route::get('/customer-product-info/{id}', 'customerProInfo')->name('customer_product_info');
    Route::post('/sales/store', 'salesEntryStore')->name('user.salesEntry.store');
    Route::get('/sales/return/customer-invoice/{id}', 'getCustomerSaleInvoice')->name('user.getCustomerSaleInvoice');
    Route::post('/sales/return/store', 'salesReturnStore')->name('user.salesReturn.store');
    Route::get('/saleByCustomer/{id}/{invoice}','saleByCustomer')->name('user.saleByCustomer');
});

Route::controller(QoutationController::class)->group(function(){
    Route::get('/item-qoutation-add', 'itemQoutationAdd')->name('item_qoutation_add');
    Route::post('/item/qoutation/store', 'itemQutationStore')->name('item_qutation_store');
    Route::get('/item/qoutation/list', 'list')->name('item_qoutation_list');

});


//End of purchase route

// default ajax controler
route::post('/get-packege',[DefaultController::class,'getPackege'])->name('get-packege');

//Category Controller
Route::get('/add/new/category',[CategoryController::class,'addCategory'])->name('add.new.category');
Route::post('/category/store',[CategoryController::class,'categoryStore'])->name('category.store');
Route::post('/category/update/{id}',[CategoryController::class,'categoryUpdate'])->name('category.update');
Route::post('/category/destroy/{id}',[CategoryController::class,'categoryDestroy'])->name('category.destroy');



//Brand routing
Route::controller(BrandController::class)->prefix('brand')->group(function(){
    Route::get('/view','view')->name('view_brand');
    Route::post('/store','store')->name('store_brand');
    Route::post('/update/{id}','update')->name('update_brand');
    Route::get('/delete/{id}','delete')->name('delete_brand');     
    //get address name ways with json
    Route::get('/get-address/{id}','GetAddress');
});

Route::get('/test-project-down', function () {
    if (isProjectDownAfterOneDay()) {
        return 'Project will be down after 1 day from today (27-02-2024).';
    } else {
        return 'Project is still up.';
    }
});

