<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/

// Home
Route::view('/', 'pages.home')->name('home');


/*
|--------------------------------------------------------------------------
| Frontend Pages
|--------------------------------------------------------------------------
*/

// Shop
Route::view('/shop', 'pages.shop')->name('shop');

// About
Route::view('/about', 'pages.about')->name('about');

// Story
Route::view('/story', 'pages.story')->name('story');

// Contact
Route::view('/contact', 'pages.contact')->name('contact');

// Cart
Route::view('/cart', 'pages.cart')->name('cart');


/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
|
| Login and Register pages
|
*/

// Login page
Route::view('/login', 'auth.login')->name('login');


// Login form submit
Route::post('/login', function (Request $request) {

    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    /*
    |--------------------------------------------------------------------------
    | Temporary Login
    |--------------------------------------------------------------------------
    |
    | Abhi basic session login rakha gaya hai.
    | Baad me User model/database authentication connect
    | kiya ja sakta hai.
    |
    */

    $request->session()->put([
        'is_admin_logged_in' => true,
        'admin_email' => $request->email,
    ]);

    return redirect()->route('admin.dashboard');

})->name('login.submit');


// Register page
Route::view('/register', 'auth.register')->name('register');


// Register form submit
Route::post('/register', function (Request $request) {

    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'email', 'max:255'],
        'password' => ['required', 'min:6', 'confirmed'],
    ]);

    /*
    |--------------------------------------------------------------------------
    | Temporary Register
    |--------------------------------------------------------------------------
    */

    $request->session()->put([
        'registered_name' => $request->name,
        'registered_email' => $request->email,
    ]);

    return redirect()
        ->route('login')
        ->with('success', 'Registration successful. Please login.');

})->name('register.submit');


/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        // /admin
        Route::redirect('/', '/admin/dashboard')
            ->name('index');

        // /admin/dashboard
        Route::view('/dashboard', 'admin.dashboard')
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Admin Pages
        |--------------------------------------------------------------------------
        */

        // Orders
        Route::view('/orders', 'admin.orders')
            ->name('orders');


        // Products
        Route::view('/products', 'admin.products')
            ->name('products');


        // Categories
        Route::view('/categories', 'admin.categories')
            ->name('categories');


        // Inventory
        Route::view('/inventory', 'admin.inventory')
            ->name('inventory');


        // Customers
        Route::view('/customers', 'admin.customers')
            ->name('customers');


        // Analytics
        Route::view('/analytics', 'admin.analytics')
            ->name('analytics');


        // Notifications
        Route::view('/notifications', 'admin.notifications')
            ->name('notifications');


        // Settings
        Route::view('/settings', 'admin.settings')
            ->name('settings');


        // Help & Support
        Route::view('/helpandsupport', 'admin.helpandsupport')
            ->name('helpandsupport');


        /*
        |--------------------------------------------------------------------------
        | Backward Compatible Help Route
        |--------------------------------------------------------------------------
        */

        // /admin/help
        Route::redirect('/help', '/admin/helpandsupport')
            ->name('help');
    });


/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', function (Request $request) {

    // Remove admin session
    $request->session()->forget([
        'is_admin_logged_in',
        'admin_email',
    ]);

    // Destroy current session
    $request->session()->invalidate();

    // Generate new CSRF token
    $request->session()->regenerateToken();

    return redirect()->route('home');

})->name('logout');