<?php

use App\Http\Controllers\PagesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::get('/', [\App\Http\Controllers\AuthController::class, 'loginView']);
    Route::get('/login', [\App\Http\Controllers\AuthController::class, 'loginView'])->name('loginView');
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login'])->name('login');
});

//Route::get('/testing', [\App\Http\Controllers\TestController::class, 'test']);

Route::middleware(['auth', 'session'])->group(function () {
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', \App\Http\Livewire\Dashboard\Dashboard::class)->name('dashboard');
    Route::get('/analytics', \App\Http\Livewire\Analytics\MyAnalytics::class)->name('analytics');
    Route::get('/calendar', \App\Http\Livewire\Calendar\ShipmentCalendar::class)->name('calendar');
    Route::get('/shipments/shipments', \App\Http\Livewire\Shipments\Shipments::class)->name('shipments');
    Route::get('/shipments/containers', \App\Http\Livewire\Shipments\Containers::class)->name('containers');
    Route::get('/space/favorites', \App\Http\Livewire\MySpace\Favorites::class)->name('favorites');
    Route::get('/space/priorities', \App\Http\Livewire\MySpace\Priorities::class)->name('priorities');
    Route::get('/control/accounts', \App\Http\Livewire\ControlCenter\Accounts::class)->name('accounts');
    Route::get('/control/accounts/editUser/{id}', \App\Http\Livewire\ControlCenter\EditUser::class)->name('editUser');
    Route::get('/control/organisations', \App\Http\Livewire\ControlCenter\Organisations::class)->name('organisations');
    Route::get('/bookings/transports', \App\Http\Livewire\Bookings\TransportBookings::class)->name('transports');
    Route::get('/bookings/deliveries', \App\Http\Livewire\Bookings\Deliveries::class)->name('deliveries');
    Route::get('/documents', \App\Http\Livewire\Documents\Documents::class)->name('documents');
    Route::get('/invoices', \App\Http\Livewire\Invoicing\MyInvoices::class)->name('invoices');
    Route::get('/invoices/view/{linked_reference}', \App\Http\Livewire\Invoicing\ViewInvoice::class)->middleware(['auth', 'verified'])->name('viewInvoice');

    //Stream Document
    Route::get('/streamFile/{id}', [\App\Http\Controllers\StreamFileController::class, 'streamFile'])->name('getFile');
    //Stream Courier Tracking
    Route::get('/streamFile/{tracking}', [\App\Http\Controllers\StreamFileController::class, 'streamTracking'])->name('streamTracking');

    //View Pages
    Route::get('/shipments/shipments/{id}',\App\Http\Livewire\Shipments\ViewShipment::class)->name('shipment');
    Route::get('/shipments/container/{id}',\App\Http\Livewire\Shipments\ViewContainer::class)->name('container');
    Route::get('/bookings/delivery/view-delivery/{id}',\App\Http\Livewire\Bookings\Delivery\ViewDelivery::class)->name('delivery');
    Route::get('/documents/view-document/{id}',\App\Http\Livewire\Documents\ViewDocument::class)->name('document');
    Route::get('/control/rolesAndPermissions', \App\Http\Livewire\ControlCenter\RolesAndPermissions::class)->name('permissions');

    Route::get('/profile', \App\Http\Livewire\User\ProfilePage::class)->middleware(['auth', 'verified'])->name('profile');
    Route::get('/service/logs/{event_registration_id}', \App\Http\Livewire\ServiceLogs\ViewServiceLogs::class)->name('serviceLogs');

    Route::get('/APIDocumentation', \App\Http\Livewire\Documentation\ApiDocumemtation::class)->name('apiDocumentation');
    Route::get('/DataServiceDocumentation', \App\Http\Livewire\Documentation\DataServiceDocumentation::class)->name('dataServiceDocumentation');
    Route::get('/PortalDocumentation', \App\Http\Livewire\Documentation\PortalDocumentation::class)->name('PortalDocumentation');
});
