<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about-us', [\App\Http\Controllers\Frontend\PageController::class, 'about'])->name('about');
Route::get('/contact-us', [\App\Http\Controllers\Frontend\PageController::class, 'contact'])->name('contact');
Route::post('/contact-us', [\App\Http\Controllers\Frontend\PageController::class, 'contactStore'])->name('contact.store');
Route::get('/partner-with-us', [\App\Http\Controllers\Frontend\PageController::class, 'partner'])->name('partner');
Route::post('/partner-with-us', [\App\Http\Controllers\Frontend\PageController::class, 'partnerStore'])->name('partner.store');
Route::get('/payment-methods', [\App\Http\Controllers\Frontend\PageController::class, 'paymentMethods'])->name('payment-methods');
Route::get('/money-back', [\App\Http\Controllers\Frontend\PageController::class, 'moneyBack'])->name('money-back');
Route::get('/returns', [\App\Http\Controllers\Frontend\PageController::class, 'returns'])->name('returns');
Route::get('/shipping', [\App\Http\Controllers\Frontend\PageController::class, 'shipping'])->name('shipping');
Route::get('/privacy-policy', [\App\Http\Controllers\Frontend\PageController::class, 'privacyPolicy'])->name('privacy-policy');

// Shop / Product Routes
Route::get('/products', [\App\Http\Controllers\Frontend\ProductController::class, 'index'])->name('products.all');
Route::get('/category/{slug}', [\App\Http\Controllers\Frontend\ProductController::class, 'category'])->name('products.category');
Route::get('/brand/{slug}', [\App\Http\Controllers\Frontend\ProductController::class, 'brand'])->name('products.brand');
Route::get('/product/quickview/{id}', [\App\Http\Controllers\Frontend\ProductController::class, 'quickView'])->name('products.quickview');
Route::get('/product/{slug}', [\App\Http\Controllers\Frontend\ProductController::class, 'show'])->name('products.show');
Route::post('/inquiry', [\App\Http\Controllers\Frontend\InquiryController::class, 'store'])->name('inquiry.store');

Route::get('/dashboard', [\App\Http\Controllers\Backend\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('categories', \App\Http\Controllers\Backend\CategoryController::class);
    Route::resource('brands', \App\Http\Controllers\Backend\BrandController::class);
    Route::delete('products/{product}/images/{index}', [\App\Http\Controllers\Backend\ProductController::class, 'deleteImage'])->name('products.images.delete');

    // Product Import
    Route::get('products/import', [\App\Http\Controllers\Backend\ProductImportController::class, 'index'])->name('products.import');
    Route::get('products/import/template', [\App\Http\Controllers\Backend\ProductImportController::class, 'template'])->name('products.import.template');
    Route::post('products/import/process', [\App\Http\Controllers\Backend\ProductImportController::class, 'store'])->name('products.import.process');

    Route::resource('products', \App\Http\Controllers\Backend\ProductController::class);

    // Inquiries Group
    Route::prefix('inquiries')->name('inquiries.')->group(function () {
        // Contact Messages (Static routes first)
        Route::get('contact-us', [\App\Http\Controllers\Backend\InquiryController::class, 'contactIndex'])->name('contact.index');
        Route::get('contact-us/{id}', [\App\Http\Controllers\Backend\InquiryController::class, 'contactShow'])->name('contact.show');
        Route::delete('contact-us/{id}', [\App\Http\Controllers\Backend\InquiryController::class, 'contactDestroy'])->name('contact.destroy');

        // Product Inquiries (Wildcard routes last)
        Route::get('/', [\App\Http\Controllers\Backend\InquiryController::class, 'index'])->name('index');
        Route::get('{inquiry}', [\App\Http\Controllers\Backend\InquiryController::class, 'show'])->name('show');
        Route::delete('{inquiry}', [\App\Http\Controllers\Backend\InquiryController::class, 'destroy'])->name('destroy');
    });

    // Settings Routes
    Route::controller(\App\Http\Controllers\Backend\SettingsController::class)->prefix('settings')->name('settings.')->group(function () {
        Route::get('general', 'general')->name('general');
        Route::post('general', 'updateGeneral')->name('general.update');
        Route::get('seo', 'seo')->name('seo');
        Route::post('seo', 'updateSeo')->name('seo.update');
    });

    // Homepage Management
    Route::resource('homepage-sections', \App\Http\Controllers\Backend\HomepageSectionController::class);
    Route::post('homepage-sections/{homepage_section}/cards', [\App\Http\Controllers\Backend\HomepageSectionController::class, 'storeCard'])->name('homepage-sections.cards.store');
    Route::put('homepage-cards/{card}', [\App\Http\Controllers\Backend\HomepageSectionController::class, 'updateCard'])->name('homepage-cards.update');
    Route::delete('homepage-cards/{card}', [\App\Http\Controllers\Backend\HomepageSectionController::class, 'destroyCard'])->name('homepage-cards.destroy');
});

require __DIR__ . '/auth.php';
