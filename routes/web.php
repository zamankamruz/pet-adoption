<?php
// File: web.php
// Path: /routes/web.php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\AdoptionController;
use App\Http\Controllers\RehomingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPetController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminAdoptionController;
use App\Http\Controllers\Admin\AdminMessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/about/mission', [HomeController::class, 'mission'])->name('about.mission');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/care-guide', [HomeController::class, 'careGuide'])->name('care-guide');
Route::get('/faq/adopters', [HomeController::class, 'faqAdopters'])->name('faq.adopters');
Route::get('/care-guide/cats', [HomeController::class, 'catGuides'])->name('care-guide.cats');
Route::get('/care-guide/dogs', [HomeController::class, 'dogGuides'])->name('care-guide.dogs');
Route::get('/faq/adopters', [HomeController::class, 'faqAdopters'])->name('faq.adopters');
Route::get('/faq/rehomers', [HomeController::class, 'faqRehomers'])->name('faq.rehomers');

// Adopt Routes
Route::get('/adopt/how-it-works', [HomeController::class, 'howItWorks'])->name('adopt.how-it-works');


// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [LoginController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [LoginController::class, 'showResetPasswordForm'])->name('password.reset');
    Route::post('/reset-password', [LoginController::class, 'resetPassword'])->name('password.update');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Pet Routes (Public)
Route::prefix('pets')->name('pets.')->group(function () {
    Route::get('/', [PetController::class, 'index'])->name('index');
    Route::get('/search', [SearchController::class, 'pets'])->name('search');
    Route::get('/filter', [PetController::class, 'filter'])->name('filter');
    Route::get('/{pet}', [PetController::class, 'show'])->name('show');
    Route::get('/category/{category}', [PetController::class, 'byCategory'])->name('category');
    Route::get('/breed/{breed}', [PetController::class, 'byBreed'])->name('breed');
    Route::get('/location/{location}', [PetController::class, 'byLocation'])->name('location');
});


// Adoption Routes (Public - can view, but need auth for requests)
Route::prefix('adoption')->name('adoption.')->group(function () {
    Route::get('/', [PetController::class, 'index'])->name('index');
    Route::get('/how-it-works', [AdoptionController::class, 'howItWorks'])->name('how-it-works');
    Route::get('/requirements', [AdoptionController::class, 'requirements'])->name('requirements');
    
    // Protected adoption routes
    Route::middleware('auth')->group(function () {
        Route::get('/{pet}/request', [AdoptionController::class, 'requestForm'])->name('request');
        Route::post('/{pet}/request', [AdoptionController::class, 'submitRequest'])->name('request.submit');
        Route::get('/requests', [AdoptionController::class, 'userRequests'])->name('requests');
        Route::get('/requests/{adoption}', [AdoptionController::class, 'showRequest'])->name('requests.show');
        Route::post('/requests/{adoption}/cancel', [AdoptionController::class, 'cancelRequest'])->name('requests.cancel');
    });
});



// Rehoming Routes
Route::prefix('rehoming')->name('rehoming.')->group(function () {
    Route::get('/', [RehomingController::class, 'index'])->name('index');
    Route::get('/how-it-works', [RehomingController::class, 'howItWorks'])->name('how-it-works');
    Route::get('/faq/rehomers', [RehomingController::class, 'faqRehomers'])->name('faq');
    
    // Protected rehoming routes
    Route::middleware('auth')->group(function () {
        Route::get('/start', [RehomingController::class, 'start'])->name('start');
        Route::get('/step1', [RehomingController::class, 'step1'])->name('step1');
        Route::post('/step1', [RehomingController::class, 'storeStep1'])->name('step1.store');
        Route::get('/step2', [RehomingController::class, 'step2'])->name('step2');
        Route::post('/step2', [RehomingController::class, 'storeStep2'])->name('step2.store');
        Route::get('/step3', [RehomingController::class, 'step3'])->name('step3');
        Route::post('/step3', [RehomingController::class, 'storeStep3'])->name('step3.store');
        Route::get('/complete', [RehomingController::class, 'complete'])->name('complete');
        Route::get('/my-pets', [RehomingController::class, 'myPets'])->name('my-pets');
        Route::get('/my-pets/{pet}', [RehomingController::class, 'showMyPet'])->name('my-pets.show');
        Route::get('/my-pets/{pet}/edit', [RehomingController::class, 'editMyPet'])->name('my-pets.edit');
        Route::put('/my-pets/{pet}', [RehomingController::class, 'updateMyPet'])->name('my-pets.update');
        Route::delete('/my-pets/{pet}', [RehomingController::class, 'deleteMyPet'])->name('my-pets.delete');
    });
});


// User Dashboard Routes (Protected)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    
    // User Profile Routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/overview', [UserController::class, 'overview'])->name('overview');
        Route::get('/profile', [UserController::class, 'profile'])->name('profile');
        Route::put('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
        Route::get('/settings', [UserController::class, 'settings'])->name('settings');
        Route::put('/settings', [UserController::class, 'updateSettings'])->name('settings.update');
        Route::delete('/account', [UserController::class, 'deleteAccount'])->name('account.delete');
        Route::put('/password-update', [UserController::class, 'update'])->name('password-update');
        Route::get('/notifications', [UserController::class, 'notifications'])->name('settings.notifications');
        Route::get('/settings.privacy', [UserController::class, 'privacy'])->name('settings.privacy');
        Route::get('/export', [UserController::class, 'export'])->name('export');




        
        // Favorites
        Route::get('/favorites', [FavoriteController::class, 'index'])->name('favorites');
        Route::post('/favorites/{pet}', [FavoriteController::class, 'toggle'])->name('favorites.toggle');
        Route::delete('/favorites/{pet}', [FavoriteController::class, 'remove'])->name('favorites.remove');
        
        // Messages
        Route::get('/messages', [MessageController::class, 'index'])->name('messages');
        Route::get('/messages/{conversation}', [MessageController::class, 'show'])->name('messages.show');
        Route::post('/messages/{user}', [MessageController::class, 'store'])->name('messages.store');
        Route::post('/messages/{conversation}/reply', [MessageController::class, 'reply'])->name('messages.reply');
        Route::delete('/messages/{message}', [MessageController::class, 'delete'])->name('messages.delete');
        Route::post('/messages/{conversation}/mark-read', [MessageController::class, 'markAsRead'])->name('messages.mark-read');
        
        // Adoptions
        Route::get('/adoptions', [UserController::class, 'adoptions'])->name('adoptions');
        Route::get('/adoptions/{adoption}', [UserController::class, 'showAdoption'])->name('adoptions.show');
        
        // Rehomed Pets
        Route::get('/rehomed', [UserController::class, 'rehomedPets'])->name('rehomed');
    });
});

// Admin Routes (Protected)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/analytics', [AdminController::class, 'analytics'])->name('analytics');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    
    // Admin Pet Management
    Route::prefix('pets')->name('pets.')->group(function () {
        Route::get('/', [AdminPetController::class, 'index'])->name('index');
        Route::get('/create', [AdminPetController::class, 'create'])->name('create');
        Route::post('/', [AdminPetController::class, 'store'])->name('store');
        Route::get('/{pet}', [AdminPetController::class, 'show'])->name('show');
        Route::get('/{pet}/edit', [AdminPetController::class, 'edit'])->name('edit');
        Route::put('/{pet}', [AdminPetController::class, 'update'])->name('update');
        Route::delete('/{pet}', [AdminPetController::class, 'destroy'])->name('destroy');
        Route::post('/{pet}/approve', [AdminPetController::class, 'approve'])->name('approve');
        Route::post('/{pet}/reject', [AdminPetController::class, 'reject'])->name('reject');
        Route::post('/{pet}/feature', [AdminPetController::class, 'toggleFeature'])->name('feature');
        Route::post('/{pet}/status', [AdminPetController::class, 'updateStatus'])->name('status');
        Route::get('/{pet}/images', [AdminPetController::class, 'manageImages'])->name('images');
        Route::post('/{pet}/images', [AdminPetController::class, 'uploadImages'])->name('images.upload');
        Route::delete('/images/{image}', [AdminPetController::class, 'deleteImage'])->name('images.delete');
    });
    
    // Admin User Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::get('/{user}', [AdminUserController::class, 'show'])->name('show');
        Route::get('/{user}/edit', [AdminUserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [AdminUserController::class, 'update'])->name('update');
        Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('destroy');
        Route::post('/{user}/ban', [AdminUserController::class, 'ban'])->name('ban');
        Route::post('/{user}/unban', [AdminUserController::class, 'unban'])->name('unban');
        Route::post('/{user}/verify', [AdminUserController::class, 'verify'])->name('verify');
        Route::get('/{user}/adoptions', [AdminUserController::class, 'adoptions'])->name('adoptions');
        Route::get('/{user}/pets', [AdminUserController::class, 'pets'])->name('pets');
    });
    
    // Admin Adoption Management
    Route::prefix('adoptions')->name('adoptions.')->group(function () {
        Route::get('/', [AdminAdoptionController::class, 'index'])->name('index');
        Route::get('/{adoption}', [AdminAdoptionController::class, 'show'])->name('show');
        Route::post('/{adoption}/approve', [AdminAdoptionController::class, 'approve'])->name('approve');
        Route::post('/{adoption}/reject', [AdminAdoptionController::class, 'reject'])->name('reject');
        Route::post('/{adoption}/complete', [AdminAdoptionController::class, 'complete'])->name('complete');
        Route::get('/{adoption}/documents', [AdminAdoptionController::class, 'documents'])->name('documents');
        Route::post('/{adoption}/notes', [AdminAdoptionController::class, 'addNote'])->name('notes');
    });
    
    // Admin Message Management
    Route::prefix('messages')->name('messages.')->group(function () {
        Route::get('/', [AdminMessageController::class, 'index'])->name('index');
        Route::get('/{conversation}', [AdminMessageController::class, 'show'])->name('show');
        Route::delete('/{message}', [AdminMessageController::class, 'delete'])->name('delete');
        Route::post('/broadcast', [AdminMessageController::class, 'broadcast'])->name('broadcast');
    });
    
    // Admin Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [AdminController::class, 'settings'])->name('index');
        Route::put('/', [AdminController::class, 'updateSettings'])->name('update');
        Route::get('/breeds', [AdminController::class, 'breeds'])->name('breeds');
        Route::post('/breeds', [AdminController::class, 'storeBreed'])->name('breeds.store');
        Route::delete('/breeds/{breed}', [AdminController::class, 'deleteBreed'])->name('breeds.delete');
        Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
        Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
        Route::delete('/categories/{category}', [AdminController::class, 'deleteCategory'])->name('categories.delete');
        Route::get('/locations', [AdminController::class, 'locations'])->name('locations');
        Route::post('/locations', [AdminController::class, 'storeLocation'])->name('locations.store');
        Route::delete('/locations/{location}', [AdminController::class, 'deleteLocation'])->name('locations.delete');
    });
    
    // Admin Content Management
    Route::prefix('content')->name('content.')->group(function () {
        Route::get('/pages', [AdminController::class, 'pages'])->name('pages');
        Route::get('/pages/{page}/edit', [AdminController::class, 'editPage'])->name('pages.edit');
        Route::put('/pages/{page}', [AdminController::class, 'updatePage'])->name('pages.update');
        Route::get('/news', [AdminController::class, 'news'])->name('news');
        Route::get('/news/create', [AdminController::class, 'createNews'])->name('news.create');
        Route::post('/news', [AdminController::class, 'storeNews'])->name('news.store');
        Route::get('/news/{news}/edit', [AdminController::class, 'editNews'])->name('news.edit');
        Route::put('/news/{news}', [AdminController::class, 'updateNews'])->name('news.update');
        Route::delete('/news/{news}', [AdminController::class, 'deleteNews'])->name('news.delete');
        Route::get('/testimonials', [AdminController::class, 'testimonials'])->name('testimonials');
        Route::post('/testimonials', [AdminController::class, 'storeTestimonial'])->name('testimonials.store');
        Route::delete('/testimonials/{testimonial}', [AdminController::class, 'deleteTestimonial'])->name('testimonials.delete');
    });
});

// AJAX Routes
Route::middleware('auth')->group(function () {
    Route::post('/ajax/favorite/{pet}', [FavoriteController::class, 'ajaxToggle'])->name('ajax.favorite');
    Route::get('/ajax/pets/filter', [PetController::class, 'ajaxFilter'])->name('ajax.pets.filter');
    Route::get('/ajax/search/suggestions', [SearchController::class, 'suggestions'])->name('ajax.search.suggestions');
    Route::get('/ajax/locations/{state}/cities', [LocationController::class, 'getCities'])->name('ajax.locations.cities');
    Route::get('/ajax/breeds/{category}', [BreedController::class, 'getByCategory'])->name('ajax.breeds.category');
    Route::post('/ajax/messages/mark-read', [MessageController::class, 'ajaxMarkAsRead'])->name('ajax.messages.mark-read');
    Route::get('/ajax/notifications', [UserController::class, 'getNotifications'])->name('ajax.notifications');
    Route::post('/ajax/notifications/mark-read', [UserController::class, 'markNotificationsAsRead'])->name('ajax.notifications.mark-read');
});

// File Upload Routes
Route::middleware('auth')->group(function () {
    Route::post('/upload/pet-images', [PetController::class, 'uploadImages'])->name('upload.pet-images');
    Route::post('/upload/user-avatar', [UserController::class, 'uploadAvatar'])->name('upload.user-avatar');
    Route::post('/upload/documents', [AdoptionController::class, 'uploadDocuments'])->name('upload.documents');
    Route::delete('/upload/pet-images/{image}', [PetController::class, 'deleteImage'])->name('upload.pet-images.delete');
});

// Social Media Routes
Route::get('/auth/google', [LoginController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [LoginController::class, 'handleGoogleCallback']);
Route::get('/auth/facebook', [LoginController::class, 'redirectToFacebook'])->name('auth.facebook');
Route::get('/auth/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

// Newsletter Routes
Route::post('/newsletter/subscribe', [HomeController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');
Route::get('/newsletter/unsubscribe/{token}', [HomeController::class, 'unsubscribeNewsletter'])->name('newsletter.unsubscribe');

// Sitemap and SEO Routes
Route::get('/sitemap.xml', [HomeController::class, 'sitemap'])->name('sitemap');
Route::get('/robots.txt', [HomeController::class, 'robots'])->name('robots');

// Health Check Route
Route::get('/health', function () {
    return response()->json(['status' => 'ok', 'timestamp' => now()]);
})->name('health');

// Fallback Route for SPA-like experience (optional)
Route::fallback(function () {
    return redirect()->route('home');
});