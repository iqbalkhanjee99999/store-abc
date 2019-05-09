<?php
Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

////////////////////Categories/////////////////////////////////

Route::get('/categories/showAll', 'CategoriesController@showAll');
Route::get('/categories/addNew/{id?}', 'CategoriesController@addNew');
Route::get('/categories/deleteCategory/{id}', 'CategoriesController@deleteCategory');
Route::post('/categories/saveCategory', 'CategoriesController@saveCategory');
Route::post('/categories/addCategoryItem', 'CategoriesController@addCategoryItem');
Route::get('/categories/categoryItems/{id}', 'CategoriesController@categoryItems');
Route::get('/categories/items/newItem/{id}/{item_id?}', 'CategoriesController@newItem');
Route::get('/categories/deleteItem/{id}', 'CategoriesController@deleteItem');
Route::get('/categories/tools', 'CategoriesController@tools');
Route::get('/categories/addNewTool/{id?}', 'CategoriesController@addNewTool');
Route::get('/categories/addToolItem/{id}', 'CategoriesController@addToolItem');
Route::get('/categories/toolsCategoryItems/{id}', 'CategoriesController@toolsCategoryItems');
Route::post('/categories/saveToolCategory', 'CategoriesController@saveToolCategory');
Route::post('/categories/addToolCategoryItem', 'CategoriesController@addToolCategoryItem');
Route::get('/categories/deleteToolCategory/{id}', 'CategoriesController@deleteToolCategory');
Route::get('/categories/addToolItem/{id}/{item_id?}', 'CategoriesController@addToolItem');
Route::get('/categories/deleteToolItem/{id}', 'CategoriesController@deleteToolItem');

////////////////////Reciving Goods/////////////////////////////////

Route::get('/recivingGoods', 'RecivingGoodsController@recivingGoods');
Route::get('/recivingGoods/getCategoryItems/{id}', 'RecivingGoodsController@getCategoryItems');
Route::get('/recivingGoods/getRecivingCategoryItems/{id}', 'RecivingGoodsController@getRecivingCategoryItems');
Route::get('/recivingGoods/getRequestedCategoryItems/{id}', 'RecivingGoodsController@getRequestedCategoryItems');
Route::get('/recivingGoods/getToolsCategoryItems/{id}', 'RecivingGoodsController@getToolsCategoryItems');
Route::get('/recivingGoods/getProjectToolsCategoryItems/{id}', 'RecivingGoodsController@getProjectToolsCategoryItems');
Route::post('/recivingGoods/getItemDetails', 'RecivingGoodsController@getItemDetails');
Route::post('/recivingGoods/addRecivingGoodsData', 'RecivingGoodsController@addRecivingGoodsData');
Route::get('/recivingGoods/getItembyCat/{id}', 'RecivingGoodsController@getItembyCat');

////////////////users///////////////////////////

Route::get('users/engineers', 'UserController@engineers');
Route::get('users/storeKeepers', 'UserController@storeKeepers');
Route::get('users/addEngineer/{id?}', 'UserController@addEngineer');
Route::get('users/addStoreKeeper/{id?}', 'UserController@addStoreKeeper');
Route::get('users/deleteUser/{id}', 'UserController@deleteUser');
Route::get('users/changePassword', 'UserController@changePassword');
Route::post('users/updatePassword', 'UserController@updatePassword');
Route::post('users/saveEngineer', 'UserController@saveEngineer');
Route::post('users/saveStoreKeeper', 'UserController@saveStoreKeeper');
Route::get('users/resetPassword/{id}', 'UserController@resetPassword');

//////////////////////Requested Goods//////////////////////

Route::get('requestedGoods/addRequest', 'RequestedGoodsController@addRequest');
Route::get('requestedGoods/getItemDetails/{id}', 'RequestedGoodsController@getItemDetails');
Route::post('requestedGoods/addRequestedGoods', 'RequestedGoodsController@addRequestedGoods');
Route::get('requestedGoods/PendingRequests/{id?}', 'RequestedGoodsController@PendingRequests');
Route::get('requestedGoods/procurementApprove/{id}', 'RequestedGoodsController@procurementApprove');
Route::get('requestedGoods/procurementReject/{id}', 'RequestedGoodsController@procurementReject');
Route::get('requestedGoods/storeManagerReject/{id}', 'RequestedGoodsController@storeManagerReject');
Route::get('requestedGoods/storeManagerApprove/{id}', 'RequestedGoodsController@storeManagerApprove');
Route::get('requestedGoods/MyOrders/{id?}', 'RequestedGoodsController@MyOrders');
Route::get('requestedGoods/MyToolsOrders/{id?}', 'RequestedGoodsController@MyToolsOrders');
Route::get('requestedGoods/addToolsRequest', 'RequestedGoodsController@addToolsRequest');
Route::post('requestedGoods/addToolsRequestedGoods', 'RequestedGoodsController@addToolsRequestedGoods');
Route::get('requestedGoods/PendingToolsRequests/{id?}', 'RequestedGoodsController@PendingToolsRequests');
Route::get('requestedGoods/storeToolsApprove/{id}', 'RequestedGoodsController@storeToolsApprove');
Route::get('requestedGoods/storeToolsReject/{id}', 'RequestedGoodsController@storeToolsReject');
Route::get('requestedGoods/markToolAsGood/{id}/{requested_goods_id}', 'RequestedGoodsController@markToolAsGood');
Route::get('requestedGoods/markToolAsNeedRepair/{id}', 'RequestedGoodsController@markToolAsNeedRepair');
Route::get('requestedGoods/markToolAsDemaged/{id}', 'RequestedGoodsController@markToolAsDemaged');
Route::get('requestedGoods/markToolAsRecieved/{id}', 'RequestedGoodsController@markToolAsRecieved');
Route::get('requestedGoods/markMaterialAsRecieved/{id}', 'RequestedGoodsController@markMaterialAsRecieved');
Route::get('requestedGoods/rejectMaterialOrder/{id}', 'RequestedGoodsController@rejectMaterialOrder');
Route::get('requestedGoods/selectedProject', 'RequestedGoodsController@selectedProject');
Route::get('requestedGoods/returnedToStore/{id}', 'RequestedGoodsController@returnedToStore');
Route::get('requestedGoods/returnedItemToStore/{id}', 'RequestedGoodsController@returnedItemToStore');
Route::get('/returnedItems/{id?}', 'RequestedGoodsController@returnedItems');
Route::get('/returnedTools/{id?}', 'RequestedGoodsController@returnedTools');
Route::get('/storeReturnedItems/{id?}', 'RequestedGoodsController@getStoreReturnedItems');
Route::get('/storeReturnedTools/{id?}', 'RequestedGoodsController@storeReturnedTools');

/////////////////////Reports////////////////////////////////////

Route::get('reports/requestedItemsReports', 'ReportsController@requestedItemsReports');
Route::get('reports/requestedToolsReports', 'ReportsController@requestedToolsReports');
Route::get('reports/recivingItemsReports/{id}', 'ReportsController@recivingItemsReports');
Route::get('reports/inventoryList', 'ReportsController@inventoryList');
Route::get('reports/recivingItems', 'ReportsController@recivingItems');
Route::get('reports/projectReceivingItems/{id}', 'ReportsController@projectReceivingItems');
Route::get('reports/projectReceivingToolsList', 'ReportsController@projectReceivingToolsList');
Route::get('reports/projectRecivingItemsReports/{id}', 'ReportsController@projectRecivingItemsReports');
Route::get('reports/showProjectToolsFormItems/{id}', 'ReportsController@showProjectToolsFormItems');
Route::get('reports/exportToExcel', 'ReportsController@exportToExcel');
Route::get('reports/exportToExcelRequested', 'ReportsController@exportToExcelRequested');
Route::get('reports/exportProjectMaterialsToExcel', 'ReportsController@exportProjectMaterialsToExcel');
Route::get('reports/exportToExcelRecieved', 'ReportsController@exportToExcelRecieved');
Route::get('reports/toolsInventoryList', 'ReportsController@toolsInventoryList');
Route::get('reports/exportToolsToExcel', 'ReportsController@exportToolsToExcel');
Route::get('reports/projectInventoryList/{id}/{noti_id?}', 'ReportsController@projectInventoryList');
Route::get('reports/projectToolsList/{noti_id?}', 'ReportsController@projectToolsList');
Route::get('reports/allProjectsInventory/{id?}', 'ReportsController@allProjectsInventory');
Route::get('reports/downloadFile/{id}', 'ReportsController@downloadFile');
Route::get('reports/downloadToolsFile/{id}', 'ReportsController@downloadToolsFile');

//////////////////Notificaitons////////////////////////////////

Route::get('notifications/viewAll', 'NotificationController@viewAll');
Route::get('notifications/markAllAsRead', 'NotificationController@markAllAsRead');

////////////////////////Projects///////////////////////////////

Route::get('projects/allProjects', 'ProjectsController@allProjects');
Route::get('projects/addProject', 'ProjectsController@addProject');
Route::get('projects/deleteProject/{id?}', 'ProjectsController@deleteProject');
Route::post('projects/saveProject', 'ProjectsController@saveProject');
Route::get('projects/editProject/{id}', 'ProjectsController@editProject');
Route::post('projects/updateProject', 'ProjectsController@updateProject');
Route::get('projects/projectUsers/{id}', 'ProjectsController@projectUsers');
Route::post('projects/upadateProjectUsers', 'ProjectsController@upadateProjectUsers');
Route::get('projects/projectReceivingMaterials', 'ProjectsController@projectReceivingMaterials');
Route::post('projects/projectAddRecivingMaterialsData', 'ProjectsController@projectAddRecivingMaterialsData');
Route::get('projects/projectReceivingTools', 'ProjectsController@projectReceivingTools');
Route::get('projects/requestProjectMaterials/{id}', 'ProjectsController@requestProjectMaterials');
Route::get('projects/getRequestedProjectCategoryItems/{id}', 'ProjectsController@getRequestedProjectCategoryItems');
Route::get('projects/getItemDetails/{id}', 'ProjectsController@getItemDetails');
Route::post('projects/addProjectMaterialRequest', 'ProjectsController@addProjectMaterialRequest');
Route::post('projects/addProjectToolsRequest', 'ProjectsController@addProjectToolsRequest');
Route::get('projects/pendingMaterialRequests/{id?} ', 'ProjectsController@pendingMaterialRequests');
Route::get('projects/storeKeeperApprove/{id}', 'ProjectsController@storeKeeperApprove');
Route::get('projects/storeKeeperReject/{id}', 'ProjectsController@storeKeeperReject');
Route::get('projects/engineerStoreOrders/{id?}', 'ProjectsController@engineerStoreOrders');
Route::get('projects/issuedToEngineers', 'ProjectsController@issuedToEngineers');
Route::get('projects/issuedToSubStores', 'ProjectsController@issuedToSubStores');
Route::get('projects/markItemAsRecievedFromStore/{id}', 'ProjectsController@markItemAsRecievedFromStore');
Route::get('projects/markStoreItemAsIdle/{id}', 'ProjectsController@markStoreItemAsIdle');
Route::get('projects/markStoreToolAsIdle/{id}', 'ProjectsController@markStoreToolAsIdle');
Route::get('projects/markStoreItemAsFunctional/{id}', 'ProjectsController@markStoreItemAsFunctional');
Route::get('projects/markStoreToolAsFunctional/{id}', 'ProjectsController@markStoreToolAsFunctional');
Route::get('projects/returnItemToMainStore/{id}', 'ProjectsController@returnItemToMainStore');
Route::get('projects/returnToolToMainStore/{id}', 'ProjectsController@returnToolToMainStore');
Route::get('projects/idleItems', 'ProjectsController@idleItems');
Route::get('projects/idleTools', 'ProjectsController@idleTools');
Route::get('projects/idleItemsRequests/{id?}', 'ProjectsController@idleItemsRequests');
Route::get('projects/idleToolsRequests/{id?}', 'ProjectsController@idleToolsRequests');
Route::get('projects/requestIdleItems/{id}', 'ProjectsController@requestIdleItems');
Route::get('projects/requestIdleTools/{id}', 'ProjectsController@requestIdleTools');
Route::get('projects/approveRequestIdleItems', 'ProjectsController@approveRequestIdleItems');
Route::get('projects/approveRequestIdleTools', 'ProjectsController@approveRequestIdleTools');
Route::get('projects/rejectIdleItemsRequest', 'ProjectsController@rejectIdleItemsRequest');
Route::get('projects/rejectIdleToolRequest', 'ProjectsController@rejectIdleToolRequest');
Route::get('projects/myIdleItemsRequest/{id?}', 'ProjectsController@myIdleItemsRequest');
Route::get('projects/myIdleToolsRequest/{id?}', 'ProjectsController@myIdleToolsRequest');
Route::get('projects/idleItemsRecevied', 'ProjectsController@idleItemsRecevied');
Route::get('projects/idleToolsRecevied', 'ProjectsController@idleToolsRecevied');
Route::get('projects/storeApproveReturnedItems', 'ProjectsController@storeApproveReturnedItems');
Route::get('projects/storeApproveReturnedTools', 'ProjectsController@storeApproveReturnedTools');
Route::get('projects/storeRejectReturnedItems', 'ProjectsController@storeRejectReturnedItems');
Route::get('projects/storeRejectReturnedTool', 'ProjectsController@storeRejectReturnedTool');
Route::get('projects/storeManagerRejectReturnedItems', 'ProjectsController@storeManagerRejectReturnedItems');
Route::get('projects/storeManagerRejectReturnedTools', 'ProjectsController@storeManagerRejectReturnedTools');
Route::get('projects/projectReceivedMaterials', 'ProjectsController@projectReceivedMaterials');
Route::get('projects/projectReceivedToolsReport', 'ProjectsController@projectReceivedToolsReport');
Route::get('projects/RecivedMaterialsFromSubStore', 'ProjectsController@RecivedMaterialsFromSubStore');
Route::get('projects/projectReturnedMaterials', 'ProjectsController@projectReturnedMaterials');