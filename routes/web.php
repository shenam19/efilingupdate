<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\ManageStaffController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\OrganizationStructureController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PullBackController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
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

Route::get('/include-time-in-date', function () {

    $records = App\Models\Record::get();

    foreach ($records as $record) {
        $dispatched_date = new Carbon($record->dispatched_date);
        $received_date = new Carbon($record->received_date);
        $setDate = Carbon::parse($record->updated_at);
        $dispatched_date->hour = $setDate->hour;
        $dispatched_date->minute = $setDate->minute;
        $dispatched_date->second = $setDate->second;
        $received_date->hour = $setDate->hour;
        $received_date->minute = $setDate->minute;
        $received_date->second = $setDate->second;
        $record->update(['dispatched_date' => $dispatched_date, 'received_date' => $received_date]);
    }
    dd("done");
});

Route::get('/', function () {
    return redirect()->route('dashboard');
})->name('home');

Route::get('/launch', function () {
    return view('launch');
})->name('launch');

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/print/{message:uuid}', PrintController::class)->where('uuid', '([a-zA-Z]|[0-9]|-)+')->name('print');

    //Dashboard
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    //Mail routes
    Route::prefix('/mail')->group(function () {
        //Shows the mail inbox
        Route::get('record', [MessageController::class, 'record']);

        //Shows the mail inbox
        Route::get('inbox', [MessageController::class, 'inbox'])->name('inbox');

        //Shows the mail compose form
        Route::get('compose', [MessageController::class, 'compose'])->name('compose');

        //Show mail
        Route::get('show/{message:uuid}', [MessageController::class, 'show'])->where('uuid', '([a-zA-Z]|[0-9]|-)+')->name('show');

        //Show mail sent by the user
        Route::get('sent', [MessageController::class, 'sent'])->name('sent');

        //Sends the composed mail
        Route::post('send', [MessageController::class, 'send'])->name('send');

        //Reply to a message
        // Route::post('reply/{thread}',[MessageController::class,'reply'])->where('thread','[0-9]+')->name('reply');

        //Show mails with status unsent
        Route::get('draft', [MessageController::class, 'draft'])->name('draft');

        //Show one Draft message
        Route::get('draft/{message:uuid}', [MessageController::class, 'showDraft'])->where('uuid', '([a-zA-Z]|[0-9]|-)+')->name('draft.show');

        //Sends a Draft message
        Route::put('draft/{message}', [MessageController::class, 'sendDraft'])->name('draft.send');

        //Show pull back correction message
        Route::get('pullback/{message:uuid}', [PullBackController::class, 'show'])->where('uuid', '([a-zA-Z]|[0-9]|-)+')->name('pullback.show');

        Route::post('pullback/send', [PullBackController::class, 'send'])->name('pullback.send');
    });

    //Records routes
    Route::prefix('/records')->group(function () {

        //Shows the incoming|outgoing register
        Route::get('{type}', [RecordController::class, 'index'])->where('type', '(incoming|outgoing)')->name('record');

        //Shows the incoming|outgoing form ui
        Route::get('{type}/create/', [RecordController::class, 'create'])->where('type', '(incoming|outgoing)')->name('record.create');

        //Stores incoming|outgoing
        Route::post('{type}/store/', [RecordController::class, 'store'])->where('type', '(incoming|outgoing)')->name('record.store');

        //Shows more information on a specific message
        Route::get('{type}/show/{message:uuid}', [RecordController::class, 'show'])->where('type', '(incoming|outgoing)')->where('uuid', '([a-zA-Z]|[0-9]|-)+')->name('record.show');

        Route::get('{type}/{message:uuid}/edit', [RecordController::class, 'edit'])->where('type', '(incoming|outgoing)')->where('uuid', '([a-zA-Z]|[0-9]|-)+')->name('record.edit');

        Route::patch('{type}/{message:uuid}', [RecordController::class, 'update'])->where('type', '(incoming|outgoing)')->where('uuid', '([a-zA-Z]|[0-9]|-)+')->name('record.update');

        //Prints record
        Route::post('{type}/print/', [RecordController::class, 'print'])->where('type', '(incoming|outgoing)')->name('record.print');
    });

    //Media Routes
    Route::resource('media', MediaController::class);

    //Folder Routes
    Route::resource('folders', FolderController::class);

    //Contact
    Route::resource('contact', ContactController::class, [
        'only' => ['index', 'edit', 'show', 'store', 'destroy', 'update']
    ]);

    //Manage staff routes
    Route::prefix('manage-staff')->group(function () {
        //Shows the staff list of logged-in user's subtree org
        Route::get('listMyStaff', [ManageStaffController::class, 'index'])->name('manage-staff.listMyStaff');

        //creates new staff
        Route::post('store', [ManageStaffController::class, 'store'])->name('manage-staff.store');

        //Delete staff account
        Route::delete('delete', [ManageStaffController::class, 'destroy'])->name('manage-staff.delete');

        //Edit staff account
        Route::post('edit', [ManageStaffController::class, 'edit'])->name('manage-staff.edit');
    });

    //organization-structure
    //Manage staff routes
    Route::prefix('organization-structure')->group(function () {
        //Shows the org chart of logged-in user
        Route::get('index', [OrganizationStructureController::class, 'index'])->name('organization-structure.index');

        //Edit Org
        Route::post('edit', [OrganizationStructureController::class, 'edit'])->name('organization-structure.edit');

        //Add Child Org
        Route::post('add', [OrganizationStructureController::class, 'add'])->name('organization-structure.add');

        //Delete Org
        Route::delete('delete', [OrganizationStructureController::class, 'destroy'])->name('organization-structure.delete');
    });
});
