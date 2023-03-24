<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AllocController;
use App\Http\Controllers\StorageController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SOController;
use App\Http\Controllers\PoController;
use App\Http\Controllers\CoController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\BBController;
use App\Http\Controllers\MutationController;
use App\Http\Controllers\GLController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\PDFController;

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

Route::get('/', function () {
    return redirect('/login');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['guest']],function(){
    Route::get('/login', [LoginController::class, 'index']);
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login');
});

Route::group(['middleware' => ['auth']],function(){
    Route::get('/dashboard', [AgendaController::class, 'index'])->name('dashboard');
    Route::get('/changepass', [LoginController::class, 'changepass']);
    Route::post('/changepass/post', [LoginController::class, 'changepasspost'])->name('changepasspost');

    Route::group(['middleware' => ['levelSuper']],function(){
        Route::get('generate-pdf-so/{kodeSO}', [PDFController::class, 'generatePDFSO']);
        Route::get('generate-pdf-co/{kodeCO}', [PDFController::class, 'generatePDFCO']);
        Route::get('generate-pdf-tnc', [PDFController::class, 'generatePDFTNC']);
        Route::get('generate-pdf-certificate', [PDFController::class, 'generatePDFCertificate']);
        //Agenda
        Route::post('/agenda/setup/create', [AgendaController::class, 'createagenda'])->name('createagenda');
        Route::post('/agenda/getdata', [AgendaController::class, 'getagenda'])->name('getagenda');

        Route::post('/agenda/update/post/id', [AgendaController::class, 'getagendabyid'])->name('getagendabyid');
        Route::post('/agenda/update/post', [AgendaController::class, 'agendaupdate'])->name('agendaupdate');
        Route::post('/agenda/update/delete', [AgendaController::class, 'agendadelete'])->name('agendadelete');

        // User Route
        Route::get('/user/setup', [UserController::class, 'index']);
        Route::post('/user/setup/create', [UserController::class, 'createUser'])->name('createUser');
        Route::get('/user/update/{kodeuser}', [UserController::class, 'updateUser'])->name('updateUser');
        Route::post('/user/update/post', [UserController::class, 'updateUserPost'])->name('updateUserPost');
        Route::post('/user/update/reset', [UserController::class, 'resetPass'])->name('resetPass');
        Route::post('/user/update/delete', [UserController::class, 'delUser'])->name('delUser');

        // Article Type Route
        Route::get('/article/type', [ArticleController::class, 'index']);
        Route::post('/article/type/create', [ArticleController::class, 'createArType'])->name('createArType');
        Route::get('/article/type/update/{kodetype}', [ArticleController::class, 'updateArType'])->name('updateArType');
        Route::post('/article/type/update/post', [ArticleController::class, 'updateArTypePost'])->name('updateArTypePost');
        Route::post('/article/type/delete', [ArticleController::class, 'delArType'])->name('delArType');

        // Allocation Route
        Route::get('/allocation/setup', [AllocController::class, 'index']);
        Route::post('/allocation/setup/create', [AllocController::class, 'createAlloc'])->name('createAlloc');
        Route::get('/allocation/setup/update/{kodealloc}', [AllocController::class, 'updateAlloc'])->name('updateAlloc');
        Route::post('/allocation/setup/update/post', [AllocController::class, 'updateAllocPost'])->name('updateAllocPost');
        Route::post('/allocation/setup/delete', [AllocController::class, 'delAlloc'])->name('delAlloc');

        // Article Route
        Route::get('/storages', [StorageController::class, 'index']);
        Route::post('/storages', [StorageController::class, 'indexPost'])->name('indexStorage');

        // Article List
        Route::get('/article/list', [ArticleController::class, 'indexlist']);
        Route::post('/article/list', [ArticleController::class, 'articleListPost'])->name('articleListPost');
        Route::get('/article/list/{kodeart}', [ArticleController::class, 'updateArt'])->name('updateArt');
        Route::post('/article/list/update/post', [ArticleController::class, 'updateArtPost'])->name('updateArtPost');
        Route::post('/article/list/print', [ArticleController::class, 'printArtKode'])->name('printArtKode');

        //Customer Route
        Route::get('/customer/setup', [CustomerController::class, 'index']);
        Route::post('/customer/setup/create', [CustomerController::class, 'createCustomer'])->name('createCustomer');
        Route::get('/customer/update/{kodecustomer}', [CustomerController::class, 'updateCustomer'])->name('updateCustomer');
        Route::post('/customer/update/post', [CustomerController::class, 'updateCustomerPost'])->name('updateCustomerPost');
        Route::post('/Customer/update/delete', [CustomerController::class, 'delCustomer'])->name('delCustomer');

        //Supplier Route
        Route::get('/supplier/setup', [SupplierController::class, 'index']);
        Route::post('/supplier/setup/create', [SupplierController::class, 'createsupplier'])->name('createsupplier');
        Route::get('/supplier/update/{kodesupplier}', [SupplierController::class, 'updateSupplier'])->name('updateSupplier');
        Route::post('/supplier/update/post', [SupplierController::class, 'updateSupplierPost'])->name('updateSupplierPost');
        Route::post('/supplier/update/delete', [SupplierController::class, 'delSupplier'])->name('delSupplier');

        //PO
        Route::get('/transaction/po', [PoController::class, 'index']);
        Route::get('/transaction/po/create', [PoController::class, 'createpoview']);
        Route::get('/transaction/po/detail/{idpo}', [PoController::class, 'detailpo'])->name('detailpo');
        Route::post('/transaction/po/create/post', [PoController::class, 'createpo'])->name('createpo');
        Route::post('/transaction/po/filter', [PoController::class, 'getpofilter'])->name('getpofilter');

        //CO
        Route::get('/transaction/co', [CoController::class, 'index']);
        Route::get('/transaction/co/create', [CoController::class, 'createcoview']);
        Route::get('/transaction/co/detail/{idco}', [CoController::class, 'detailco'])->name('detailco');
        Route::post('/transaction/co/create/post', [CoController::class, 'createco'])->name('createco');
        Route::post('/transaction/co/filter', [CoController::class, 'getcofilter'])->name('getcofilter');
        Route::post('/transaction/co/print/invoice', [CoController::class, 'printcoinv'])->name('printcoinv');

        //Buy Back
        Route::get('/buyback', [BBController::class, 'index']);
        Route::post('/buyback', [BBController::class, 'indexPostBB'])->name('indexPostBB');
        Route::get('/buyback/create', [BBController::class, 'createBB']);
        Route::post('/buyback/create/getso', [BBController::class, 'BBgetSO'])->name('BBgetSO');
        Route::post('/buyback/create/get/art', [BBController::class, 'getArticle'])->name('getArticleBB');
        Route::get('/buyback/update/{idbb}', [BBController::class, 'updateBB']);
        Route::post('/buyback/update/post', [BBController::class, 'updateBBPost'])->name('updateBBPost');
        Route::post('/buyback/create/post', [BBController::class, 'createBBPost'])->name('createBBPost');

        //LOG
        Route::get('/log/co', [LogController::class, 'indexlogco']);
        Route::get('/log/co/{idco}', [LogController::class, 'viewidco'])->name('viewidco');

        // Route SO
        Route::get('/transaction/sales', [SOController::class, 'index']);
        Route::post('/transaction/sales', [SOController::class, 'indexPostSo'])->name('indexPostSo');
        Route::get('/transaction/sales/create', [SOController::class, 'createSO']);
        Route::post('/transaction/sales/create/post', [SOController::class, 'createSOPost'])->name('createSOPost');
        Route::post('/transaction/sales/create/getlist', [SOController::class, 'SOGetArticle'])->name('SOGetArticle');
        Route::post('/transaction/sales/create/get/art', [SOController::class, 'getArticle'])->name('getArticleSO');
        Route::post('/transaction/sales/create/get/cust', [SOController::class, 'getCust'])->name('getCustSO');
        Route::get('/transaction/sales/update/{idso}', [SOController::class, 'updateSO']);
        Route::post('/transaction/sales/update/post', [SOController::class, 'updateSOPost'])->name('updateSOPost');
        Route::post('/transaction/sales/print/sertif', [SOController::class, 'printSertif'])->name('printSertif');
        Route::post('/transaction/sales/print/invoice', [SOController::class, 'printInv'])->name('printInv');

        // GL Entries
        Route::get('/gl', [GLController::class, 'index']);
        Route::post('/gl', [GLController::class, 'indexGLPost'])->name('indexGLPost');

        // Mutation
        Route::get('/mutation', [MutationController::class, 'index']);
        Route::post('/mutation/post', [MutationController::class, 'mutationPost'])->name('mutationPost');
        Route::post('/mutation/filter', [MutationController::class, 'mutationFilter'])->name('mutationFilter');
        Route::post('/mutation/getarticle', [MutationController::class, 'mutationGetArticle'])->name('mutationGetArticle');
        Route::post('/mutation/getarticle/detail', [MutationController::class, 'mutationGetArticleDet'])->name('mutationGetArticleDet');

    });

    Route::group(['middleware' => ['levelAdmin']],function(){
        //Agenda
        Route::post('/agenda/setup/create', [AgendaController::class, 'createagenda'])->name('createagenda');
        Route::post('/agenda/getdata', [AgendaController::class, 'getagenda'])->name('getagenda');

        Route::post('/agenda/update/post/id', [AgendaController::class, 'getagendabyid'])->name('getagendabyid');
        Route::post('/agenda/update/post', [AgendaController::class, 'agendaupdate'])->name('agendaupdate');
        Route::post('/agenda/update/delete', [AgendaController::class, 'agendadelete'])->name('agendadelete');

        // Article Type Route
        Route::get('/article/type', [ArticleController::class, 'index']);
        Route::post('/article/type/create', [ArticleController::class, 'createArType'])->name('createArType');
        Route::get('/article/type/update/{kodetype}', [ArticleController::class, 'updateArType'])->name('updateArType');
        Route::post('/article/type/update/post', [ArticleController::class, 'updateArTypePost'])->name('updateArTypePost');
        Route::post('/article/type/delete', [ArticleController::class, 'delArType'])->name('delArType');

        // Article Route
        Route::get('/storages', [StorageController::class, 'index']);
        Route::post('/storages', [StorageController::class, 'indexPost'])->name('indexStorage');

        // Article List
        Route::get('/article/list', [ArticleController::class, 'indexlist']);
        Route::post('/article/list', [ArticleController::class, 'articleListPost'])->name('articleListPost');
        Route::get('/article/list/{kodeart}', [ArticleController::class, 'updateArt'])->name('updateArt');
        Route::post('/article/list/update/post', [ArticleController::class, 'updateArtPost'])->name('updateArtPost');
        Route::post('/article/list/print', [ArticleController::class, 'printArtKode'])->name('printArtKode');

        //Customer Route
        Route::get('/customer/setup', [CustomerController::class, 'index']);
        Route::post('/customer/setup/create', [CustomerController::class, 'createCustomer'])->name('createCustomer');
        Route::get('/customer/update/{kodecustomer}', [CustomerController::class, 'updateCustomer'])->name('updateCustomer');
        Route::post('/customer/update/post', [CustomerController::class, 'updateCustomerPost'])->name('updateCustomerPost');
        Route::post('/Customer/update/delete', [CustomerController::class, 'delCustomer'])->name('delCustomer');

        //Supplier Route
        Route::get('/supplier/setup', [SupplierController::class, 'index']);
        Route::post('/supplier/setup/create', [SupplierController::class, 'createsupplier'])->name('createsupplier');
        Route::get('/supplier/update/{kodesupplier}', [SupplierController::class, 'updateSupplier'])->name('updateSupplier');
        Route::post('/supplier/update/post', [SupplierController::class, 'updateSupplierPost'])->name('updateSupplierPost');
        Route::post('/supplier/update/delete', [SupplierController::class, 'delSupplier'])->name('delSupplier');

        //PO
        Route::get('/transaction/po', [PoController::class, 'index']);
        Route::get('/transaction/po/create', [PoController::class, 'createpoview']);
        Route::get('/transaction/po/detail/{idpo}', [PoController::class, 'detailpo'])->name('detailpo');
        Route::post('/transaction/po/create/post', [PoController::class, 'createpo'])->name('createpo');
        Route::post('/transaction/po/filter', [PoController::class, 'getpofilter'])->name('getpofilter');

        //CO
        Route::get('/transaction/co', [CoController::class, 'index']);
        Route::get('/transaction/co/create', [CoController::class, 'createcoview']);
        Route::get('/transaction/co/detail/{idco}', [CoController::class, 'detailco'])->name('detailco');
        Route::post('/transaction/co/create/post', [CoController::class, 'createco'])->name('createco');
        Route::post('/transaction/co/filter', [CoController::class, 'getcofilter'])->name('getcofilter');
        Route::post('/transaction/co/print/invoice', [CoController::class, 'printcoinv'])->name('printcoinv');

        //Buy Back
        Route::get('/buyback', [BBController::class, 'index']);
        Route::post('/buyback', [BBController::class, 'indexPostBB'])->name('indexPostBB');
        Route::get('/buyback/create', [BBController::class, 'createBB']);
        Route::post('/buyback/create/getso', [BBController::class, 'BBgetSO'])->name('BBgetSO');
        Route::post('/buyback/create/get/art', [BBController::class, 'getArticle'])->name('getArticleBB');
        Route::get('/buyback/update/{idbb}', [BBController::class, 'updateBB']);
        Route::post('/buyback/update/post', [BBController::class, 'updateBBPost'])->name('updateBBPost');
        Route::post('/buyback/create/post', [BBController::class, 'createBBPost'])->name('createBBPost');

        //LOG
        Route::get('/log/co', [LogController::class, 'indexlogco']);
        Route::get('/log/co/{idco}', [LogController::class, 'viewidco'])->name('viewidco');

        // Route SO
        Route::get('/transaction/sales', [SOController::class, 'index']);
        Route::post('/transaction/sales', [SOController::class, 'indexPostSo'])->name('indexPostSo');
        Route::get('/transaction/sales/create', [SOController::class, 'createSO']);
        Route::post('/transaction/sales/create/post', [SOController::class, 'createSOPost'])->name('createSOPost');
        Route::post('/transaction/sales/create/getlist', [SOController::class, 'SOGetArticle'])->name('SOGetArticle');
        Route::post('/transaction/sales/create/get/art', [SOController::class, 'getArticle'])->name('getArticleSO');
        Route::post('/transaction/sales/create/get/cust', [SOController::class, 'getCust'])->name('getCustSO');
        Route::get('/transaction/sales/update/{idso}', [SOController::class, 'updateSO']);
        Route::post('/transaction/sales/update/post', [SOController::class, 'updateSOPost'])->name('updateSOPost');
        Route::post('/transaction/sales/print/sertif', [SOController::class, 'printSertif'])->name('printSertif');
        Route::post('/transaction/sales/print/invoice', [SOController::class, 'printInv'])->name('printInv');

        // GL Entries
        Route::get('/gl', [GLController::class, 'index']);
        Route::post('/gl', [GLController::class, 'indexGLPost'])->name('indexGLPost');

        // Mutation
        Route::get('/mutation', [MutationController::class, 'index']);
        Route::post('/mutation/post', [MutationController::class, 'mutationPost'])->name('mutationPost');
        Route::post('/mutation/filter', [MutationController::class, 'mutationFilter'])->name('mutationFilter');
        Route::post('/mutation/getarticle', [MutationController::class, 'mutationGetArticle'])->name('mutationGetArticle');
        Route::post('/mutation/getarticle/detail', [MutationController::class, 'mutationGetArticleDet'])->name('mutationGetArticleDet');
    });

    Route::group(['middleware' => ['levelStandard']],function(){
        //Agenda
        Route::post('/agenda/setup/create', [AgendaController::class, 'createagenda'])->name('createagenda');
        Route::post('/agenda/getdata', [AgendaController::class, 'getagenda'])->name('getagenda');

        // Article Route
        Route::get('/storages', [StorageController::class, 'index']);
        Route::post('/storages', [StorageController::class, 'indexPost'])->name('indexStorage');

        // Article List
        Route::get('/article/list', [ArticleController::class, 'indexlist']);
        Route::post('/article/list', [ArticleController::class, 'articleListPost'])->name('articleListPost');
        Route::get('/article/list/{kodeart}', [ArticleController::class, 'updateArt'])->name('updateArt');
        Route::post('/article/list/print', [ArticleController::class, 'printArtKode'])->name('printArtKode');

        //Customer Route
        Route::get('/customer/setup', [CustomerController::class, 'index']);
        Route::post('/customer/setup/create', [CustomerController::class, 'createCustomer'])->name('createCustomer');
        Route::get('/customer/update/{kodecustomer}', [CustomerController::class, 'updateCustomer'])->name('updateCustomer');

        //CO
        Route::get('/transaction/co/create', [CoController::class, 'createcoview']);
        Route::get('/transaction/co/detail/{idco}', [CoController::class, 'detailco'])->name('detailco');
        Route::post('/transaction/co/create/post', [CoController::class, 'createco'])->name('createco');
        Route::post('/transaction/co/filter', [CoController::class, 'getcofilter'])->name('getcofilter');
        Route::post('/transaction/co/print/invoice', [CoController::class, 'printcoinv'])->name('printcoinv');

        // Route SO
        Route::get('/transaction/sales', [SOController::class, 'index']);
        Route::post('/transaction/sales', [SOController::class, 'indexPostSo'])->name('indexPostSo');
        Route::get('/transaction/sales/create', [SOController::class, 'createSO']);
        Route::post('/transaction/sales/create/post', [SOController::class, 'createSOPost'])->name('createSOPost');
        Route::post('/transaction/sales/create/getlist', [SOController::class, 'SOGetArticle'])->name('SOGetArticle');
        Route::post('/transaction/sales/create/get/art', [SOController::class, 'getArticle'])->name('getArticleSO');
        Route::post('/transaction/sales/create/get/cust', [SOController::class, 'getCust'])->name('getCustSO');
        Route::get('/transaction/sales/update/{idso}', [SOController::class, 'updateSO']);
        Route::post('/transaction/sales/print/sertif', [SOController::class, 'printSertif'])->name('printSertif');
        Route::post('/transaction/sales/print/invoice', [SOController::class, 'printInv'])->name('printInv');
    });
});
