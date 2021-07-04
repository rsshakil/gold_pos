<?php
use Illuminate\Http\Request;

if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
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
Route::get('language/{locale}', function ($locale) {
    Session::put('locale',$locale);

    return redirect()->back();
});
Route::get('/', 'frontendController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/aiocr', 'AiocrController@index');
// Route::get('/aiocr', function(){
// 	return "OK";
// });


// Authentication Route
Route::group(['middleware'=>'MyMiddleWire'],function(){

	// Role permission Route
	// Route::group(['middleware' => ['role:Super Admin']], function () {
		
		// Route::get('/user_create', 'PermissionController@permission')->name('permission');
        Route::get('/permission/{id?}', 'PermissionController@permission')->name('permission');
		Route::post('/permission_insert', 'PermissionController@permissionInsert');
		Route::get('/permission_delete/{permission_id}', 'PermissionController@permissionDelete');

		Route::get('/role/{id?}', 'RoleController@role')->name('role');

		// Route::get('/create_role', 'RoleController@create_role')->name('create_role');
		Route::post('/role_insert', 'RoleController@roleInsert');
		Route::get('role_delete/{role_id}', 'RoleController@roleDelete');

		Route::get('/assign_permission_model', 'RoleController@assignPermissionToModel');
		Route::post('/assign_permission_model', 'RoleController@assignPermissionToModelStore');

        Route::post('get_permission_model', 'RoleController@getPermissionModel');


		Route::get('assign_role_model', 'RoleController@assignRoleModel');
		Route::get('get_role/{user_id}', 'RoleController@getRole');
		Route::post('assign_model_role', 'RoleController@assignModelRole');

		Route::post('user_create', 'UserManagement@userCreate');
        Route::get('user_delete/{user_id}', 'UserManagement@userDelete');
		Route::get('user_list', 'UserManagement@userList');
		Route::get('user_update/{user_id}', 'UserManagement@userDetails');

		Route::post('update_user', 'UserManagement@userUpdate');
		Route::post('change_password', 'UserManagement@changePassword');
		Route::post('permission_search', 'PermissionController@permissionSearch');
		// Route::post('user_change_password', 'UserManagement@userChangePassword');

		// Code Added by Ahasan from 
		Route::post('user_update', 'UserManagement@userUpdate');
		Route::get('get_permission_by_role_id/{user_id}', 'RoleController@get_role_permission_by_role_id');

		// Code Added by Kamrul from 
		
		Route::get('/csv_upload', 'CsvController@index');
		Route::post('/csv_upload_do', 'CsvController@index');
		Route::get('/key_view', 'CsvController@key_view');
		Route::post('/csvInsert', 'CsvController@csv_insert');
		Route::post('/key_insert', 'CsvController@key_add');
		Route::post('/rule_insert', 'CsvController@rule_insert');
		Route::post('/rule_update', 'CsvController@rule_update');
		Route::get('/keyDelete/{key_id}', 'CsvController@key_delete');
		Route::get('/ruleDataShow/{r_id}', 'CsvController@ruleDataShow');


		/*api return data list*/
		Route::get('/dasboard_counter', 'CustomapiController@get_all_list_counter');
		Route::get('/get_all_sale_list/{sale_id?}', 'CustomapiController@get_all_sale_list');
		Route::get('/get_all_return_list/{return_id?}', 'CustomapiController@get_all_return_list');
		Route::get('/get_all_order_list', 'CustomapiController@get_all_order_list');
		Route::post('/get_product_info', 'CustomapiController@get_product_info');
		Route::get('/outlet_list', 'CustomapiController@index');
		Route::post('/add_into_dbs', 'CustomapiController@add_into_dbs');
		Route::post('/add_return_into_dbs', 'CustomapiController@add_return_into_dbs');
		Route::get('/get_all_maker_item_list', 'CustomapiController@get_all_maker_item_list');
		Route::get('/wholesale_purchase_list', 'CustomapiController@wholesale_purchase_list');
		Route::get('/admin_purchase_categeorie', 'CustomapiController@admin_purchase_categeorie');
		Route::get('/product_sub_categorie', 'CustomapiController@product_sub_categorie');
		Route::get('/product_categorie', 'CustomapiController@product_categorie');
		Route::get('/vendor_list', 'CustomapiController@vendor_list');
		Route::get('/customer_list', 'CustomapiController@customer_list');
		Route::get('/product_list', 'CustomapiController@product_list');
		Route::get('/get_settings', 'CustomapiController@get_settings');
		Route::get('/get_all_maker_cat_list', 'CustomapiController@get_all_maker_cat_list');
		Route::get('/get_all_maker_item_list_by_item_id/{id}', 'CustomapiController@get_all_maker_item_list_by_item_id');
		Route::get('/delete_maker_detail_item_id/{id}', 'CustomapiController@delete_maker_detail_item_id');
		Route::get('/get_all_product_cat_list', 'CustomapiController@get_all_product_cat_list');
		Route::get('/product_sub_categorie_list_by_cat_id/{id}', 'CustomapiController@product_sub_categorie_list_by_cat_id');
		Route::get('/get_outlet_by_id/{id}', 'CustomapiController@single_outlet_byid');
		Route::get('/delete_outlet_by_id/{id}', 'CustomapiController@delete_outlet_by_id');
		Route::get('/delete_customer_by_id/{id}', 'CustomapiController@delete_customer_by_id');
		Route::get('/delete_vendor_by_id/{id}', 'CustomapiController@delete_vendor_by_id');
		Route::get('/delete_product_category_by_id/{id}', 'CustomapiController@delete_product_category_by_id');
		Route::get('/delete_product_sub_category_by_id/{id}', 'CustomapiController@delete_product_sub_category_by_id');
		Route::get('/delete_admin_purchase_categeorie/{id}', 'CustomapiController@delete_admin_purchase_categeorie');
		Route::post('/delete_maker_item', 'CustomapiController@delete_maker_item');

		Route::get('/products', 'ProductController@index');
		Route::get('/settings', 'SitesettingController@index');
		Route::post('/update_setting_data', 'SitesettingController@store');
		Route::post('/add_maker', 'MakerController@add_maker');
		Route::post('/add_update_maker_item', 'MakerController@store');
		Route::post('/add_update_product', 'ProductController@store');
		
		Route::get('/outlets', 'OutletController@index');
		Route::post('/add_update_outlet', 'OutletController@store');
		Route::get('/category_list', 'CategoryController@index');
		Route::get('/get_all_cat_list', 'CategoryController@get_all_cat_list');
		Route::post('/add_update_purchase_product_cat', 'CategoryController@add_update_purchase_product_cat');
		Route::post('/add_update_sub_cat', 'CategoryController@add_update_sub_cat');
		Route::get('/wholesale_purchase', 'WholesalepurchaseController@index');
		Route::get('/maker_item', 'MakerController@index');
		
		Route::get('/exchange_product', 'Return_purchaseController@index');
		Route::get('/add_return', 'Return_purchaseController@create');
		Route::get('/edit_return/{return_id}', 'Return_purchaseController@edit_return');

		Route::get('/orders', 'SaleController@order_list');

		Route::get('/sales', 'SaleController@index');
		Route::get('/add_sale', 'SaleController@create');
		Route::get('/edit_sale/{sale_id}', 'SaleController@edit_sale');
		
		Route::get('/demoPdf', 'ReportgenerateController@demoPdf');
		Route::get('/print_sale/{sale_id?}', 'ReportgenerateController@print_sale');
		Route::post('/barcode_generator', 'ReportgenerateController@barcode_generator');
		
		Route::post('/add_update_wholesale_purchase', 'WholesalepurchaseController@add_update_wholesale_purchase');
		/*api return data list*/


	// });
		
});

