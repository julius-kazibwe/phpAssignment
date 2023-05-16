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

Route::get('/update_prescription/{id}', 'App\Http\Controllers\PrescriptionController@update2');
Route::put('/edit_prescription/{id}', 'App\Http\Controllers\PrescriptionController@edit2')->name('edit2');
Route::get('/read_prescription', 'App\Http\Controllers\PrescriptionController@show');

Route::get('/read_prescription/{id}', 'App\Http\Controllers\PrescriptionController@show2');
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
Route::get('/edit_treat/{record_id}', 'App\Http\Controllers\TreatmentController@edit1')->name('edit1');

Route::get('/read_treat/{id}', 'App\Http\Controllers\TreatmentController@show');
Route::get('/read_treatment/{id}', 'App\Http\Controllers\TreatmentController@read');

Route::get('/delete_treat/{id}', 'App\Http\Controllers\TreatmentController@destroy');

Route::get("/report_treat",'App\Http\Controllers\TreatmentController@reports');
Route::get("/searchtreat",'App\Http\Controllers\TreatmentController@search');


// for patients dashboard
Route::resource('patient', 'App\Http\Controllers\PatientDashboardController');
Route::resource('search', 'App\Http\Controllers\SearchController');




//Appointmentadmin
Route::resource('appointment', 'App\Http\Controllers\AppointmentController');
Route::get('/appointment/create', 'App\Http\Controllers\AppointmentController@create');
Route::post('/appointment/check', 'App\Http\Controllers\AppointmentController@check')->name('appointment.check');
Route::post('/appointment/update', 'App\Http\Controllers\AppointmentController@updateTime')->name('update');



//center
Route::get('/center', 'App\Http\Controllers\CenterManagementController@index');
Route::post('/centers/search', 'App\Http\Controllers\CenterManagementController@searchCenter');
Route::view('/add/newCenter', 'center.createCenter');
Route::post('/insert_center', 'App\Http\Controllers\CenterManagementController@store');

  
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

Route::delete('/userdelete/{id}', 'App\Http\Controllers\PatientDashboardController@destroy');

Route::prefix('manage/schedule')->group(function () {
    Route::get('/center/{center_id}', 'App\Http\Controllers\ScheduleController@schedule')->name('schedule.center');
    Route::post('/center/{center_id}', 'App\Http\Controllers\ScheduleController@store')->name('schedule.store');
});
