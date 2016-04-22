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


//Route::group(['middleware' => 'auth'], function () {
//    Route::get('/auth', function ()    {
//        // Uses Auth Middleware
//    });
//
//});

//Route::resource('photo', 'PhotoController');

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    })->middleware('guest');
    Route::get('welcome', function () {
        return view('welcome');
    });
    /**
     * 切片控制
     */
    Route::resource('element', 'ElementController');
    Route::get('getElementsByParentId', 'ElementController@getElementsByParentId');
    Route::get('getOwnElements', 'ElementController@getOwnElements');
    Route::get('addElement', 'ElementController@addElement');
    Route::post('publishElement', 'ElementController@publishElement');

    /**
     * 课件控制
     */
    Route::resource('courseware', 'CoursewareController');


//    Route::get('/test', "ElementController@test");

    //从数据库中取出对应user的email
//    Route::get('api/users/{user}', function (App\User $user) {
//        return $user->email;
//    });


    //输入/paramTest/abc,在页面显示param:abc
    //加上问号,表示可选,如果不输入参数,返回param:
    //where方法限制id只能是数字
    //需要设置全局的参数限制,请在RouteServiceProvider->boot中设置
//    Route::get('/paramTest/{id?}', function ($id = null) {
//        return 'param:' . $id;
//    })->where('id', '[0-9]+');


    //多个参数的传递
//    Route::get('posts/{post}/comments/{comment}', function ($postId, $commentId) {
//        //
//    });


    //name routes
    //可以在router()方法中使用
//    Route::get('user/{id}/profile', ['as' => 'profileNameRoute', function ($id) {
//        return 'id:'.$id;
//    }]);
//    echo $url = route('profileNameRoute', ['id' => 1]);


//    Route::get('/tasks', 'TaskController@index');
//    Route::post('/task', 'TaskController@store');
//    Route::delete('/task/{task}', 'TaskController@destroy');


    //影响login,logout,register,不能删除
    //这行定义了登录相关的路由
    Route::auth();

});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
