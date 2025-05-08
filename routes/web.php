<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CategoryController;
use App\Models\User;
use App\Models\Vacancy;
use App\Models\Category;
use App\Models\Application;
use Illuminate\Support\Facades\Storage;
use App\Http\Middleware\AdminMiddleware;

//FOR GUESTS
Route::get('/',[JobController::class,'profileJobs'])->name('home');
Route::post('/inquiry', [JobController::class, 'inquiry'])->name('inquiry.submit');

Route::get('/dashboard', [Jobcontroller::class, 'dashboardView'])->middleware(['auth', 'verified'])->name('dashboard');

//FOR LOGGED IN ACTIONS
Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/jobs',[JobController::class,'listJobs'])->name('jobs');
});

require __DIR__.'/auth.php';


//FOR ADMINS ONLY
Route::middleware('admin')->group(function () {
    Route::get('/category',[CategoryController::class, 'category'])->name('category');
    Route::post('/category',[CategoryController::class, 'categoryAdd']);
    Route::get('/delete-category/{id}',[CategoryController::class, 'deleteCategory'])->where('id','[0-9]+')->middleware(['password.confirm']);
    
    Route::get('/inquiry-lists',[JobController::class,'inquiryList'])->name('inquiry');
    Route::get('/delete-inquiry/{id}',[JobController::class,'deleteInquiry'])->where('id','[0-9]+')->middleware(['password.confirm']);
    
    Route::get('/allreviews',[ReviewController::class, 'viewReview'])->name('reviews');
    Route::get('/review-details/{id}',[ReviewController::class, 'reviewDetails'])->name('reviewDetails');
    Route::post('/review-details',[ReviewController::class,'detailsEdit']);
    Route::get('/delete-review/{id}',[ReviewController::class,'deleteReview'])->where('id','[0-9]+')->middleware(['password.confirm']);
    
    Route::get('/users',[UserController::class,'users'])->name('users');
    Route::get('/delete-user/{id}', [UserController::class, 'delete'])->middleware(['password.confirm'])->name('users.delete');
    
    Route::delete('/jobs/delete-today', [JobController::class, 'deleteTodayDeadline'])->middleware(['password.confirm'])->name('jobs.deleteToday');
});

//FOR EMPLOYERS ONLY
Route::middleware('employer')->group(function(){
    Route::get('/add-job', [JobController::class, 'addJobForm'])->name('addjobs');
    Route::post('/add-job', [JobController::class, 'addJob']);
    Route::get('/my-jobs',[JobController::class,'listMyJobs'])->name('myjob');
    Route::get('/edit-job/{id}',[JobController::class,'editJobForm']);
    Route::post('/edit-job',[JobController::class,'editJob']);
    Route::get('/delete-job/{id}',[JobController::class,'deleteJob'])->where('id','[0-9]+')->middleware(['password.confirm']);
    
    Route::get('/appliers/{id}',[ApplicationController::class,'appliers'])->name('appliers');
    Route::get('/applicant-details/{id}',[ApplicationController::class,'applierDetails'])->name('details');
    Route::post('/applicant-details',[ApplicationController::class,'detailsEdit']);
});

//FOR USERS ONLY
Route::middleware('user')->group(function(){
    
    Route::get('/application',[ApplicationController::class,'AppList'])->name('application');
    Route::get('/create-application/{id}',[ApplicationController::class,'ApplicationForm'])->name('createApp');
    Route::post('/create-application/{id}',[ApplicationController::class,'ApplicationPost']);
    Route::get('/delete-application/{id}',[ApplicationController::class,'deleteApplication'])->where('id','[0-9]+')->middleware(['password.confirm'])->name('delete.application');
    
    
});

//FOR BOTH USERS AND EMPLOYERS
Route::middleware('useremployer')->group(function(){
    Route::get('/review',[ReviewController::class,'review'])->name('review');
    Route::post('/create-review',[ReviewController::class,'createReview']);
});





Route::get('/fake-user', function(){
    echo "Generating fake user....";
    
    // User::factory()->create();
    // User::factory()->count(10)->create();
    User::factory()->count(50)->create(['role'=>'1']); // to override the name as we want. the name will be same for all the data and others will be fake
    

   

});

Route::get('/fake-jobs',function(){
    echo "Generating Fake jobs for you";
    Vacancy::factory()->count(20)->for(
        Category::factory()->create(['name' => 'Banking'])
    )->create(); // for means belongs to
});

Route::get('/fake-applications',function(){
    echo "Generating Fake Applications for you";
    Application::factory()->count(10)->for(
        Vacancy::factory()->create(['title' => 'Railroad Inspector'])
    )->create(); // for means belongs to
});



