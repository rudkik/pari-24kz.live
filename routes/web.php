<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BetsController;
use App\Http\Controllers\RejectionReasonController;
use App\Http\Controllers\Private\UserManagementController;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\FooterLinkController;
use App\Http\Controllers\PopupNotificationController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\SportsController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\MatchNotificationController;
use App\Http\Controllers\DogovorNotificationController;
use App\Http\Controllers\MatchLimitController;
use App\Http\Controllers\BannerController;

Route::middleware(['admin.redirect'])->group(function () {
    Route::get('/', [IndexController::class, 'index'])->name('home');
});

Route::get('/match1', [IndexController::class, 'match1']);
Route::get('/match', [IndexController::class, 'match']);
Route::get('/draw', [IndexController::class, 'draw']);
Route::get('/dogmatch', [IndexController::class, 'dogmatch']);
Route::get('/dogmatch/{id}', [IndexController::class, 'dogmatchgame'])->name('dogmatch.game');
Route::get('/license', [IndexController::class, 'license']);
Route::get('/return', [IndexController::class, 'defreturn']);
Route::get('/rules', [IndexController::class, 'rules']);
Route::get('/risk_notification', [IndexController::class, 'risk']);
Route::get('/live', [IndexController::class, 'live']);
Route::get('/live1', [IndexController::class, 'live1']);
Route::get('/sport', [IndexController::class, 'sport']);
Route::get('/bets/{id}', [IndexController::class, 'bets']);
Route::get('/bets/{idsport}/{idtourn}', [IndexController::class, 'betsid'])->name('bets.tourn');
Route::get('/bets/{idsport}/{idtourn}/{idgame}', [IndexController::class, 'betsgameid'])->name('bets.gameid');
Route::get('/casino-game', [IndexController::class, 'casinoGame'])->name('casino.game');
Route::get('/casino', [IndexController::class, 'casino'])->name('casino');
Route::get('/auth-as-user/{id}', [UserManagementController::class, 'authAsUserMainDomain'])->name('main.authAsUser');

Route::post('/reg', [IndexController::class, 'reg']);
Route::post('/auth', [IndexController::class, 'auth']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [IndexController::class, 'logout']);
    Route::post('/editprofile', [IndexController::class, 'editprofile']);
    Route::post('/ajaxstavka', [IndexController::class, 'ajaxstavka']);
    Route::post('/adminuseredit', [IndexController::class, 'adminuseredit']);
    Route::post('/adminuserbalanceedit', [IndexController::class, 'adminuserbalanceedit']);
    Route::post('/adminuserdelete', [IndexController::class, 'adminuserdelete']);

    Route::post('/payment/withdrawal', [PaymentController::class, 'requestWithdrawal'])->name('payment.request');
    Route::post('/payment/{id}/reject', [PaymentController::class, 'paymentReject'])->name('payment.reject');
    Route::post('/payment/{id}/pay', [PaymentController::class, 'paymentPay'])->name('payment.pay');
    Route::post('/payment/{id}/update', [App\Http\Controllers\PaymentController::class, 'update'])->name('payment.update');


    Route::post('/adminuserliststavki', [IndexController::class, 'adminuserliststavki']);
    Route::post('/searchtxt', [IndexController::class, 'searchtxt']);

    Route::get('/deposit-history', [DepositController::class, 'getDepositsView'])->name('deposit.history');
    Route::get('/deposit-history/show/{id}', [DepositController::class, 'show']);
    Route::post('/deposit-history/update/{id}', [DepositController::class, 'update'])->name('deposit.update');

    Route::post('/user/verification-request', [UserController::class, 'verificationRequest'])->name('user.verificationRequest');

    Route::post('/ajaxstavka/success', [BetsController::class, 'betsSuccess'])->name('bets.success');
});

Route::group(['middleware' => ['admin']], function () {
    Route::get('/private', [IndexController::class, 'private']);

    Route::resource('/private/leagues', LeagueController::class);
    Route::resource('/private/sports', SportsController::class);
    Route::resource('/private/games', GameController::class);
    Route::resource('/private/match-limits', MatchLimitController::class);
    Route::resource('/private/banners', BannerController::class)
        ->names('private.banners')
        ->except(['show']);


    Route::get('/randomize-games', [GameController::class, 'randomizeGames'])->name('games.randomize');
    Route::get('/private/matchNotf/edit', [MatchNotificationController::class, 'edit'])->name('matchNotf.edit');
    Route::post('/private/matchNotf/update', [MatchNotificationController::class, 'update'])->name('matchNotf.update');


    Route::get('/private/dogovor-notf/edit', [DogovorNotificationController::class, 'edit'])->name('dogovorNotf.edit');
    Route::post('/privatedogovor-notf/update', [DogovorNotificationController::class, 'update'])->name('dogovorNotf.update');

    Route::get('/private/popup-notification', [PopupNotificationController::class, 'edit'])->name('private.popup-notification.edit');
    Route::post('/private/popup-notification', [PopupNotificationController::class, 'update'])->name('private.popup-notification.update');


    Route::get('/private/footer-links', [FooterLinkController::class, 'index'])->name('private.footer-links.index');
    Route::get('/private/footer-links/create', [FooterLinkController::class, 'create'])->name('private.footer-links.create');
    Route::post('private/footer-links', [FooterLinkController::class, 'store'])->name('private.footer-links.store');
    Route::get('private/footer-links/{footerLink}/edit', [FooterLinkController::class, 'edit'])->name('private.footer-links.edit');
    Route::put('private/footer-links/{footerLink}', [FooterLinkController::class, 'update'])->name('private.footer-links.update');
    Route::post('private/footer-links/upload-image', [FooterLinkController::class, 'uploadImage'])->name('image.upload');

    Route::delete('private/footer-links/{footerLink}', [FooterLinkController::class, 'destroy'])->name('private.footer-links.destroy');



    Route::get('/private/users', [UserController::class, 'privateadmin'])->name('private.users');
    Route::get('/private/stat', [IndexController::class, 'privatestat'])->name('private.stat');
    Route::get('/private/contract', [IndexController::class, 'privatecontract'])->name('private.contract');
    Route::get('/private/verify', [IndexController::class, 'privateverify'])->name('private.verify');
    Route::resource('/rejection-reasons', RejectionReasonController::class);
    Route::get('/private/withdrawal-requests', [IndexController::class, 'privatewithdrawals'])->name('private.withdrawals');
    Route::post('/private/withdrawal-requests/{id}/reject', [IndexController::class, 'reject']);
    Route::post('/private/withdrawal-requests/{id}/pay', [IndexController::class, 'pay']);
    Route::post('/private/withdrawal-requests/{id}/update', [IndexController::class, 'update']);
    Route::post('/private/contract/create', [IndexController::class, 'privatecontractcreate'])->name('private.contract.create');
    Route::get('/private/matches', [IndexController::class, 'viewDogovorMatches'])->name('private.matches');
    Route::get('/private/match/{id}', [IndexController::class, 'viewDogovorMatchDetails'])->name('private.match.details');
    Route::put('/private/match/{id}/update', [IndexController::class, 'updateDogovorMatch'])->name('private.match.update');
    Route::delete('/private/match/{id}/delete', [IndexController::class, 'deleteDogovorMatch'])->name('private.match.delete');


    Route::get('/private/{id}', [IndexController::class, 'privateadminid'])->name('private.user');
    Route::post('/private/{id}/update', [UserController::class, 'updateUser']);
    Route::post('/private/{id}/verification-request/success', [UserManagementController::class, 'successVerificationRequest']);
    Route::post('/private/{id}/verification-request/reject', [UserManagementController::class, 'rejectVerificationRequest']);
    Route::get('/private/{id}/get-user-sessions', [UserManagementController::class, 'getUserSessions']);
    Route::post('/private/{id}/remove-user-session/{sessionId}', [UserManagementController::class, 'removeUserSession']);
    Route::get('/private/{id}/get-user-withdrawals', [UserManagementController::class, 'getUserWithdrawals']);
    Route::get('/private/{id}/auth-as-user', [UserManagementController::class, 'authAsUser'])->name('private.authAsUser');
    Route::delete('/deposit-history/delete/{id}', [DepositController::class, 'destroy'])->name('deposit.delete');


});

Route::get('/t', [IndexController::class, 't']);

Route::get('/account-restricted', [IndexController::class, 'accountRestricted'])->name('account.restricted');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::get('/{url}', [FooterLinkController::class, 'show'])
    ->name('footer-links.show')
    ->where('url', '^(?!private|match1|match|draw|dogmatch|license|return|rules|risk_notification|live|live1|sport|bets|casino-game|casino|auth-as-user|reg|auth|logout|deposit-history|payment|admin|t|account-restricted).*$');