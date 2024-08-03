<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthUser;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ScholarshipController;
use App\Http\Controllers\ApplicantsController;
use App\Http\Controllers\VideosController;


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

//login
Route::get('/signin', [AuthUser::class, 'signin'])->name('signin');
Route::post('/userhome', [AuthUser::class, 'signinPost'])->name('signin.post');

//signup
Route::get('/signup', [AuthUser::class, 'signup'])->name('signup');
Route::post('/signin', [AuthUser::class, 'signupPost'])->name('signup.post');



//user-tutorial
Route::get('/usertutorial/{type?}', [TutorialController::class, 'showTutorialsByType'])->name('usertutorial.type');
Route::get('/texteditor', function () {return view('texteditor');})->name('texteditor');
Route::get('/usertutorial/{type}/{id}', [TutorialController::class, 'showByTypeAndId'])->name('usertutorial.showByTypeAndId');
//user-quiz
Route::get('/userquizbrief/{type?}', [QuizController::class, 'showQuizByTypeBrief'])->name('userquizbrief.type');
Route::get('/userquiz/{type?}', [QuizController::class, 'showQuizByType'])->name('userquiz.type');
//user-course
Route::get('/', [CourseController::class, 'home'])->name('home');
Route::get('/usercourse', [CourseController::class, 'showCourse'])->name('usercourse');
Route::get('usercoursedetail/{item}', [CourseController::class, 'showCourseDetail'])->name('usercoursedetail');
Route::get('/filterusercourse', [CourseController::class, 'coursefilter']);
Route::get('/instructors/{instructor}', [CourseController::class, 'showinstructors'])->name('userinstructor');
//user-news
Route::get('usernewsdetail/{item}', [NewsController::class, 'showNewsDetail'])->name('usernewsdetail');
Route::get('/usernews', [NewsController::class, 'showNews'])->name('usernews');
Route::get('/filterusernews', [NewsController::class, 'newsfilter'])->name('filterusernews');
//user-cart
Route::get('/cart', [CartController::class, 'viewCart'])->name('cart')->middleware('auth'); 
Route::post('/cart/add/{item}', [CartController::class, 'addToCart'])->name('cart.add');
Route::delete('/cart/remove-Course/{item}', [CartController::class, 'removeCourse'])->name('cart.remove');
//user-order
Route::get('/orderdetail', [OrderController::class, 'viewOrder'])->name('orderdetail');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
Route::get('/orderconfirm', function () {return view('orderconfirm');})->name('orderconfirm');
Route::get('/userorder', [OrderController::class, 'userorder'])->name('userorder');
Route::get('coursedetailpurchase/{item}', [VideosController::class, 'showCourseDetail'])->name('coursedetailpurchase');
//user-scholarship
Route::get('/userscholarship', [ScholarshipController::class, 'userscholarship'])->name('userscholarship');
Route::get('/filteruserscholarship', [ScholarshipController::class, 'scholarshipfilter']);
Route::get('/scholarshipexplaine', function () {return view('scholarshipexplaine');})->name('scholarshipexplaine');
Route::get('/userscholarshipdetail', function () {return view('userscholarshipdetail');})->name('userscholarshipdetail');
Route::get('userscholarshipdetail/{id}', [ScholarshipController::class, 'userscholarshipdetail'])->name('userscholarshipdetail');
//user-appliation
Route::get('/userapplication', [ApplicantsController::class, 'userApplications'])->name('userapplication');
Route::post('/applicant', [ApplicantsController::class, 'store'])->name('applicant.store');
Route::get('/user/applications/filter', [ApplicantsController::class, 'filterApplications'])->name('user.applications.filter');
//user-profile
Route::get('/profile', [AuthUser::class, 'showProfile'])->name('profile.show');
Route::put('/profile', [AuthUser::class, 'update'])->name('profile.update');
//user-typing
Route::get('/typing', function () {return view('typing');})->name('typing');




//uni-home
Route::get('/unihome', [ApplicantsController::class, 'showApplicants'])->name('unihome');
Route::get('/editapplication/{id}', [ApplicantsController::class, 'editApplication'])->name('editapplication');
Route::get('/applicant/{id}/file', [ApplicantsController::class, 'showApplicantFile'])->name('applicants.file');
Route::put('/applicant/{id}/update-status', [ApplicantsController::class, 'updateApplicationStatus'])->name('applicants.update.status');
Route::get('/filterapplicant', [ApplicantsController::class, 'filterapplicant'])->name('filterapplicant');
Route::get('/searchapplicant', [ApplicantsController::class, 'search'])->name('searchapplicant');
Route::get('/export-applicants-csv', [ApplicantsController::class, 'exportApplicantsCSV'])->name('export.applicants.csv');
//uni-scholarship
Route::get('/scholarship', 'App\Http\Controllers\ScholarshipController@index')->name('scholarship');
Route::get('/createscholarship', function () {return view('createscholarship');})->name('createscholarship');
Route::post('storescholarship/', [ScholarshipController::class, 'store'])->name('storescholarship');
Route::get('showscholarship/{id}', [ScholarshipController::class, 'show'])->name('showscholarship');
Route::get('editscholarship/{id}', [ScholarshipController::class, 'edit'])->name('editscholarship');
Route::put('updatescholarship/{id}', [ScholarshipController::class, 'update'])->name('updatescholarship');
Route::delete('destroyscholarship/{id}', [ScholarshipController::class, 'destroy'])->name('destroyscholarship');
Route::get('/searchscholarship', [ScholarshipController::class, 'search'])->name('searchscholarship');
Route::get('/filtercscholarship', [ScholarshipController::class, 'filter']);
//uni-profile
Route::get('/uniprofile', [AuthUser::class, 'showUniProfile'])->name('uniprofile.show');
Route::put('/uniupdateprofile', [AuthUser::class, 'updateUniProfile'])->name('uniprofile.update');






//admin home
Route::get('/adminhome', [OrderController::class, 'adminhome'])->name('adminhome');
Route::get('/order/{id}/detail', [OrderController::class, 'showOrderDetail'])->name('adminorderdetail');
Route::get('/export-orders-csv', [OrderController::class, 'exportOrdersCSV'])->name('export.orders.csv');

//admin-tutorial
Route::get('/createtutorial', function () {return view('createtutorial');})->name('createtutorial');
Route::get('/searchtutorial', [TutorialController::class, 'search'])->name('searchtutorial');
Route::post('storetutorial/', [TutorialController::class, 'store'])->name('storetutorial');
Route::get('/tutorial', [TutorialController::class, 'index'])->name('tutorial');
Route::get('showtutorial/{item}', [TutorialController::class, 'show'])->name('showtutorial');
Route::get('edittutorial/{item}', [TutorialController::class, 'edit'])->name('edittutorial');
Route::put('edittutorial/{item}', [TutorialController::class, 'update'])->name('updatetutorial');
Route::delete('destroytutorial/{item}', [TutorialController::class, 'destroy'])->name('destroytutorial');
//admin-quiz
Route::get('/searchquiz', [QuizController::class, 'search'])->name('searchquiz');
Route::get('/createquiz', function () {return view('createquiz');})->name('createquiz');
Route::post('storequiz/', [QuizController::class, 'store'])->name('storequiz');
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz');
Route::get('showquiz/{item}', [QuizController::class, 'show'])->name('showquiz');
Route::get('editquiz/{item}', [QuizController::class, 'edit'])->name('editquiz');
Route::put('editquiz/{item}', [QuizController::class, 'update'])->name('updatequiz');
Route::delete('destroyquiz/{item}', [QuizController::class, 'destroy'])->name('destroyquiz');
//admin-course
Route::get('/course', 'App\Http\Controllers\CourseController@index')->name('course');
Route::get('/searchcourse', [CourseController::class, 'search'])->name('searchcourse');
Route::get('/filtercourse', [CourseController::class, 'filter']);
Route::get('/createcourse', [CourseController::class, 'create'])->name('createcourse');
Route::post('storecourse/', [CourseController::class, 'store'])->name('storecourse');
Route::get('showcourse/{item}', [CourseController::class, 'show'])->name('showcourse');
Route::get('editcourse/{item}', [CourseController::class, 'edit'])->name('editcourse');
Route::put('updatecourse/{item}', [CourseController::class, 'update'])->name('updatecourse');
Route::post('/destroycourse/{item}', [CourseController::class, 'destroy'])->name('destroycourse');
//admin-video
Route::get('/courses/{course}/videos/show', [CourseController::class, 'showvideo'])->name('video');
Route::get('/courses/{courseId}/videos/create', [VideosController::class, 'create'])->name('videos.create');
Route::post('/courses/{courseId}/create', [VideosController::class, 'store'])->name('videos.store');
Route::get('/edit/video/{video}', [VideosController::class, 'edit'])->name('videos.edit');
Route::put('/update/video/{video}', [VideosController::class, 'update'])->name('videos.update');
Route::delete('/destroy/video/{video}', [VideosController::class, 'destroy'])->name('videos.destroy');



//admin-news
Route::get('/news', 'App\Http\Controllers\NewsController@index')->name('news');
Route::get('/searchnews', [NewsController::class, 'search'])->name('searchnews');
Route::get('/createnews', function () {return view('createnews');})->name('createnews');
Route::post('storenews/', [NewsController::class, 'store'])->name('storenews');
Route::get('shownews/{item}', [NewsController::class, 'show'])->name('shownews');
Route::get('editnews/{item}', [NewsController::class, 'edit'])->name('editnews');
Route::put('updatenews/{item}', [NewsController::class, 'update'])->name('updatenews');
Route::delete('destroynews/{item}', [NewsController::class, 'destroy'])->name('destroynews');
//admin-instructor
Route::get('/instructor', 'App\Http\Controllers\InstructorController@index')->name('instructor');
Route::get('/searchinstructor', [InstructorController::class, 'search'])->name('searchinstructor');
Route::get('/createinstructor', function () {return view('createinstructor');})->name('createinstructor');
Route::post('storeinstructor/', [InstructorController::class, 'store'])->name('storeinstructor');
Route::get('showinstructor/{item}', [InstructorController::class, 'show'])->name('showinstructor');
Route::get('editinstructor/{item}', [InstructorController::class, 'edit'])->name('editinstructor');
Route::put('updateinstructor/{item}', [InstructorController::class, 'update'])->name('updateinstructor');
Route::delete('destroyinstructor/{item}', [InstructorController::class, 'destroy'])->name('destroyinstructor');
//admin-user
Route::get('/user', 'App\Http\Controllers\AuthUser@index')->name('user');
Route::get('/createuser', function () {return view('createuser');})->name('createuser');
Route::post('storeusers/', [AuthUser::class, 'store'])->name('storeusers');
Route::get('showusers/{item}', [AuthUser::class, 'show'])->name('showusers');
Route::get('edituser/{item}', [AuthUser::class, 'editProfile'])->name('edituser');
Route::put('updateusers/{item}', [AuthUser::class, 'updateUser'])->name('updateusers');
Route::post('/deleteusers/{item}', [AuthUser::class, 'deleteUser'])->name('deleteusers');
Route::get('/searchuser', [AuthUser::class, 'search'])->name('searchuser');
Route::get('/filteruser', [AuthUser::class, 'filteruser'])->name('filteruser');
Route::get('/export-users-csv', [AuthUser::class, 'exportUsersCSV'])->name('export.users.csv');

//admin-profile
Route::get('/adminprofile', [AuthUser::class, 'showAdminProfile'])->name('adminprofile.show');
Route::put('/adminupdateprofile', [AuthUser::class, 'updateAdminProfile'])->name('adminprofile.update');





//forgot password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

//signout
Route::get('/home', [AuthUser::class, 'logout'])->name('logout');


