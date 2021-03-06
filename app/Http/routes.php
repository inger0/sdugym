<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

Route::post('/test', 'ExcelController@test');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

/*Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});*/

/*用户 有关路由 以“/api/user”开头*/
Route::group(['prefix' => '/api/users'],function (){

    Route::post('/i/auth',"UserController@login");
    Route::delete('/i/auth','UserController@logout');/*注销登录*/

    Route::post('/','UserController@create'); /*管理员 创建用户*/
    Route::get('/i/info','UserController@info'); /*返回用户个人信息*/
    Route::put('/i/info','UserController@setinfo');/*修改个人信息*/

    Route::put('/i/pass','UserController@setPassword');/*修改个人密码*/
    Route::get('/info','UserController@allinfo');/*获取当前用户权限下面所有用户的信息*/
    Route::delete('/i/people/{schoolnum}','UserController@delete');/*删除用户*/
    Route::get('/i/gp','UserController@getPower');/* h*/
    /*内务管理员*/
    Route::put('/i/people/{schoolnum}/auth','UserController@changePower');/*root为其他管理员添加权限或删除权限*/

    Route::put('/i/people/pass','UserController@forgetPass');/*root为其他管理员初始化密码*/

});

/*场馆日常管理表格 以/api/schedules 开头*/
Route::group(['prefix' => '/api/schedules/campus/{campus}/gym/{gym}'],function (){
    Route::get('/','ScheduleController@showData'); /*根据 日期获取校区场馆的使用情况*/
    Route::post('/','ScheduleController@addData'); /*录入数据*/
    Route::put('/','ScheduleController@updateData'); /*修改 场馆的使用情况*/
});

/*场馆申请表格 校内 申请  */
Route::group(['prefix'=>'/api/apply'],function(){
	Route::post('/','ApplicationController@doApply');/*提交场馆申请*/
	Route::get('/campus/{campus}/gym/{gym}','ApplicationController@showApply');/*show application for adminitor */

    Route::put('/{id}','ApplicationController@checkApply');/*adminitor submit state of application-checked */

    Route::delete('/{id}','ApplicationController@delApply');/*adminitor delete application form*/
    Route::get('/tel/{tel}','ApplicationController@getApplyByPhone');/*show application for adminitor */

    Route::get('/export','ApplicationController@exportApply');/*export application for adminitor */

});
/* 场馆申请表格 训练班 申请 */
Route::group(['prefix'=>'/api/apply/train'],function(){
	Route::post('/','ApplicationController@trainDoApply');/*提交场馆申请*/
	Route::get('/campus/{campus}/gym/{gym}','ApplicationController@trainShowApply');/*show train-application for adminitor */

	Route::put('/{id}','ApplicationController@trainCheckApply');/*adminitor submit state of train-application-checked */
    Route::delete('/{id}','ApplicationController@trainDelApply');/*adminitor delete train-application-form*/
    Route::get('/tel/{tel}','ApplicationController@getTrainApplyByPhone');/*show application for adminitor */

    Route::get('/export','ApplicationController@exportTrainApply');/*export application for adminitor */

});
/*留言板接口 */
Route::group(['prefix'=>'/api/messages'],function(){
	Route::post('/','MessageController@addMessages');
	Route::get('/type/{type}','MessageController@showMessages');
    Route::get('/all/type/{type}','MessageController@showAllMessages');

    Route::get('/id/{id}','MessageController@getContactInfo');
    Route::delete('/id/{id}','MessageController@delMessage');

    Route::put('/id/{id}','MessageController@checkMessage'); /*审核 留言*/

});

/* 器材管理 */
Route::group(['prefix'=>'/api/equipments'],function(){
	Route::post('/','EquipmentController@postRegistry');
	Route::get('/campus/{campus}','EquipmentController@getRegistry');
	Route::delete('/id/{id}','EquipmentController@delRegistry');
    Route::put('/id/{id}','EquipmentController@putRegistry');

    Route::get('/name/{name}','EquipmentController@getRegistryByName');
    Route::get('/export','EquipmentController@exportEquipment');

});
/* 器材调用 管理  */
Route::group(['prefix'=>'/api/equipments/adjust'],function(){
	Route::post('/','EquipmentController@postAdjust');
	Route::get('/campus/{campus}','EquipmentController@getAdjust');
	Route::delete('/id/{id}','EquipmentController@delAdjust');


});

/* 新闻管理 */
Route::group(['prefix'=>'/api/news'],function(){
	Route::post('/content','NewsController@addNews');
	Route::post('/picture','NewsController@uploadImg');
	Route::get('/list','NewsController@getNewsList');
	Route::get('/list/all','NewsController@getNewsListAll');
	Route::get('/content/id/{id}','NewsController@getNewsContent');
    Route::put('/content/id/{id}','NewsController@editNewsContent');
	Route::put('/id/{id}','NewsController@checkNews');
	Route::delete('/id/{id}','NewsController@delNews');
	Route::delete('/picture/id/{id}','NewsController@delImg');
	Route::get('/picture/path/{path}','NewsController@getImg');
});

/* 通知管理 */
Route::group(['prefix'=>'/api/notices'],function(){
    Route::post('/content','NoticeController@addNotice');
    Route::get('/list','NoticeController@getNoticeList');
    Route::get('/list/all','NoticeController@getNoticeListAll');
    Route::get('/content/id/{id}','NoticeController@getNoticeContent');
    Route::put('/content/id/{id}','NoticeController@editNoticeContent');
    Route::put('/id/{id}','NoticeController@checkNotice');
    Route::delete('/id/{id}','NoticeController@delNotice');
});

/*文档管理*/
Route::group(['prefix'=>'/api/documents'],function(){
	Route::post('/','DocumentController@uploadDoc');
	Route::get('/','DocumentController@getList');
	Route::get('/id/{id}','DocumentController@downDoc');
	Route::delete('/id/{id}','DocumentController@deDoc');
	
});

/*财务管理接口 */
Route::group(['prefix'=>'/api/finances'],function(){
	Route::post('/','FinanceController@addFinance');
	Route::put('/id/{id}','FinanceController@editFinance');
    Route::put('/recover/id/{id}','FinanceController@recoverFinance');

	Route::delete('/id/{id}','FinanceController@delFinance');
	Route::get('/','FinanceController@showFinance');
    Route::get('/export','FinanceController@exportFinance');

});

/*校区 和 场馆对应情况*/
Route::group(['prefix'=>'/api/campus/gym'],function(){
    Route::get('/','CampusGymController@selectCG');
    Route::put('/','CampusGymController@updateCG');
    Route::post('/','CampusGymController@addCG');
});


