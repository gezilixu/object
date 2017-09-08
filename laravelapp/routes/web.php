<?php

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
    return view('welcome');
});
Route::get("/admin",function() {
	echo "123";
});

Route::get("/admins",function() {
	return view("test");
});
Route::get("/ss",function(){
	echo "Laravel";
});
Route::post("/sss",function(){
	echo "<pre>";
	var_dump($_POST['uname']);
});
Route::any("/hello",function(){
	echo "hello laravel!";
});
Route::get("/s/{name}/m/{user}",function($name,$user){
	echo "用户名为：".$name.':'.$user;
});
Route::get("/sd/{name?}",function($name="laravel"){
	echo "用户名为{$name}";
})->where("name",'[A-Za-z]+');
// Route::get("/sd/{name?}",function($name="laravel"){
// 	echo "用户名为{$name}";
// })->where("name",'[A-Za-z]+');
Route::get("/sa/{name}",function($name){
	echo "用户名为：".$name;
});
Route::get("/admin/member",['as' => 'member',function(){
	return "hello world";
}]);
Route::get("/hekko",function(){
	return redirect()->route('member');
});
Route::group(['middleware'=>'test:male'],function(){
    Route::get('/write/laravelacademy',function(){
        //使用Test中间件
   });
    Route::get('/update/laravelacademy',function(){
       //使用Test中间件
    });
});
 
Route::get('/age/refuse',['as'=>'refuse',function(){
    return "只有十八岁的男性可以进去！";
}]);
Route::get('/age/success',['as'=>'success',function(){
    return "你长大了！";
}]);
// 判定是否有session
Route::group(['middleware'=>'name'],function(){
    Route::get('/ss/admins',function(){
        //使用Test中间件
   });
    Route::get('/ss/adminss',function(){
       //使用Test中间件
    });
});
// 如果存在session 则登录成功 否则失败
Route::get('/user/login',['as'=>'login',function(){
	return "请先登录";
}]);
Route::get('/user/success',['as'=>'loginsuccess',function(){
    return "你长大了aaa！";
}]);
//csrf 保护
Route::get('testCsrf',function(){
    $csrf_field = csrf_field();
    $html = <<<GET
        <form method="POST" action="/testCsrf">
            
            <input type="submit" value="Test"/>
        </form>
GET;
    return $html;
});
 
Route::post('testCsrf',function(){
    return 'Success!';
});
Route::get("/login",function(){
	return view("login");
});
Route::post("/sss",function(){
	echo "<pre>";
	dd($_POST);
});
// 注册test控制器路由
Route::resource('post','PostController');