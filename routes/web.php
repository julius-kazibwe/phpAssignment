<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\SweetAlertDemo;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ProductSearchController;
use App\Http\Controllers\ProductViewController;
use App\Http\Controllers\ProductAdminDashController;
use App\Http\Controllers\PaitientOrderDashController;
use App\Http\Controllers\PatientPriscriptionOrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShoppingCartController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\DoctorManagementController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\UserTypeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/




//DoctorAdmin
Route::get('/AdminHome', 'PagesController@adhome');
Route::get('/admin', 'PostsController@admhome')->middleware('auth_admin');
Route::get('/admin', 'App\Http\Controllers\FeedbackController@fedadmin')->middleware('auth_admin');

Route::get('/welcome', 'SweetAlertDemo@index');



use \App\Feedback;
Route::get('/', function(){
    $feedbacks = Feedback::all();
    return view('main.index', compact('feedbacks'));
});

Route::view('/signin', 'main.login');

Route::view('/registerp', 'auth.registerp');



Auth::routes();

Route::get('/usermanager', [UserTypeController::class, 'manage']);


//Prescription

Route::get('/home_prescription', 'App\Http\Controllers\PrescriptionController@home2');

Route::get('/create_prescription', function(){
    return view('create_prescription');
});

Route::post('/insert_prescription', 'App\Http\Controllers\PrescriptionController@add2');

Route::get('/update_prescription/{id}', 'App\Http\Controllers\PrescriptionController@edit2');
Route::get('/edit_prescription/{id}', 'App\Http\Controllers\PrescriptionController@update2');

Route::get('/read_prescription/{id}', 'App\Http\Controllers\PrescriptionController@show');
Route::get('/delete_prescription/{id}', 'App\Http\Controllers\PrescriptionController@destroy');


Route::get("/report_prescription",'App\Http\Controllers\PrescriptionController@reports');
Route::get("/searchpre",'App\Http\Controllers\PrescriptionController@search');


//Treatment

Route::get('/home_treat', function(){
    return view('home_treat');
});
Route::get('/home_treat', 'App\Http\Controllers\TreatmentController@index1');
Route::get('/create_treat', function(){
    return view('create_treat');
});

Route::post('/insert_treatment', 'App\Http\Controllers\TreatmentController@add1');

Route::get('/update_treat/{id}', 'App\Http\Controllers\TreatmentController@update1');
Route::get('/edit_treat/{id}', 'App\Http\Controllers\TreatmentController@edit1');

Route::get('/read_treat/{id}', 'App\Http\Controllers\TreatmentController@show');
Route::get('/read_treatment/{id}', 'App\Http\Controllers\TreatmentController@read');

Route::get('/delete_treat/{id}', 'App\Http\Controllers\TreatmentController@destroy');

Route::get("/report_treat",'App\Http\Controllers\TreatmentController@reports');
Route::get("/searchtreat",'App\Http\Controllers\TreatmentController@search');


// for patients dashboard
Route::resource('patient', 'App\Http\Controllers\PatientDashboardController');
Route::resource('search', 'App\Http\Controllers\SearchController');

// order
Route::get('/shoppingcart', function () {
    return view('product_order_system.ShoppingCart');
});

Route::get('/search-product', 'App\Http\Controllers\ProductSearchController@index');

Route::get('/search-product', 'App\Http\Controllers\ProductSearchController@index');
Route::get('/viewproduct/{id}', 'App\Http\Controllers\ProductSearchController@show');
Route::get('/productshow','ProductViewController@index');
Route::post('search-product','App\Http\Controllers\ProductSearchController@search');
Route::get('/order-admindash','App\Http\Controllers\ProductAdminDashController@index')->middleware('auth');
Route::post('order-admindash','App\Http\Controllers\ProductAdminDashController@search');
Route::post('/print_order_row','App\Http\Controllers\ProductAdminDashController@print_row');
Route::post('admindash_status','App\Http\Controllers\ProductAdminDashController@updatesatus');
Route::get('/paitientorderdash','App\Http\Controllers\PaitientOrderDashController@indexpaitent')->middleware('auth');
Route::post('/paitientorderdash/general','App\Http\Controllers\PaitientOrderDashController@searchgeneral');
Route::post('/paitientorderdash/medical','App\Http\Controllers\PaitientOrderDashController@searchmedical');
Route::post('paitientorderdash/edit','App\Http\Controllers\PaitientOrderDashController@showedit');
Route::post('paitientorderdash/updateorder','App\Http\Controllers\PaitientOrderDashController@updates');
Route::resource('paitintorder','App\Http\Controllers\PaitientOrderDashController');
Route::get('/user-prescriptions','PatientPriscriptionOrderController@show')->middleware('auth');
Route::post('/user-prescriptions','PatientPriscriptionOrderController@search');
Route::get('/add-to-cart/{id}',[
    'uses'=>'ProductController@getAddToCart',
    'as'=>'product.addToCart'
]);

Route::get('/reduce-product/{id}',[
    'uses'=>'ProductController@getReduceByone',
    'as'=>'product.reducedbyone'
]);


Route::get('/show-cart',[
    'uses'=>'ProductController@getCart',
    'as'=>'product.show-cart'
])->middleware('auth');
Route::get('/getcheckout',[
    'uses'=>'ProductController@getcheckout',
    'as'=>'product-chek-out'
]);
Route::get('go-to-cart','ShoppingCartController@index');



//Appointmentadmin
Route::resource('appointment', 'App\Http\Controllers\AppointmentController');
Route::get('/appointment/create', 'App\Http\Controllers\AppointmentController@create');
Route::post('/appointment/check', 'App\Http\Controllers\AppointmentController@check')->name('appointment.check');
Route::post('/appointment/update', 'App\Http\Controllers\AppointmentController@updateTime')->name('update');



//doctor
Route::get('/doctor', 'App\Http\Controllers\DoctorManagementController@index');
  
  
//VaccineAppointment
  Route::get('/appointment', 'App\Http\Controllers\FrontendController@index');
  Route::get('/new-appointment/{doctorId}/{date}', 'App\Http\Controllers\FrontendController@show')->name('create.appointment');
  Route::post('/book/appointment', 'App\Http\Controllers\FrontendController@store')->name('booking.appointment');
  Route::get('/my-booking', 'App\Http\Controllers\FrontendController@myBookings')->name('my.booking');

  
  
//patientlist
    
Route::get('/patients', 'App\Http\Controllers\PatientlistController@index')->name('patient');
Route::get('/patients/all', 'App\Http\Controllers\PatientlistController@allTimeAppointment')->name('all.appointments');
Route::get('/status/update/{id}', 'App\Http\Controllers\PatientlistController@toggleStatus')->name('update.status');

//dashbord
Route::get('/dashboard/{type}', 'App\Http\Controllers\DashboardController@index')->name('dashboard');
