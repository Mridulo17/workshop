<?php

use Illuminate\Support\Facades\App;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Common\CommonController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();
Auth::routes(['verify' => true]);

/*--------------ADMIN ROUTES---------------*/
Route::group(['middleware' => 'auth', 'prefix' => '/admin', 'namespace' => 'Admin'], function () {
    Route::group(['middleware' => 'menu_permission'], function () {
        Route::get('/', 'DashboardController@index')->name('dashboard');
        Route::post('/find-fire-station-products', [DashboardController::class, 'FindFireStationProducts'])->name('find_fire_station_products');
        Route::get('menu/action/{menu_id}', 'UserMenuActionController@index')->name('user_menu_action.index');
        Route::get('menu/action/create/{menu_id}', 'UserMenuActionController@create')->name('user_menu_action.create');
        Route::post('menu/action/store/{menu_id}', 'UserMenuActionController@store')->name('user_menu_action.store');
        Route::get('menu/action/edit/{menu_id}/{id}', 'UserMenuActionController@edit')->name('user_menu_action.edit');
        Route::delete('menu/action/destroy/{menu_id}/{id}', 'UserMenuActionController@destroy')->name('user_menu_action.destroy');
        Route::post('menu/action/update/{menu_id}/{id}', 'UserMenuActionController@update')->name('user_menu_action.update');

        Route::resource('menu', 'MenuController');
        Route::resource('menu-action', 'MenuActionController');

        Route::resource('division', 'DivisionController');
        Route::resource('district', 'DistrictController');
        Route::resource('thana', 'ThanaController');
        Route::resource('fire_station_type', 'FireStationTypeController');
        Route::resource('fire_station', 'FireStationController');

        Route::get('/designation/deleted-list', 'DesignationController@deletedListIndex')->name('designation.deleted_list');
        Route::get('/designation/restore/{id}', 'DesignationController@restore')->name('designation.restore');
        Route::delete('/designation/force-delete/{id}', 'DesignationController@forceDelete')->name('designation.force_destroy');
        Route::resource('designation', 'DesignationController');

        Route::get('/employee/deleted-list', 'EmployeeController@deletedListIndex')->name('employee.deleted_list');
        Route::get('/employee/restore/{id}', 'EmployeeController@restore')->name('employee.restore');
        Route::delete('/employee/force-delete/{id}', 'EmployeeController@forceDelete')->name('employee.force_destroy');
        Route::resource('employee', 'EmployeeController');

        Route::get('/workshop/deleted-list', 'WorkshopController@deletedListIndex')->name('workshop.deleted_list');
        Route::get('/workshop/restore/{id}', 'WorkshopController@restore')->name('workshop.restore');
        Route::delete('/workshop/force-delete/{id}', 'WorkshopController@forceDelete')->name('workshop.force_destroy');
        Route::resource('workshop', 'WorkshopController');

        Route::get('/supplier/deleted-list', 'SupplierController@deletedListIndex')->name('supplier.deleted_list');
        Route::get('/supplier/restore/{id}', 'SupplierController@restore')->name('supplier.restore');
        Route::delete('/supplier/force-delete/{id}', 'SupplierController@forceDelete')->name('supplier.force_destroy');
        Route::resource('supplier', 'SupplierController');

        Route::get('/driver/deleted-list', 'DriverController@deletedListIndex')->name('driver.deleted_list');
        Route::get('/driver/restore/{id}', 'DriverController@restore')->name('driver.restore');
        Route::delete('/driver/force-delete/{id}', 'DriverController@forceDelete')->name('driver.force_destroy');
        Route::resource('driver', 'DriverController');

        Route::get('/country/deleted-list', 'CountryController@deletedListIndex')->name('country.deleted_list');
        Route::get('/country/restore/{id}', 'CountryController@restore')->name('country.restore');
        Route::delete('/country/force-delete/{id}', 'CountryController@forceDelete')->name('country.force_destroy');
        Route::resource('country', 'CountryController');

        Route::get('/type/deleted-list', 'TypeController@deletedListIndex')->name('type.deleted_list');
        Route::get('/type/restore/{id}', 'TypeController@restore')->name('type.restore');
        Route::delete('/type/force-delete/{id}', 'TypeController@forceDelete')->name('type.force_destroy');
        Route::resource('type', 'TypeController');

        Route::get('/category/deleted-list', 'CategoryController@deletedListIndex')->name('category.deleted_list');
        Route::get('/category/restore/{id}', 'CategoryController@restore')->name('category.restore');
        Route::delete('/category/force-delete/{id}', 'CategoryController@forceDelete')->name('category.force_destroy');
        Route::resource('category', 'CategoryController');

        Route::get('/brand-create-modal', 'BrandController@createModal')->name('brand_create_modal');
        Route::post('/brand-store-from-modal', 'BrandController@storeFromModal')->name('brand_store_from_modal');
        Route::get('/brand/deleted-list', 'BrandController@deletedListIndex')->name('brand.deleted_list');
        Route::get('/brand/restore/{id}', 'BrandController@restore')->name('brand.restore');
        Route::delete('/brand/force-delete/{id}', 'BrandController@forceDelete')->name('brand.force_destroy');
        Route::resource('brand', 'BrandController');

        Route::get('/model-create-modal', 'ModelController@createModal')->name('model_create_modal');
        Route::post('/model-store-from-modal', 'ModelController@storeFromModal')->name('model_store_from_modal');
        Route::get('/model/deleted-list', 'ModelController@deletedListIndex')->name('model.deleted_list');
        Route::get('/model/restore/{id}', 'ModelController@restore')->name('model.restore');
        Route::delete('/model/force-delete/{id}', 'ModelController@forceDelete')->name('model.force_destroy');
        Route::resource('model', 'ModelController');

        Route::get('/unit/deleted-list', 'UnitController@deletedListIndex')->name('unit.deleted_list');
        Route::get('/unit/restore/{id}', 'UnitController@restore')->name('unit.restore');
        Route::delete('/unit/force-delete/{id}', 'UnitController@forceDelete')->name('unit.force_destroy');
        Route::resource('unit', 'UnitController');

        Route::get('/unit-conversion/deleted-list', 'UnitConversionController@deletedListIndex')->name('unit_conversion.deleted_list');
        Route::get('/unit-conversion/restore/{id}', 'UnitConversionController@restore')->name('unit_conversion.restore');
        Route::delete('/unit-conversion/force-delete/{id}', 'UnitConversionController@forceDelete')->name('unit_conversion.force_destroy');
        Route::resource('unit-conversion', 'UnitConversionController', ['names' => 'unit_conversion']);

        Route::get('/variant-type/deleted-list', 'VariantTypeController@deletedListIndex')->name('variant_type.deleted_list');
        Route::get('/variant-type/restore/{id}', 'VariantTypeController@restore')->name('variant_type.restore');
        Route::delete('/variant-type/force-delete/{id}', 'VariantTypeController@forceDelete')->name('variant_type.force_destroy');
        Route::resource('variant-type', 'VariantTypeController', ['names' => 'variant_type']);

        Route::get('/variant/deleted-list', 'VariantController@deletedListIndex')->name('variant.deleted_list');
        Route::get('/variant/restore/{id}', 'VariantController@restore')->name('variant.restore');
        Route::delete('/variant/force-delete/{id}', 'VariantController@forceDelete')->name('variant.force_destroy');
        Route::resource('variant', 'VariantController');

        Route::get('/product/deleted-list', 'ProductController@deletedListIndex')->name('product.deleted_list');
        Route::get('/product/restore/{id}', 'ProductController@restore')->name('product.restore');
        Route::get('/product/vehicles', 'ProductController@vehicles')->name('product.vehicles');
        Route::get('/product/pumps', 'ProductController@pumps')->name('product.pumps');
        Route::get('/product/equipments', 'ProductController@equipments')->name('product.equipments');
        Route::delete('/product/force-delete/{id}', 'ProductController@forceDelete')->name('product.force_destroy');
        Route::resource('product', 'ProductController');

        Route::get('/driver-assign/deleted-list', 'DriverAssignController@deletedListIndex')->name('driver_assign.deleted_list');
        Route::get('/driver-assign/restore/{id}', 'DriverAssignController@restore')->name('driver_assign.restore');
        Route::delete('/driver-assign/force-delete/{id}', 'DriverAssignController@forceDelete')->name('driver_assign.force_destroy');
        Route::resource('driver-assign', 'DriverAssignController', ['names' => 'driver_assign']);

        Route::get('/product-part/deleted-list', 'ProductPartController@deletedListIndex')->name('product_part.deleted_list');
        Route::get('/product-part/restore/{id}', 'ProductPartController@restore')->name('product_part.restore');
        Route::delete('/product-part/force-delete/{id}', 'ProductPartController@forceDelete')->name('product_part.force_destroy');
        Route::resource('product-part', 'ProductPartController', ['names' => 'product_part']);

        Route::get('/workshop-order/deleted-list', 'WorkshopOrderController@deletedListIndex')->name('workshop_order.deleted_list');
        Route::get('/workshop-order/restore/{id}', 'WorkshopOrderController@restore')->name('workshop_order.restore');
        Route::delete('/workshop-order/force-delete/{id}', 'WorkshopOrderController@forceDelete')->name('workshop_order.force_destroy');
        Route::get('/workshop-order/print/{id}', 'WorkshopOrderController@print')->name('workshop_order.print');
        Route::resource('workshop-order', 'WorkshopOrderController', ['names' => 'workshop_order']);

        Route::get('/inspection-report/deleted-list', 'InspectionReportController@deletedListIndex')->name('inspection_report.deleted_list');
        Route::get('/inspection-report/restore/{id}', 'InspectionReportController@restore')->name('inspection_report.restore');
        Route::delete('/inspection-report/force-delete/{id}', 'InspectionReportController@forceDelete')->name('inspection_report.force_destroy');
        Route::get('/inspection-report/print/{id}', 'InspectionReportController@print')->name('inspection_report.print');
        Route::resource('inspection-report', 'InspectionReportController', ['names' => 'inspection_report']);

        Route::get('get-category-by-type-id-url/{id}', 'RequisitionController@getCategoryByTypeIdUrl');
        Route::post('/receive-requisition-form-data-from-fstore', 'RequisitionController@ReceiveRequisitionFormDataFromFstore');
        Route::post('/requisition/get-product-by-inspection-tracking-number', 'RequisitionController@getProductByInspectionTrackingNumber')->name('requisition.get_product_by_inspection_tracking_number');
        Route::get('/requisition/deleted-list', 'RequisitionController@deletedListIndex')->name('requisition.deleted_list');
        Route::get('/requisition/restore/{id}', 'RequisitionController@restore')->name('requisition.restore');
        Route::delete('/requisition/force-delete/{id}', 'RequisitionController@forceDelete')->name('requisition.force_destroy');
        Route::resource('requisition', 'RequisitionController');

        Route::get('/stock_receive/deleted-list', 'StockReceiveController@deletedListIndex')->name('stock_receive.deleted_list');
        Route::get('/stock_receive/restore/{id}', 'StockReceiveController@restore')->name('stock_receive.restore');
        Route::delete('/stock_receive/force-delete/{id}', 'StockReceiveController@forceDelete')->name('stock_receive.force_destroy');
        Route::resource('stock-receive', 'StockReceiveController', ['names' => 'stock_receive']);

        Route::any('role/permission/{id}', 'RoleController@permission')->name('role.permission');
        Route::resource('role', 'RoleController');
        Route::get('user/permission/{id}', 'UserController@permission')->name('user.permission');
        Route::post('user/permission-update/{id}', 'UserController@permissionUpdate')->name('user.permission_update');
        Route::post('get_role_permission', 'RoleController@getRolePermission')->name('get_role_permission');
        Route::get('/profile', 'UserController@profile')->name('user.profile');
        Route::post('/profile/{id}', 'UserController@profileUpdate')->name('user.profile_update');
        Route::resource('user', 'UserController');
        Route::resource('content', 'ContentController');
        Route::resource('activity_log', 'ActivityLogController');

        Route::get('/lubricant-record/deleted-list', 'LubricantRecordController@deletedListIndex')->name('lubricant_record.deleted_list');
        Route::get('/lubricant-record/restore/{id}', 'LubricantRecordController@restore')->name('lubricant_record.restore');
        Route::delete('/lubricant-record/force-delete/{id}', 'LubricantRecordController@forceDelete')->name('lubricant_record.force_destroy');
        Route::get('/lubricant-record/print/{id}', 'LubricantRecordController@print')->name('lubricant_record.print');
        Route::resource('lubricant-record', 'LubricantRecordController', ['names' => 'lubricant_record']);

        Route::get('/filter-change-record/deleted-list', 'FilterChangeRecordController@deletedListIndex')->name('filter_change_record.deleted_list');
        Route::get('/filter-change-record/restore/{id}', 'FilterChangeRecordController@restore')->name('filter_change_record.restore');
        Route::delete('/filter-change-record/force-delete/{id}', 'FilterChangeRecordController@forceDelete')->name('filter_change_record.force_destroy');
        Route::get('/filter-change-record/print/{id}', 'FilterChangeRecordController@print')->name('filter_change_record.print');
        Route::resource('filter-change-record', 'FilterChangeRecordController', ['names' => 'filter_change_record']);

        Route::get('/repair-summary/deleted-list', 'RepairSummaryController@deletedListIndex')->name('repair_summary.deleted_list');
        Route::get('/repair-summary/restore/{id}', 'RepairSummaryController@restore')->name('repair_summary.restore');
        Route::delete('/repair-summary/force-delete/{id}', 'RepairSummaryController@forceDelete')->name('repair_summary.force_destroy');
        Route::get('/repair-summary/print/{id}', 'RepairSummaryController@print')->name('repair_summary.print');
        Route::resource('repair-summary', 'RepairSummaryController', ['names' => 'repair_summary']);

        Route::get('/kmpl-lph-record/deleted-list', 'KmplLphRecordController@deletedListIndex')->name('kmpl_lph_record.deleted_list');
        Route::get('/kmpl-lph-record/restore/{id}', 'KmplLphRecordController@restore')->name('kmpl_lph_record.restore');
        Route::delete('/kmpl-lph-record/force-delete/{id}', 'KmplLphRecordController@forceDelete')->name('kmpl_lph_record.force_destroy');
        Route::get('/kmpl-lph-record/print/{id}', 'KmplLphRecordController@print')->name('kmpl_lph_record.print');
        Route::resource('kmpl-lph-record', 'KmplLphRecordController', ['names' => 'kmpl_lph_record']);

        Route::get('/vehicle-transfer/deleted-list', 'VehicleTransferController@deletedListIndex')->name('vehicle_transfer.deleted_list');
        Route::get('/vehicle-transfer/restore/{id}', 'VehicleTransferController@restore')->name('vehicle_transfer.restore');
        Route::delete('/vehicle-transfer/force-delete/{id}', 'VehicleTransferController@forceDelete')->name('vehicle_transfer.force_destroy');
        Route::get('/vehicle-transfer/print/{id}', 'VehicleTransferController@print')->name('vehicle_transfer.print');
        Route::resource('vehicle-transfer', 'VehicleTransferController', ['names' => 'vehicle_transfer']);

        Route::get('/driver-record/deleted-list', 'DriverRecordController@deletedListIndex')->name('driver_record.deleted_list');
        Route::get('/driver-record/restore/{id}', 'DriverRecordController@restore')->name('driver_record.restore');
        Route::delete('/driver-record/force-delete/{id}', 'DriverRecordController@forceDelete')->name('driver_record.force_destroy');
        Route::get('/driver-record/print/{id}', 'DriverRecordController@print')->name('driver_record.print');
        Route::resource('driver-record', 'DriverRecordController', ['names' => 'driver_record']);

        Route::get('/tyre-record/deleted-list', 'TyreRecordController@deletedListIndex')->name('tyre_record.deleted_list');
        Route::get('/tyre-record/restore/{id}', 'TyreRecordController@restore')->name('tyre_record.restore');
        Route::delete('/tyre-record/force-delete/{id}', 'TyreRecordController@forceDelete')->name('tyre_record.force_destroy');
        Route::get('/tyre-record/print/{id}', 'TyreRecordController@print')->name('tyre_record.print');
        Route::resource('tyre-record', 'TyreRecordController', ['names' => 'tyre_record']);

        Route::get('/vehicle-maintenance-order/deleted-list', 'VehicleMaintenanceOrderController@deletedListIndex')->name('vehicle_maintenance_order.deleted_list');
        Route::get('/vehicle-maintenance-order/restore/{id}', 'VehicleMaintenanceOrderController@restore')->name('vehicle_maintenance_order.restore');
        Route::delete('/vehicle-maintenance-order/force-delete/{id}', 'VehicleMaintenanceOrderController@forceDelete')->name('vehicle_maintenance_order.force_destroy');
        Route::get('/vehicle-maintenance-order/print/{id}', 'VehicleMaintenanceOrderController@print')->name('vehicle_maintenance_order.print');
        Route::resource('vehicle-maintenance-order', 'VehicleMaintenanceOrderController', ['names' => 'vehicle_maintenance_order']);

        Route::get('/inspection-testing/deleted-list', 'InspectionTestingController@deletedListIndex')->name('inspection_testing.deleted_list');
        Route::get('/inspection-testing/restore/{id}', 'InspectionTestingController@restore')->name('inspection_testing.restore');
        Route::delete('/inspection-testing/force-delete/{id}', 'InspectionTestingController@forceDelete')->name('inspection_testing.force_destroy');
        Route::get('/inspection-testing/print/{id}', 'InspectionTestingController@print')->name('inspection_testing.print');
        Route::resource('inspection-testing', 'InspectionTestingController', ['names' => 'inspection_testing']);

        Route::get('/battery-record/deleted-list', 'BatteryDetailController@deletedListIndex')->name('battery_record.deleted_list');
        Route::get('/battery-record/restore/{id}', 'BatteryDetailController@restore')->name('battery_record.restore');
        Route::delete('/battery-record/force-delete/{id}', 'BatteryDetailController@forceDelete')->name('battery_record.force_destroy');
        Route::get('/battery-record/print/{id}', 'BatteryDetailController@print')->name('battery_record.print');
        Route::resource('battery-record', 'BatteryDetailController', ['names' => 'battery_record']);

        Route::get('/monthly-transit/deleted-list', 'MonthlyTransitController@deletedListIndex')->name('monthly_transit.deleted_list');
        Route::get('/monthly-transit/restore/{id}', 'MonthlyTransitController@restore')->name('monthly_transit.restore');
        Route::delete('/monthly-transit/force-delete/{id}', 'MonthlyTransitController@forceDelete')->name('monthly_transit.force_destroy');
        Route::get('/monthly-transit/print/{id}', 'MonthlyTransitController@print')->name('monthly_transit.print');
        Route::resource('monthly-transit', 'MonthlyTransitController', ['names' => 'monthly_transit']);

        Route::get('/repair-job-card/deleted-list', 'RepairJobCardController@deletedListIndex')->name('repair_job_card.deleted_list');
        Route::get('/repair-job-card/restore/{id}', 'RepairJobCardController@restore')->name('repair_job_card.restore');
        Route::delete('/repair-job-card/force-delete/{id}', 'RepairJobCardController@forceDelete')->name('repair_job_card.force_destroy');
        Route::get('/repair-job-card/print/{id}', 'RepairJobCardController@print')->name('repair_job_card.print');
        Route::resource('repair-job-card', 'RepairJobCardController', ['names' => 'repair_job_card']);
    });
});

Route::group(['middleware' => 'auth'], function () {
    //common data route here
    Route::group(['namespace' => 'Common'], function () {
        //get dependent data
        Route::post('get_district', [CommonController::class, 'GetDistrict'])->name('get_district');
        Route::post('get_thana', [CommonController::class, 'GetThana'])->name('get_thana');
        Route::post('get_district_from_division', [CommonController::class, 'GetDistrictFromDivision'])->name('get_district_from_division');
        Route::post('get_fire_station_from_district', [CommonController::class, 'GetFireStationFromDistrict'])->name('get_fire_station_from_district');
        Route::post('get_fire_station_from_thana', [CommonController::class, 'GetFireStationFromThana'])->name('get_fire_station_from_thana');
        Route::post('get_fire_station_from_code', [CommonController::class, 'GetFireStationFromCode'])->name('get_fire_station_from_code');
        Route::post('get_workshop_from_division', [CommonController::class, 'GetWorkshopFromDivision'])->name('get_workshop_from_division');
        Route::post('get_employee', [CommonController::class, 'GetEmployee'])->name('get_employee');
        Route::post('get_employee_from_pin', [CommonController::class, 'GetEmployeeFromPin'])->name('get_employee_from_pin');
        Route::post('number-validation', [CommonController::class, 'NumberValidation'])->name('number_validation');
        Route::post('/get-variants', [CommonController::class, 'GetVariants'])->name('get_variants');
        Route::post('/get-models', [CommonController::class, 'GetModels'])->name('get_models');
        Route::post('/find-product', [CommonController::class, 'FindProduct'])->name('find_product');
        Route::post('/find-fire-station', [CommonController::class, 'FindFireStation'])->name('find_fire_station');
        Route::post('/find-workshop-order', [CommonController::class, 'FindWorkshopOrder'])->name('workshop_order_product');
        Route::post('/inspection-report-product', [CommonController::class, 'FindInspectionReport'])->name('inspection_report_product');
        Route::post('/get-products', [CommonController::class, 'GetProducts'])->name('get_products');
        Route::post('/get-drivers', [CommonController::class, 'GetDrivers'])->name('get_drivers');
        Route::post('/get-districts', [CommonController::class, 'GetDistricts'])->name('get_districts');
        Route::post('/get-fire-stations', [CommonController::class, 'GetFireStations'])->name('get_fire_stations');
        Route::post('/get-thanas', [CommonController::class, 'GetThanas'])->name('get_thanas');
        Route::post('/get-product-part-by-model', [CommonController::class, 'getProductPartByModel'])->name('get_product_part_by_model');
        Route::post('/get-item-qty-type', [CommonController::class, 'getItemQtyByType'])->name('get_item_qty_by_type');
        Route::post('/get-categories-by-type', [CommonController::class, 'getCategoriesByType'])->name('get_categories_by_type');
        Route::post('/get-fire-stations-by-workshop', [CommonController::class, 'getFireStationsByWorkshop'])->name('get_fire_stations_by_workshop');
        Route::any('/get-divisions-by-workshop', [CommonController::class, 'getDivisionsByWorkshop'])->name('get_divisions_by_workshop');
    });

    Route::group(['prefix' => '/admin', 'namespace' => 'Admin'], function () {
        Route::get('/fire_station', 'FireStationController@index')->name('fire_station.index');
    });
});

Route::get('/', function () {
    return redirect(route('login'));
});

/*--------------GENERAL ROUTES---------------*/
/*Route::get('contact', [CommonController::class,'contact'])->name('contact');
Route::any('email_verify', 'Auth\EmailVerifyController@emailVerify')->name('email_verify');
Route::get('email_verification_check/{email}/{verification_code}', 'Auth\EmailVerifyController@emailVerificationCheck')->name('email_verification_check');
Route::get('registration_verify/{email}/{verification_code}', 'Auth\RegisterController@registrationVerify')->name('registration_verify');*/

Route::post('/temp_route', [\App\Http\Controllers\HomeController::class, 'null'])->name('temp_route');

/*.................Localization...........................*/
Route::any('locale/{locale}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
})->name('locale');


