<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Frontend\CustomerController;
use App\Http\Controllers\Frontend\MarriageController;
use App\Http\Controllers\frontend\CustomerPasswordResetController;

Route::get('/', [MarriageController::class, 'index']);

Route::get('customer/register', [CustomerController::class, 'register'])->name('customer.register');
Route::post('customer/store', [CustomerController::class, 'storecustomer'])->name('customer.store');
Route::get('customer/login', [CustomerController::class, 'login'])->name('customer.login');
Route::post('customer/login', [CustomerController::class, 'authenticate']);
Route::get('customer/email-verify', [CustomerController::class, 'verify'])->name('customer.verify');
Route::post('customer/email-verify', [CustomerController::class, 'sendVerifyMail']);
Route::get('customer/email-verified', [CustomerController::class, 'verifyEmail'])->name('customer.email.verified');
Route::get('forget-password', [CustomerController::class, 'forget'])->name('customer.forgot-password');

Route::post('forget-password', [CustomerPasswordResetController::class, 'forgetMail']);
Route::get('customer/{token}/password-reset', [CustomerPasswordResetController::class, 'resetView'])->name('customer.reset.view');
Route::post('customer/password-reset', [CustomerPasswordResetController::class, 'resetPassword'])->name('customer.password.reset');
Route::get('customer/profile', [CustomerController::class, 'profile'])->name('customer.profile');
Route::get('customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
Route::post('customer/{id}/edit', [CustomerController::class, 'update']);
Route::get('customer/matches', [CustomerController::class, 'matches'])->name('customer.matches');
Route::get('customer/logout', [CustomerController::class, 'logout'])->name('customer.logout');
Route::get('customer/detail', [CustomerController::class, 'detail'])->name('customer.details');
Route::post('/customer-details', [CustomerController::class, 'getCustomerById']);

Route::post('/search-opposite-gender', [CustomerController::class, 'searchOppositeGender']);
Route::get('/search-by-id/{id}', [CustomerController::class, 'searchById']);


Route::get('auth/google', [CustomerController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('auth/google/callback', [CustomerController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('auth/google', [CustomerController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('auth/google/callback', [CustomerController::class, 'handleGoogleCallback'])->name('google.callback');

//enquiry
Route::get('enquiry', [EnquiryController::class, 'index'])->name('guest.enquiry');
Route::post('enquiry', [EnquiryController::class, 'store']);

Route::group(['middleware' => 'guest'], function () {
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'authenticate']);
});


Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials');
    Route::get('/testimonials/create', [TestimonialController::class, 'create'])->name('testimonials.create');
    Route::post('/testimonials/create', [TestimonialController::class, 'store']);
    Route::get('/testimonials/edit/{id}', [TestimonialController::class, 'edit'])->name('testimonials.edit');
    Route::post('/testimonials/edit/{id}', [TestimonialController::class, 'update']);
    Route::get('testimonial/delete/{id}', [TestimonialController::class, 'delete'])->name('testimonials.delete');

    //FAQ
    Route::get('/faq', [FaqController::class, 'index'])->name('faq');
    Route::get('/faq/create', [FaqController::class, 'create'])->name('faq.create');
    Route::post('/faq/create', [FaqController::class, 'store']);
    Route::get('/faq/edit/{id}', [FaqController::class, 'edit'])->name('faq.edit');
    Route::post('/faq/edit/{id}', [FaqController::class, 'update']);
    Route::get('/faq/delete/{id}', [FaqController::class, 'delete'])->name('faq.delete');
    Route::post('faq/bulk', [FaqController::class, 'bulk'])->name('faq.bulk');

    //Pages
    Route::get('pages', [PageController::class, 'index'])->name('pages');
    Route::post('pages/bulk_operation', [PageController::class, 'bulk'])->name('pages.bulk');
    Route::get('pages/create', [PageController::class, 'create'])->name('pages.create');
    Route::post('pages/create', [PageController::class, 'store'])->name('pages.create');
    Route::get('pages/{id}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::post('pages/{id}/edit', [PageController::class, 'update']);
    Route::get('pages/{id}/destroy', [PageController::class, 'destroy'])->name('pages.delete');

    //user
    Route::get('user', [UserController::class, 'index'])->name('user');
    Route::get('user/{id}/destroy', [UserController::class, 'destroy'])->name('user.delete');

});
