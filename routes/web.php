<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\BenefitController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\BeneficiaryController;
use App\Http\Controllers\StateLgaController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\TrackerController;
use App\Http\Controllers\IndicatorsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\GrmController;
use App\Http\Controllers\DatabaseBackupController;
use App\Http\Controllers\StateBeneficiaryController;
use App\Http\Controllers\AllocationController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\PeaceController;
use App\Http\Controllers\TrainingController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ComplainController;
use App\Http\Controllers\CommunicationController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\WashController;
use App\Http\Controllers\PumpBoreholeController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ScorecardController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\DashboardController;
use Spatie\Permission\Contracts\Role;
use App\Http\Controllers\ComponentController;
use App\Http\Controllers\WardsController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\AttendanceController;

// New work

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
// Route::get('/', function () {
//     return view('auth/login');
// });

Route::get('/', function () {
    return redirect('login');
});

Route::get('/about', function () {
    return view('public/about');
});

Route::get('/results-dashboard', [ResultController::class,'landing']);
// Route::get('/public/results', [ResultController::class,'landing']);
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');

Route::post('register', 'Auth\RegisterController@register');

Route::get('password/forget', function () {
    return view('pages.forgot-password');
})->name('password.forget');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Route::get('/register', function () {
//     return view('pages.register');
// });
Route::get('/login-1', function () {
    return view('pages.login');
});


Route::group(['middleware' => 'auth'], function () {

    // Results dashboard
    Route::get('/results', [ResultController::class,'index']);

    // logout route
    Route::get('/logout', 'Auth\LoginController@logout');
    Route::get('/clear-cache', 'HomeController@clearCache');

    // dashboard route
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/google', [DashboardController::class, 'GoogleView'])->name('dashboard.google');



           //Sessions route
    Route::get('/session/list', 'SessionController@index')->name('session.index');
    Route::get('/session/create', [SessionController::class,'create']);
    Route::post('/session/store', [SessionController::class,'store']);
    Route::get('/session/edit/{id}', [SessionController::class,'edit']);
    Route::post('/session/update', [SessionController::class,'update']);
    Route::get('/session/delete/{id}', [SessionController::class,'destroy']);

        //Attendance route
        Route::get('/attendance/list', 'AttendanceController@index')->name('attendance.index');
        Route::post('/attendance/store', [AttendanceController::class,'store']);
        Route::get('/attendance-admin/list', 'AttendanceController@indexAdmin')->name('attendance-admin.index');
        Route::post('/attendance/store', [AttendanceController::class,'store']);
        Route::post('/attendance/confirmed', [AttendanceController::class,'confirmAttendance']);


    //Education Level routes
    Route::get('/education/list', 'EducationController@index')->name('education.index');
    Route::get('/education/create', [EducationController::class,'create']);
    Route::post('/education/store', [EducationController::class,'store']);
    Route::get('/education/{education}/edit', [EducationController::class,'edit']);
    Route::post('/education/update', [EducationController::class,'update']);
    Route::get('/education/delete/{id}', [EducationController::class,'destroy']);
    Route::get('/education/trashed', [EducationController::class,'getDeletedEducation']);
    Route::get('/education/trashed/{id}', [EducationController::class,'restoreDeletedEducation']);
    Route::get('/education/permanent/{id}', [EducationController::class,'permanentlyDeleteEducation']);

    //Benefit Type Routes
    Route::get('/benefit/list', 'BenefitController@index')->name('benefit.index');
    Route::get('/benefit/create', [BenefitController::class,'create']);
    Route::post('/benefit/store', [BenefitController::class,'store']);
    Route::get('/benefit/edit/{id}', [BenefitController::class,'edit']);
    Route::post('/benefit/update', [BenefitController::class,'update']);
    Route::get('/benefit/delete/{id}', [BenefitController::class,'destroy']);
    Route::get('/benefit/trashed', [BenefitController::class,'getDeletedBenefit']);
    Route::get('/benefit/trashed/{id}', [BenefitController::class,'restoreDeletedBenefit']);
    Route::get('/benefit/permanent/{id}', [BenefitController::class,'permanentlyDeleteBenefit']);


    //Status Type Routes
    Route::get('/status/list', 'StatusController@index')->name('status.index');
    Route::get('/status/create', [StatusController::class,'create']);
    Route::post('/status/store', [StatusController::class,'store']);
    Route::get('/status/{status}/edit', [StatusController::class,'edit']);
    Route::post('/status/update', [StatusController::class,'update']);
    Route::get('/status/delete/{id}', [StatusController::class,'destroy']);
    Route::get('/status/trashed', [StatusController::class,'getDeletedStatus']);
    Route::get('/status/trashed/{id}', [StatusController::class,'restoreDeletedStatus']);
    Route::get('/status/permanent/{id}', [StatusController::class,'permanentlyDeleteStatus']);


    //Beneficiary routes
    Route::get('/beneficiary/list', [BeneficiaryController::class,'index'])->name('beneficiary.index');
    // Route::get('/beneficiary/list-c2', [BeneficiaryController::class,'index_c2']);
    Route::get('/beneficiary/create', [BeneficiaryController::class,'create']);
    // Route::get('/beneficiary/create-c2', [BeneficiaryController::class,'create_c2']);
    Route::post('/beneficiary/store', [BeneficiaryController::class,'store']);
    Route::post('/beneficiary/store_c2', [BeneficiaryController::class,'store_c2']);
    Route::get('/beneficiary/edit/{id}', [BeneficiaryController::class,'edit']);
    Route::get('/beneficiary/view/{id}', [BeneficiaryController::class,'view']);
    Route::get('/beneficiary/edit-c2/{id}', [BeneficiaryController::class,'edit_c2']);
    Route::post('/beneficiary/update', [BeneficiaryController::class,'update']);
    Route::post('/beneficiary/update-c2', [BeneficiaryController::class,'update_c2']);
    Route::get('/beneficiary/trashed', [BeneficiaryController::class,'getDeletedBeneficiaries'])->middleware('permission: manage_defaults') ;
    Route::get('/beneficiary/trashed/{id}', [BeneficiaryController::class,'restoreDeletedBeneficiaries'])->middleware('permission: manage_defaults');
    Route::get('/beneficiary/permanent/{id}', [BeneficiaryController::class,'permanentlyDeleteBeneficiary'])->middleware('permission: manage_defaults');
    Route::post('/beneficiary/import', [BeneficiaryController::class,'store_bulk_upload']);
    Route::get('/beneficiary/download', [BeneficiaryController::class,'download_bulk_template']);
    Route::post('/beneficiary/export', [BeneficiaryController::class,'export']);
    Route::post('/beneficiary/c1-bulk', [BeneficiaryController::class,'store_bulk_training']);
    Route::get('/beneficiary/c1-bulk/list', [BeneficiaryController::class,'c1_bulks']);
    Route::get('/beneficiary/c1-bulk/edit/{id}', [BeneficiaryController::class,'edit_c1_bulks']);
    Route::post('/beneficiary/c1-bulk/update/{id}', [BeneficiaryController::class,'update_c1_bulks']);
    Route::get('/beneficiary/make-fks', [BeneficiaryController::class,'make_fks']);

      //only those have manage_state permission will get access
      Route::group(['middleware' => 'permission:manage_state'], function () {
        Route::get('/beneficiary/delete/{id}', [BeneficiaryController::class,'destroy']);
        Route::get('/beneficiary/c1-bulk/delete/{id}', [BeneficiaryController::class,'delete_c1_bulks']);
     });

    #State-LGA Routes
    Route::post('/get-lga-by-state', [StateLgaController::class,'getLga']);
    Route::post('/get-communnity-by-state', [StateLgaController::class,'getCommunity']);

    #Indicator tracker routes
    Route::get('/indicators/dashboard', [IndicatorsController::class,'index'])->name('indicator.index');
    Route::get('/indicator/create', [IndicatorsController::class,'create']);
    Route::post('/indicator/store', [IndicatorsController::class,'store']);
    Route::get('/indicator/edit/{id}', [IndicatorsController::class,'edit']);
    Route::post('/indicator/update', [IndicatorsController::class,'update']);
    Route::get('/indicator/delete/{id}', [IndicatorsController::class,'destroy']);
    Route::get('/indicator/state', [IndicatorsController::class,'state']);
    Route::get('/indicator/indicator', [IndicatorsController::class,'indicator']);
    Route::get('/indicator/trashed', [IndicatorsController::class,'getDeletedIndicator'])->middleware('permission: manage_defaults');
    Route::get('/indicator/trashed/{id}', [IndicatorsController::class,'restoreDeletedIndicator'])->middleware('permission: manage_defaults');
    Route::get('/indicator/permanent/{id}', [IndicatorsController::class,'permanentlyDeleteIndicator'])->middleware('permission: manage_defaults');

    Route::get('/reports/beneficiaries', [ReportsController::class,'beneficiaries']); //->name('reports.index');
    Route::get('/reports/beneficiaries/{id}', [ReportsController::class,'beneficiaries']); //->name('reports.index');
    Route::get('/reports/projects', [ReportsController::class,'projects']); //->name('reports.index');
    Route::get('/report/create', [ReportsController::class,'create']);
    Route::post('/report/store', [ReportsController::class,'store']);
    Route::get('/report/{report}/show', [ReportsController::class,'show']);

    Route::group(['middleware' => 'role:Super Admin|Admin'], function () {

        Route::get('/report/{report}/edit', [ReportsController::class,'edit']);
        Route::post('/report/update', [ReportsController::class,'update']);
        Route::get('/report/delete/{id}', [ReportsController::class,'destroy']);
        Route::get('/report/trashed', [ReportsController::class,'getDeletedReport'])->middleware('permission: manage_defaults');
        Route::get('/report/trashed/{id}', [ReportsController::class,'restoreDeletedReport'])->middleware('permission: manage_defaults');
        Route::get('/report/permanent/{id}', [ReportsController::class,'permanentlyDeleteReport'])->middleware('permission: manage_defaults');
    });

    // Route::get('/reports', [ReportsController::class,'index'])->name('reports.index');
    // Route::get('/report/create', [ReportsController::class,'create']);


    #Grm Reports
    Route::get('grm/list', [GrmController::class,'index'])->name('grm.index');
    Route::get('grm/create', [GrmController::class,'create']);
    Route::post('grm/store', [GrmController::class,'store']);
    Route::get('grm/show/{report}', [GrmController::class,'show']);
    Route::get('/grm/edit/{report}', [GrmController::class,'edit']);
    Route::post('/grm/update', [GrmController::class,'update']);
    Route::get('/grm/delete/{id}', [GrmController::class,'destroy']);
    Route::get('/grm/trashed', [GrmController::class,'getDeletedGrm'])->middleware('permission: manage_defaults');
    Route::get('/grm/trashed/{id}', [GrmController::class,'restoreDeletedGrm'])->middleware('permission: manage_defaults');
    Route::get('/grm/permanent/{id}', [GrmController::class,'permanentlyDeleteGrm'])->middleware('permission: manage_defaults');


    #States and Beneficiary Controller
    Route::get('/states/beneficiary/{id}', [StateBeneficiaryController::class,'getBeneficiaryByState'])->name('state.beneficiary');
    Route::get('/beneficiary/female/{id}', [StateBeneficiaryController::class,'getFemaleBeneficiariesByState']);
    Route::get('/beneficiary/male/{id}', [StateBeneficiaryController::class,'getMaleBeneficiariesByState']);
    Route::post('/filter-beneficiary', [StateBeneficiaryController::class,'filterBeneficiaries'])->name('filter');
    Route::post('/states/beneficiary-filter/', [StateBeneficiaryController::class,'getBeneficiariesByFilter'])->name('filter-beneficiaries');

    //only those admin and super admins will get access
    Route::group(['middleware' => 'role:Super Admin|Admin'], function () {

        #Chart analytics routes
        Route::get('/charts', [AnalyticsController::class,'index']);
        Route::get('chart/beneficiaries', [AnalyticsController::class,'beneficiary']);
        Route::get('chart/communities', [AnalyticsController::class,'community']);
        Route::get('chart/education', [AnalyticsController::class,'education']);
        Route::get('chart/benefit', [AnalyticsController::class,'benefit']);
        Route::get('chart/status', [AnalyticsController::class,'status']);

        // component route
        Route::get('/components', [ComponentController::class, 'index'])->name('components');
        Route::post('/components/create', [ComponentController::class, 'store']);
        Route::get('/components/edit/{id}', [ComponentController::class, 'edit']);
        Route::post('/components/update', [ComponentController::class, 'update']);
        Route::get('/components/delete/{id}', [ComponentController::class, 'destroy']);


        //Community route
        Route::get('/community/list', 'CommunityController@index')->name('community.index');
        Route::get('/community/create', [CommunityController::class,'create']);
        Route::post('/community/store', [CommunityController::class,'store']);
        Route::get('/community/{community}/edit', [CommunityController::class,'edit']);
        Route::post('/community/update', [CommunityController::class,'update']);
        Route::get('/community/delete/{id}', [CommunityController::class,'destroy']);
        Route::get('/community/trashed', [CommunityController::class,'getDeletedCommunity']);
        Route::get('/community/trashed/{id}', [CommunityController::class,'restoreDeletedCommunity']);
        Route::get('/community/permanent/{id}', [CommunityController::class,'permanentlyDeleteCommunity']);

        //Ward route
        Route::get('/wards/list', 'WardsController@index')->name('wards.index');
        Route::get('/wards/create', [WardsController::class,'create']);
        Route::post('/wards/store', [WardsController::class,'store']);
        Route::get('/wards/edit/{id}', [WardsController::class,'edit']);
        Route::post('/wards/update', [WardsController::class,'update']);
        Route::get('/wards/delete/{id}', [WardsController::class,'destroy']);

        // Route::get('/session/create', [SessionController::class,'create']);
        // Route::post('/session/store', [SessionController::class,'store']);
        // Route::get('/session/edit/{id}', [SessionController::class,'edit']);
        // Route::post('/session/update', [SessionController::class,'update']);
        // Route::get('/session/delete/{id}', [SessionController::class,'destroy']);

        //Sector route
        Route::get('/sectors/list', 'SectorsController@index')->name('sectors.index');
        Route::get('/sectors/create', [SectorsController::class,'create']);
        Route::post('/sectors/store', [SectorsController::class,'store']);
        Route::get('/sectors/edit/{id}', [SectorsController::class,'edit']);
        Route::post('/sectors/update', [SectorsController::class,'update']);
        Route::get('/sectors/delete/{id}', [SectorsController::class,'destroy']);


        #Database Backup
        Route::get('/database/backup', [DatabaseBackupController::class,'create']);



        #Allocations
        Route::get('/allocation/list', 'AllocationController@index')->name('allocation.index');
        Route::get('/allocation/create', [AllocationController::class,'create']);
        Route::post('/allocation/store', [AllocationController::class,'store']);
        Route::get('/allocation/{allocation}/edit', [AllocationController::class,'edit']);
        Route::post('/allocation/update', [AllocationController::class,'update']);
        Route::get('/allocation/delete/{id}', [AllocationController::class,'destroy']);
        Route::get('/allocation/trashed', [AllocationController::class,'getDeletedAllocation']);
        Route::get('/allocation/trashed/{id}', [AllocationController::class,'restoreDeletedAllocation']);
        Route::get('/allocation/permanent/{id}', [AllocationController::class,'permanentlyDeleteAllocation']);

        #Allocations
        Route::get('/investment/list', 'InvestmentController@index')->name('investment.index');
        Route::get('/investment/create', [InvestmentController::class,'create']);
        Route::post('/investment/store', [InvestmentController::class,'store']);
        Route::get('/investment/{investment}/edit', [InvestmentController::class,'edit']);
        Route::post('/investment/update', [InvestmentController::class,'update']);
        Route::get('/investment/delete/{id}', [InvestmentController::class,'destroy']);
        Route::get('/investment/trashed', [InvestmentController::class,'getDeletedInvestment']);
        Route::get('/investment/trashed/{id}', [InvestmentController::class,'restoreDeletedInvestment']);
        Route::get('/investment/permanent/{id}', [InvestmentController::class,'permanentlyDeleteInvestment']);

        #Project
        Route::get('/project/dashboard', 'ProjectController@index')->name('project.index');
        Route::get('/project/create', [ProjectController::class,'create']);
        Route::get('/project/show/{id}', [ProjectController::class,'show']);
        Route::post('/project/store', [ProjectController::class,'store']);
        Route::get('/project/edit/{id}', [ProjectController::class,'edit']);
        Route::post('/project/update', [ProjectController::class,'update']);
        Route::get('/project/delete/{id}', [ProjectController::class,'destroy']);
        Route::get('/project/trashed', [ProjectController::class,'getDeletedProject'])->middleware('permission: manage_defaults');
        Route::get('/project/trashed/{id}', [ProjectController::class,'restoreDeletedProject'])->middleware('permission: manage_defaults');
        Route::get('/project/permanent/{id}', [ProjectController::class,'permanentlyDeleteProject'])->middleware('permission: manage_defaults');
        Route::get('/project/map', [ProjectController::class,'maps']);
        Route::get('/project/location/{latitude}', [ProjectController::class,'ProjectLocation']);

        #Category
        Route::get('/project/categories', [ProjectController::class,'categories'])->name('categories.index');
        Route::get('/project/edit-category/{id}', [ProjectController::class,'edit_category']);
        Route::post('/project/update-category', [ProjectController::class,'update_category']);
        Route::post('/project/store-category', [ProjectController::class,'store_category']);
        Route::get('/project/delete-category/{id}', [ProjectController::class,'destroy_category']);

        #Sub category
        Route::get('/project/sub-categories', [ProjectController::class,'sub_categories'])->name('subcategories.index');
        Route::get('/project/edit-sub-category/{id}', [ProjectController::class,'edit_sub_category']);
        Route::post('/project/update-sub-category', [ProjectController::class,'update_sub_category']);
        Route::post('/project/store-sub-category', [ProjectController::class,'store_sub_category']);
        Route::get('/project/delete-sub-category/{id}', [ProjectController::class,'destroy_sub_category']);


        Route::post('/get-sub-categories-by-category', [ProjectController::class,'getSubCategories']);
        Route::get('/project/status', [ProjectController::class,'status']);



        #Social Activities Controller
        Route::get('/social/list', [SocialController::class,'index'])->name('social.index');
        Route::get('/social/create', [SocialController::class,'create']);
        Route::post('/social/store', [SocialController::class,'store']);
        Route::get('/social/{social}/edit', [SocialController::class,'edit']);
        Route::post('/social/update', [SocialController::class,'update']);
        Route::get('/social/delete/{id}', [SocialController::class,'destroy']);
        Route::get('/social/trashed', [SocialController::class,'getDeletedSocial']);
        Route::get('/social/trashed/{id}', [SocialController::class,'restoreDeletedSocial']);
        Route::get('/social/permanent/{id}', [SocialController::class,'permanentlyDeleteSocial']);


        #Peace groups controller
        Route::get('/peace/list', [PeaceController::class,'index'])->name('peace.index');
        Route::get('/peace/create', [PeaceController::class,'create']);
        Route::post('/peace/store', [PeaceController::class,'store']);
        Route::get('/peace/{peace}/edit', [PeaceController::class,'edit']);
        Route::post('/peace/update', [PeaceController::class,'update']);
        Route::get('/peace/delete/{id}', [PeaceController::class,'destroy']);
        Route::get('/peace/trashed', [PeaceController::class,'getDeletedPeace']);
        Route::get('/peace/trashed/{id}', [PeaceController::class,'restoreDeletedPeace']);
        Route::get('/peace/permanent/{id}', [PeaceController::class,'permanentlyDeletePeace']);


        #Trainings
        Route::get('/training/list', [TrainingController::class,'index'])->name('training.index');
        Route::get('/training/create', [TrainingController::class,'create']);
        Route::post('/training/store', [TrainingController::class,'store']);
        Route::get('/training/{training}/edit', [TrainingController::class,'edit']);
        Route::post('/training/update', [TrainingController::class,'update']);
        Route::get('/training/delete/{id}', [TrainingController::class,'destroy']);
        Route::get('/training/trashed', [TrainingController::class,'getDeletedTraining']);
        Route::get('/training/trashed/{id}', [TrainingController::class,'restoreDeletedTraining']);
        Route::get('/training/permanent/{id}', [TrainingController::class,'permanentlyDeleteTraining']);


        #Feedback
        Route::get('/feedback/list', [FeedbackController::class,'index'])->name('feedback.index');
        Route::get('/feedback/create', [FeedbackController::class,'create']);
        Route::post('/feedback/store', [FeedbackController::class,'store']);
        Route::get('/feedback/{feedback}/edit', [FeedbackController::class,'edit']);
        Route::post('/feedback/update', [FeedbackController::class,'update']);
        Route::get('/feedback/delete/{id}', [FeedbackController::class,'destroy']);
        Route::get('/feedback/trashed', [FeedbackController::class,'getDeletedFeedback']);
        Route::get('/feedback/trashed/{id}', [FeedbackController::class,'restoreDeletedFeedback']);
        Route::get('/feedback/permanent/{id}', [FeedbackController::class,'permanentlyDeleteFeedback']);


        #Complains
        Route::get('/complain/list', [ComplainController::class,'index'])->name('complain.index');
        Route::get('/complain/create', [ComplainController::class,'create']);
        Route::post('/complain/store', [ComplainController::class,'store']);
        Route::get('/complain/{complain}/edit', [ComplainController::class,'edit']);
        Route::post('/complain/update', [ComplainController::class,'update']);
        Route::get('/complain/delete/{id}', [ComplainController::class,'destroy']);
        Route::get('/complain/trashed', [ComplainController::class,'getDeletedComplain']);
        Route::get('/complain/trashed/{id}', [ComplainController::class,'restoreDeletedComplain']);
        Route::get('/complain/permanent/{id}', [ComplainController::class,'permanentlyDeleteComplain']);


        #Communication
        Route::get('/communication/list', [CommunicationController::class,'index'])->name('communication.index');
        Route::get('/communication/create', [CommunicationController::class,'create']);
        Route::post('/communication/store', [CommunicationController::class,'store']);
        Route::get('/communication/{communication}/edit', [CommunicationController::class,'edit']);
        Route::post('/communication/update', [CommunicationController::class,'update']);
        Route::get('/communication/delete/{id}', [CommunicationController::class,'destroy']);
        Route::get('/communication/trashed', [CommunicationController::class,'getDeletedCommunication']);
        Route::get('/communication/trashed/{id}', [CommunicationController::class,'restoreDeletedCommunication']);
        Route::get('/communication/permanent/{id}', [CommunicationController::class,'permanentlyDeleteCommunication']);


        #Transport Infrastructure
        Route::get('/transport/list', [TransportController::class,'index'])->name('transport.index');
        Route::get('/transport/create', [TransportController::class,'create']);
        Route::post('/transport/store', [TransportController::class,'store']);
        Route::get('/transport/{transport}/edit', [TransportController::class,'edit']);
        Route::post('/transport/update', [TransportController::class,'update']);
        Route::get('/transport/delete/{id}', [TransportController::class,'destroy']);
        Route::get('/transport/trashed', [TransportController::class,'getDeletedTransport']);
        Route::get('/transport/trashed/{id}', [TransportController::class,'restoreDeletedTransport']);
        Route::get('/transport/permanent/{id}', [TransportController::class,'permanentlyDeleteTransport']);


        #Wash Infrastructure
        Route::get('/wash/list', [WashController::class,'index'])->name('wash.index');
        Route::get('/wash/create', [WashController::class,'create']);
        Route::post('/wash/store', [WashController::class,'store']);
        Route::get('/wash/{wash}/edit', [WashController::class,'edit']);
        Route::post('/wash/update', [WashController::class,'update']);
        Route::get('/wash/delete/{id}', [WashController::class,'destroy']);
        Route::get('/wash/trashed', [WashController::class,'getDeletedWash']);
        Route::get('/wash/trashed/{id}', [WashController::class,'restoreDeletedWash']);
        Route::get('/wash/permanent/{id}', [WashController::class,'permanentlyDeleteWash']);


        #Borehole
        Route::get('/borehole/list', [PumpBoreholeController::class,'index'])->name('borehole.index');
        Route::get('/borehole/create', [PumpBoreholeController::class,'create']);
        Route::post('/borehole/store', [PumpBoreholeController::class,'store']);
        Route::get('/borehole/{borehole}/edit', [PumpBoreholeController::class,'edit']);
        Route::post('/borehole/update', [PumpBoreholeController::class,'update']);
        Route::get('/borehole/delete/{id}', [PumpBoreholeController::class,'destroy']);
        Route::get('/borehole/trashed', [PumpBoreholeController::class,'getDeletedBorehole']);
        Route::get('/borehole/trashed/{id}', [PumpBoreholeController::class,'restoreDeletedBorehole']);
        Route::get('/borehole/permanent/{id}', [PumpBoreholeController::class,'permanentlyDeleteBorehole']);


        #Schools
        Route::get('/school/list', [SchoolController::class,'index'])->name('school.index');
        Route::get('/school/create', [SchoolController::class,'create']);
        Route::post('/school/store', [SchoolController::class,'store']);
        Route::get('/school/{borehole}/edit', [SchoolController::class,'edit']);
        Route::post('/school/update', [SchoolController::class,'update']);
        Route::get('/school/delete/{id}', [SchoolController::class,'destroy']);
        Route::get('/school/trashed', [SchoolController::class,'getDeletedSchool']);
        Route::get('/school/trashed/{id}', [SchoolController::class,'restoreDeletedSchool']);
        Route::get('/school/permanent/{id}', [SchoolController::class,'permanentlyDeleteSchool']);


        #Schools
        Route::get('/class/list', [ClassroomController::class,'index'])->name('class.index');
        Route::get('/class/create', [ClassroomController::class,'create']);
        Route::post('/class/store', [ClassroomController::class,'store']);
        Route::get('/class/{class}/edit', [ClassroomController::class,'edit']);
        Route::post('/class/update', [ClassroomController::class,'update']);
        Route::get('/class/delete/{id}', [ClassroomController::class,'destroy']);
        Route::get('/class/trashed', [ClassroomController::class,'getDeletedClass']);
        Route::get('/class/trashed/{id}', [ClassroomController::class,'restoreDeletedClass']);
        Route::get('/class/permanent/{id}', [ClassroomController::class,'permanentlyDeleteClass']);



        #Scorecaard Controllers
        Route::get('/scorecard/list', [ScorecardController::class,'index'])->name('scorecard.index');
        Route::get('/scorecard/create', [ScorecardController::class,'create']);
        Route::post('/scorecard/store', [ScorecardController::class,'store']);
        Route::get('/scorecard/{scorecard}/edit', [ScorecardController::class,'edit']);
        Route::post('/scorecard/update', [ScorecardController::class,'update']);
        Route::get('/scorecard/delete/{id}', [ScorecardController::class,'destroy']);
        Route::get('/scorecard/trashed', [ScorecardController::class,'getDeletedScorecard']);
        Route::get('/scorecard/trashed/{id}', [ScorecardController::class,'restoreDeletedScorecard']);
        Route::get('/scorecard/permanent/{id}', [ScorecardController::class,'permanentlyDeleteScorecard']);


        //Media Routes
        Route::get('/media/users', [MediaController::class, 'users']);
        Route::get('/media/projects', [MediaController::class, 'projects']);

    });



    //only those have manage_user permission will get access
    Route::group(['middleware' => 'can:manage_user'], function () {
        Route::get('/users', 'UserController@index');
        Route::get('/user/get-list', 'UserController@getUserList');
        Route::get('/user/create', 'UserController@create');
        Route::post('/user/create', 'UserController@store')->name('create-user');
        Route::get('/user/{id}', 'UserController@edit');
        Route::post('/user/update', 'UserController@update');
        Route::get('/user/delete/{id}', 'UserController@delete');
    });

    //only those have manage_role permission will get access
    Route::group(['middleware' => 'can:manage_role|manage_user'], function () {
        Route::get('/roles', 'RolesController@index');
        Route::get('/role/get-list', 'RolesController@getRoleList');
        Route::post('/role/create', 'RolesController@create');
        Route::get('/role/edit/{id}', 'RolesController@edit');
        Route::post('/role/update', 'RolesController@update');
        Route::get('/role/delete/{id}', 'RolesController@delete');
    });


    //only those have manage_permission permission will get access
    Route::group(['middleware' => 'can:manage_permission|manage_user'], function () {
        Route::get('/permission', 'PermissionController@index');
        Route::get('/permission/get-list', 'PermissionController@getPermissionList');
        Route::post('/permission/create', 'PermissionController@create');
        Route::get('/permission/update', 'PermissionController@update');
        Route::get('/permission/delete/{id}', 'PermissionController@delete');
    });
    Route::get('get-role-permissions-badge', 'PermissionController@getPermissionBadgeByRole');


    // permission examples
    Route::get('/permission-example', function () {
        return view('permission-example');
    });
    // API Documentation
    Route::get('/rest-api', function () {
        return view('api');
    });
    // Editable Datatable
    Route::get('/table-datatable-edit', function () {
        return view('pages.datatable-editable');
    });

    // Themekit demo pages
    Route::get('/calendar', function () {
        return view('pages.calendar');
    });
    Route::get('/charts-amcharts', function () {
        return view('pages.charts-amcharts');
    });
    Route::get('/charts-chartist', function () {
        return view('pages.charts-chartist');
    });
    Route::get('/charts-flot', function () {
        return view('pages.charts-flot');
    });
    Route::get('/charts-knob', function () {
        return view('pages.charts-knob');
    });
    Route::get('/forgot-password', function () {
        return view('pages.forgot-password');
    });
    Route::get('/form-addon', function () {
        return view('pages.form-addon');
    });
    Route::get('/form-advance', function () {
        return view('pages.form-advance');
    });
    Route::get('/form-components', function () {
        return view('pages.form-components');
    });
    Route::get('/form-picker', function () {
        return view('pages.form-picker');
    });
    Route::get('/invoice', function () {
        return view('pages.invoice');
    });
    Route::get('/layout-edit-item', function () {
        return view('pages.layout-edit-item');
    });
    Route::get('/layouts', function () {
        return view('pages.layouts');
    });

    Route::get('/navbar', function () {
        return view('pages.navbar');
    });
    Route::get('/profile', function () {
        return view('pages.profile');
    });
    Route::get('/project', function () {
        return view('pages.project');
    });
    Route::get('/view', function () {
        return view('pages.view');
    });

    Route::get('/table-bootstrap', function () {
        return view('pages.table-bootstrap');
    });
    Route::get('/table-datatable', function () {
        return view('pages.table-datatable');
    });
    Route::get('/taskboard', function () {
        return view('pages.taskboard');
    });
    Route::get('/widget-chart', function () {
        return view('pages.widget-chart');
    });
    Route::get('/widget-data', function () {
        return view('pages.widget-data');
    });
    Route::get('/widget-statistic', function () {
        return view('pages.widget-statistic');
    });
    Route::get('/widgets', function () {
        return view('pages.widgets');
    });

    // themekit ui pages
    Route::get('/alerts', function () {
        return view('pages.ui.alerts');
    });
    Route::get('/badges', function () {
        return view('pages.ui.badges');
    });
    Route::get('/buttons', function () {
        return view('pages.ui.buttons');
    });
    Route::get('/cards', function () {
        return view('pages.ui.cards');
    });
    Route::get('/carousel', function () {
        return view('pages.ui.carousel');
    });
    Route::get('/icons', function () {
        return view('pages.ui.icons');
    });
    Route::get('/modals', function () {
        return view('pages.ui.modals');
    });
    Route::get('/navigation', function () {
        return view('pages.ui.navigation');
    });
    Route::get('/notifications', function () {
        return view('pages.ui.notifications');
    });
    Route::get('/range-slider', function () {
        return view('pages.ui.range-slider');
    });
    Route::get('/rating', function () {
        return view('pages.ui.rating');
    });
    Route::get('/session-timeout', function () {
        return view('pages.ui.session-timeout');
    });
    Route::get('/pricing', function () {
        return view('pages.pricing');
    });
});
