<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\IbController;
use App\Http\Controllers\CopyTradingController;
use App\Http\Controllers\Api\UserController as ApiUserController;

Route::get('users/export/', 'App\Http\Controllers\UserController@export');
Route::get('transaction/export/', 'App\Http\Controllers\TransactionController@export');
Route::get('/accounttypes', function () {
    return view('admin.accounttype.index');
});

Route::get('ibform', [IbController::class, 'index']);
Route::post('ibform', [IbController::class, 'store'])->name('contact.us.store');

Route::get('/clear', function () {
    \Illuminate\Support\Facades\Artisan::call('optimize:clear');
});


Route::get('cron', 'CronController@cron')->name('cron');

// User Support Ticket
Route::controller('TicketController')->prefix('ticket')->name('ticket.')->group(function () {
    Route::get('/', 'supportTicket')->name('index');
    Route::get('new', 'openSupportTicket')->name('open');
    Route::post('create', 'storeSupportTicket')->name('store');
    Route::get('view/{ticket}', 'viewTicket')->name('view');
    Route::post('reply/{ticket}', 'replyTicket')->name('reply');
    Route::post('close/{ticket}', 'closeTicket')->name('close');
    Route::get('download/{ticket}', 'ticketDownload')->name('download');
});

Route::get('app/deposit/confirm/{hash}', 'Gateway\PaymentController@appDepositConfirm')->name('deposit.app.confirm');

Route::middleware('auth')->group(function () {
    Route::get('/copy-trading', [CopyTradingController::class, 'index'])->name('user.copy-trading');
    Route::get('/follower-access', [CopyTradingController::class, 'followeraccess'])->name('user.follower-access');
    Route::get('/provider-access', [CopyTradingController::class, 'provideraccess'])->name('user.provider-access');
    Route::get('/ratings', [CopyTradingController::class, 'ratings'])->name('user.ratings');
});

Route::controller("TradeController")->prefix('trade')->group(function () {
    Route::get('/order/book/{symbol}', 'orderBook')->name('trade.order.book');
    Route::get('pairs', 'pairs')->name('trade.pairs');
    Route::get('history/{symbol}', 'history')->name('trade.history');
    Route::get('order/list/{pairSym}', 'orderList')->name('trade.order.list');
    Route::get('/{symbol?}', 'trade')->name('trade');
});


Route::namespace('P2P')->group(function () {
    Route::controller("HomeController")->prefix('p2p')->group(function () {
        Route::get("/advertiser/{username}", 'advertiser')->name('p2p.advertiser');
        Route::get("/{type?}/{coin?}/{currency?}/{paymentMethod?}/{region?}/{amount?}", 'p2p')->name('p2p');
    });
});



Route::controller('SiteController')->group(function () {
    Route::get('/contact', 'contact')->name('contact');
    Route::get('/pwa/configuration', 'pwaConfiguration')->name('pwa.configuration');
    Route::get('/market/list', 'marketList')->name('market.list');
    Route::get('/crypto/list', 'cryptoCurrencyList')->name('crypto_currency.list');
    Route::get('/market', 'market')->name('market');
    Route::get('/about-us', 'about')->name('about');
    Route::get('/blogs', 'blogs')->name('blogs');
    Route::get('/crypto-currency', 'crypto')->name('crypto_currencies');
    Route::get('/crypto/currency/{symbol}', 'cryptoCurrencyDetails')->name('crypto.details');
    Route::post('/contact', 'contactSubmit');
    Route::get('/change/{lang?}', 'changeLanguage')->name('lang');
    Route::post('/subscribe', 'subscribe')->name('subscribe');
    Route::get('cookie-policy', 'cookiePolicy')->name('cookie.policy');
    Route::get('/cookie/accept', 'cookieAccept')->name('cookie.accept');
    Route::get('blog/{slug}/{id}', 'blogDetails')->name('blog.details');
    Route::get('policy/{slug}/{id}', 'policyPages')->name('policy.pages');
    Route::get('placeholder-image/{size}', 'placeholderImage')->name('placeholder.image');
    Route::post('pusher/auth/{socketId}/{channelName}', "pusherAuthentication");
    Route::get('/{slug}', 'pages')->name('pages');
    Route::get('/', 'index')->name('home');
    
});

Route::get('user/account-data', [ApiUserController::class, 'getAccountData'])->name('user.account.data');





