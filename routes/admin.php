<?php

use App\Http\Controllers\Admin\EducationalLevelController as EducationalLevelController;
use App\Http\Controllers\Admin\IncomeController as IncomeController;
use App\Http\Controllers\Admin\IncomeInstitutionController as IncomeInstitutionController;
use App\Http\Controllers\Admin\IncomePaymentInstitutionController as IncomePaymentInstitutionController;
use App\Http\Controllers\Admin\IncomePaymentClientController as IncomePaymentClientController;
use App\Http\Controllers\Admin\NewController as NewController;
use App\Http\Controllers\Admin\SettingController as SettingController;
use App\Http\Controllers\Admin\TermController as TermController;
use App\Http\Controllers\Admin\PrivacyController as PrivacyController;
use App\Http\Controllers\Admin\UserController as UserController;
use App\Http\Controllers\Auth\LoginController as LoginController;
use App\Http\Controllers\Admin\CategoryController as CategoryController;
use App\Http\Controllers\Admin\InstructiveController as InstructiveController;
use App\Http\Controllers\Admin\ManualController as ManualController;
use App\Http\Controllers\Admin\QuestionnaireController as QuestionnaireController;
use App\Http\Controllers\Admin\AudioController as AudioController;
use App\Http\Controllers\Admin\PhaseController as PhaseController;
use App\Http\Controllers\Admin\InstitutionController as InstitutionController;
use App\Http\Controllers\Admin\ClientController as ClientController;
use App\Http\Controllers\Admin\ClientInstitutionController as ClientInstitutionController;
use \App\Http\Controllers\Admin\ProgramController as ProgramController;
use \App\Http\Controllers\Admin\ActiveClientController as ActiveClientController;
use App\Http\Controllers\Admin\EmotionalStatisticController as EmotionalStatisticController;
use App\Http\Controllers\Admin\DashboardController as DashboardController;
use App\Http\Controllers\Admin\ReportController as ReportController;


use Illuminate\Support\Facades\Route;

/*************** USERS *********************/
Route::prefix('users/')->name('admin.users.')
    ->group(function () {
        Route::get('index', [UserController::class, 'indexContent'])
            ->name('index_content');

        Route::post('upsert/{id}', [UserController::class, 'upsert'])
            ->name('upsert');

        Route::get('status/{id}', [UserController::class, 'status'])
            ->name('status');
    });

Route::post('/admin/user/',
    [UserController::class, 'getAuthUser'])
    ->name('admin.getAuthUser');

/*************** DASHBOARD *********************/
Route::prefix('dashboard/')->name('admin.dashboard.')
    ->group(function () {
        Route::get('index-goals', [DashboardController::class, 'getGoals'])
            ->name('get_goals');

        Route::get('index-users', [DashboardController::class, 'getRegisteredUsersMonth'])
            ->name('get_users');

        Route::get('index-payments', [DashboardController::class, 'getSalesMonth'])
            ->name('get_sales');

        Route::get('index-reproductions', [DashboardController::class, 'getReproductionsMonth'])
            ->name('get_reproductions');

        Route::post('update/{id}', [DashboardController::class, 'alterGoals'])
            ->name('update_goals');

        Route::get('get-incomes', [DashboardController::class, 'getIncomes'])
            ->name('get_incomes');
    });

/*************** CLIENTS *********************/
Route::prefix('clients/')->name('admin.clients.')
    ->group(function () {
        Route::get('index', [ClientController::class, 'indexContent'])
            ->name('index_content');

        Route::post('upsert/{id}', [ClientController::class, 'upsert'])
            ->name('upsert');

        Route::get('status/{id}', [ClientController::class, 'status'])
            ->name('status');

        Route::get('client/{id}', [ClientController::class, 'getClient'])
            ->name('get_client');
    });

/*************** INSTITUTIONS *********************/
Route::prefix('institutions/')->name('admin.institutions.')
    ->group(function () {
        Route::get('index', [InstitutionController::class, 'indexContent'])
            ->name('index_content');

        Route::post('upsert/{id}', [InstitutionController::class, 'upsert'])
            ->name('upsert');

        Route::get('status/{id}', [InstitutionController::class, 'status'])
            ->name('status');

        Route::get('institution/{id}', [InstitutionController::class, 'getInstitution'])
            ->name('get_institution');
    });

/*************** Clients Institutions *********************/
Route::prefix('clients-institutions/{id}/')->name('admin.clients_institutions.')
    ->group(function () {
        Route::get('index', [ClientInstitutionController::class, 'indexContent'])
            ->name('index_content');
    });

/*************** AUDIOS *********************/
Route::prefix('categories/')->name('admin.categories.')
    ->group(function () {
        Route::get('index', [CategoryController::class, 'getContent'])
            ->name('index_content');

        Route::get('category/{id}', [CategoryController::class, 'getCategory'])
            ->name('get_category');

        Route::get('category/{id}/phases', [PhaseController::class, 'getContent'])
            ->name('category_content');

        Route::get('phase/{id}/audio', [AudioController::class, 'getContent'])
            ->name('audios_content');

        Route::get('phase/{id}/audio/evaluations', [AudioController::class, 'getEvaluations'])
            ->name('audios_evaluations');

        Route::get('audio/{id}', [AudioController::class, 'getAudio'])
            ->name('get_audio');

        Route::get('category/{id}/instructive', [InstructiveController::class, 'getInstructive'])
            ->name('get_instructive');

        Route::get('category/{id}/manual', [ManualController::class, 'getManual'])
            ->name('get_manual');

        Route::get('category/{id}/questionnaire', [QuestionnaireController::class, 'getQuestions'])
            ->name('get_questions');

        Route::get('phase_status/{id}', [PhaseController::class, 'status'])
            ->name('phase_status');

        Route::get('phase/{id}', [PhaseController::class, 'getPhase'])
            ->name('get_phase');

        Route::get('audio_status/{id}', [AudioController::class, 'status'])
            ->name('audio_status');

        Route::post('upsert/{id}', [CategoryController::class, 'upsert'])
            ->name('upsert');

        Route::post('addFile', [CategoryController::class, 'addFile'])
            ->name('add_file');

        Route::get('deleteFile', [CategoryController::class, 'deleteFile'])
            ->name('delete_file');

        Route::post('upsert/phase/{id}', [PhaseController::class, 'upsert'])
            ->name('phase_upsert');

        Route::post('/phase/addFile', [PhaseController::class, 'addFile'])
            ->name('phase_add_file');

        Route::post('upsert/audio/{id}', [AudioController::class, 'upsert'])
            ->name('audio_upsert');

        Route::post('/audio/addFile', [AudioController::class, 'addFile'])
            ->name('audio_add_file');

        Route::post('upsert/manual/{id}', [ManualController::class, 'upsert'])
            ->name('manual_upsert');

        Route::post('upsert/instructive/{id}', [InstructiveController::class, 'upsert'])
            ->name('instructive_upsert');

        Route::get('category/{id}/phase-instructive', [InstructiveController::class, 'getPhaseInstructive'])
            ->name('get_phase_instructive');

        Route::get('category/{id}/phase-manual', [ManualController::class, 'getPhaseManual'])
            ->name('get_phase_manual');

        Route::post('upsert/phase-manual/{id}', [ManualController::class, 'upsertPhase'])
            ->name('phase_manual_upsert');

        Route::post('upsert/phase-instructive/{id}', [InstructiveController::class, 'upsertPhase'])
            ->name('phase_instructive_upsert');

        Route::get('category/{id}/phase-affirmations', [InstructiveController::class, 'getPhaseAffirmations'])
            ->name('get_phase_affirmations');

        Route::post('upsert/phase-affirmations/{id}', [InstructiveController::class, 'upsertPhaseAffirmations'])
            ->name('phase_affirmations_upsert');
    });

Route::post('upsert/{id}/questions', [QuestionnaireController::class, 'upsert'])
    ->name('questions_upsert');

/***************** PROGRAMS **********************/
Route::prefix('programs/')->name('admin.programs.')
    ->group(function () {
        Route::get('index', [ProgramController::class, 'indexContent'])
            ->name('index_content');

        Route::post('update/{id}', [ProgramController::class, 'update'])
            ->name('update');

        Route::get('status/{id}', [ProgramController::class, 'status'])
            ->name('status');
    });

/***************** INCOME **********************/
Route::prefix('income/')->name('admin.income.')
    ->group(function () {
        Route::get('index', [IncomeController::class, 'indexContent'])
            ->name('index_content');

        Route::get('status/{id}/{type}', [IncomeController::class, 'status'])
            ->name('status');

        Route::get('codeChange/{id}', [IncomeController::class, 'codeChange'])
            ->name('codeChange');
    });

/*************** Income Institutions *********************/
Route::prefix('income-institutions/{id}/')->name('admin.income_institutions.')
    ->group(function () {
        Route::get('index', [IncomeInstitutionController::class, 'indexContent'])
            ->name('index_content');
    });

/*************** Income Payments Institutions *********************/
Route::prefix('income-payments-institutions/{id}/')->name('admin.income_payments_institutions.')
    ->group(function () {
        Route::get('index', [IncomePaymentInstitutionController::class, 'indexContent'])
            ->name('index_content');
    });

/*************** Income Payments Clients *********************/
Route::prefix('income-payments-clients/{id}/')->name('admin.income_payments_clients.')
    ->group(function () {
        Route::get('index', [IncomePaymentClientController::class, 'indexContent'])
            ->name('index_content');
    });

/***************** REPORTS ACTIVE CLIENTS  **********************/
Route::prefix('reports-active-clients/')->name('admin.reports_active_clients.')
    ->group(function () {
        Route::get('index', [ActiveClientController::class, 'indexContent'])
            ->name('index_content');

        Route::get('filter-index', [ActiveClientController::class, 'filterContent'])
            ->name('filter_content');
    });

/***************** REPORTS INCOME STATISTICS **********************/
Route::prefix('reports-income-statistics/')->name('admin.reports_income_statistics.')
    ->group(function () {
        Route::get('index', [EmotionalStatisticController::class, 'indexContent'])
            ->name('index_content');
    });

/***************** REPORTS  **********************/
Route::prefix('reports/')->name('admin.reports.')
    ->group(function () {
        Route::get('lfu-first_questionnaire', [ReportController::class, 'lfuFirstQuestionnaireContent'])
            ->name('lfu_first_questionnaire');

        Route::get('lfu-second_questionnaire', [ReportController::class, 'lfuSecondQuestionnaireContent'])
            ->name('lfu_second_questionnaire');

        Route::get('lfu-education', [ReportController::class, 'lfuEducationContent'])
            ->name('lfu_education');

        Route::get('general-users', [ReportController::class, 'generalUsersContent'])
            ->name('general_users');

        Route::get('export-general-users', [ReportController::class, 'generalUsersExcelExport'])
            ->name('export_general_users');

        Route::get('export-lfuEducation', [ReportController::class, 'lfuEducationExcelExport'])
            ->name('export_lfuEducation');

        Route::get('get-educational-levels', [ReportController::class, 'getEducationalLevels'])
            ->name('get_educational_levels');

        Route::get('export-lfuEducationFirstQuestionnaire', [ReportController::class, 'lfuEducationFirstQuestionnaireExcelExport'])
            ->name('export_lfuEducationFirstQuestionnaire');

        Route::get('export-lfuEducationSecondQuestionnaire', [ReportController::class, 'lfuEducationSecondQuestionnaireExcelExport'])
            ->name('export_lfuEducationSecondQuestionnaire');
    });


/*************** SETTINGS *********************/
Route::prefix('settings/')->name('admin.settings.')
    ->group(function () {
        Route::get('index', [SettingController::class, 'indexContent'])
            ->name('index_content');

        Route::get('status/{id}', [SettingController::class, 'status'])
            ->name('status');
    });

/*************** Settings News *********************/
Route::prefix('settings-news/')->name('admin.settings_news.')
    ->group(function () {
        Route::get('index', [NewController::class, 'indexContent'])
            ->name('index_content');

        Route::post('upsert/{id}', [NewController::class, 'upsert'])
            ->name('upsert');

        Route::get('status/{id}', [NewController::class, 'status'])
            ->name('status');
    });

/*************** Settings Terms *********************/
Route::prefix('settings-terms/')->name('admin.settings_terms.')
    ->group(function () {
        Route::get('getTerms', [TermController::class, 'getTerms'])
            ->name('get_terms');

        Route::post('upsert', [TermController::class, 'upsert'])
            ->name('upsert');
    });

/*************** Settings Privacy *********************/
Route::prefix('settings-privacy/')->name('admin.settings_privacy.')
    ->group(function () {
        Route::get('getPrivacy', [PrivacyController::class, 'getPrivacy'])
            ->name('get_privacy');

        Route::post('upsert', [PrivacyController::class, 'upsert'])
            ->name('upsert');
    });

/*************** Settings Educational Level *********************/
Route::prefix('settings-educational-levels/')->name('admin.settings_educational_levels.')
    ->group(function () {
        Route::get('getEducationalLevel', [EducationalLevelController::class, 'getEducationalLevel'])
            ->name('get_educational_level');

        Route::post('upsert/{id}', [EducationalLevelController::class, 'upsert'])
            ->name('upsert');
    });

/***************** AUTH **********************/
Route::get('/admin/logout',
    [LoginController::class, 'logout'])
    ->name('admin.logout');


/***************** VUE ROUTER **********************/
Route::get('/{any}', function () {
    return view('admin.main');
})->where('any', '.*');
