<?php

use App\Http\Controllers\Api\Client\AnswerController;
use App\Http\Controllers\Api\Client\AudiosController;
use App\Http\Controllers\Api\Client\CardController;
use App\Http\Controllers\Api\Client\CategoriesController;
use App\Http\Controllers\Api\Client\ClientAudioController;
use App\Http\Controllers\Api\Client\ClientController;
use App\Http\Controllers\Api\Client\ClientQuestionController;
use App\Http\Controllers\Api\Client\EducationalLevelsController;
use App\Http\Controllers\Api\Client\EmotionalStatisticsController;
use App\Http\Controllers\Api\Client\EvaluationsController;
use App\Http\Controllers\Api\Client\GenderController;
use App\Http\Controllers\Api\Client\InstitutionController;
use App\Http\Controllers\Api\Client\NewsController;
use App\Http\Controllers\Api\Client\PaymentController;
use App\Http\Controllers\Api\Client\QuestionController;
use App\Http\Controllers\Api\Client\SettingController;
use App\Http\Controllers\Api\Client\ShoppingCartController;
use App\Http\Controllers\Api\Client\PayPalController;

//AUTH
Route::post('/login',[ClientController::class, 'login'])
    ->withoutMiddleware('auth:api_client');

Route::post('/login-third',[ClientController::class, 'loginWithThird'])
    ->withoutMiddleware('auth:api_client');

Route::post('/password-recovery',[ClientController::class, 'passwordRecovery'])
    ->withoutMiddleware('auth:api_client');

Route::get('/validate-code/{code}',[InstitutionController::class, 'validateCode'])
    ->withoutMiddleware('auth:api_client');

Route::get('/educational-levels',[EducationalLevelsController::class, 'educationLevel'])
    ->withoutMiddleware('auth:api_client');

Route::get('/levels/{educationalLevel}',[EducationalLevelsController::class, 'level'])
    ->withoutMiddleware('auth:api_client');

Route::get('/genders',[GenderController::class, 'getGenders'])
    ->withoutMiddleware('auth:api_client');

Route::post('/register',[ClientController::class, 'register'])
    ->withoutMiddleware('auth:api_client');

Route::post('/modify',[ClientController::class, 'modify']);

Route::post('/remove',[ClientController::class, 'removeAccount']);
//EMOTIONAL STATISTICS

Route::post('/emotional-statistics',[EmotionalStatisticsController::class, 'statisticsRegister'])
    ->withoutMiddleware('auth:api_client');

//NEWS
Route::get('/news',[NewsController::class, 'getNews']);

//Programs
Route::get('/category/{category}',[CategoriesController::class, 'getCategory']);
Route::get('/categories',[CategoriesController::class, 'getCategories']);

Route::get('/audio-list/{phase}',[AudiosController::class, 'getAudios']);
Route::get('/high-tech-audio/{phase}',[AudiosController::class, 'getHighTechAudio']);
Route::get('/phases-with-audio/{category}',[AudiosController::class, 'phasesWithAudio']);

//Terms and Conditions
Route::get('/terms',[SettingController::class, 'getTerms']);

//Privacy Policies
Route::get('/privacy',[SettingController::class, 'getPrivacy']);

//Questions
Route::get('/questions',[QuestionController::class, 'getQuestions']);

//Answers
Route::get('/answers',[AnswerController::class, 'getAnswers']);

//Questions
Route::post('/client-question',[ClientQuestionController::class, 'registerClientAnswer']);
Route::get('/verify-answers/{count}',[ClientQuestionController::class,'verifyAnswers']);
//CARDS

Route::post('/create-card',[CardController::class, 'createCard']);

Route::get('/cards',[CardController::class, 'getCards']);

Route::post('/activate-card',[CardController::class, 'activateCard']);

//SHOPPING CAR


Route::get('/shopping-cart',[ShoppingCartController::class, 'getShoppingCart']);

Route::post('/add-to-cart',[ShoppingCartController::class, 'addToShoppingCart']);

Route::post('/delete-to-cart',[ShoppingCartController::class, 'deleteToShoppingCart']);

//Contribution
Route::post('/contribution',[PaymentController::class, 'makeContribution']);
Route::get('/contributions',[PaymentController::class, 'getContributions']);

//Progress
Route::post('/register-audio',[ClientAudioController::class, 'registerAudio']);
Route::get('/progress',[ClientAudioController::class, 'progress']);
Route::post('/register-phase-client',[ClientAudioController::class,'registerPhaseClient']);

//Evaluation
Route::get('/verify-evaluation/{id}',[EvaluationsController::class, 'verifyExistingEvaluation']);
Route::post('/evaluation',[EvaluationsController::class, 'registerEvaluation']);

//PayPal
Route::prefix('paypal')->group(function () {
    Route::post('/create-order', [PayPalController::class, 'createOrder']);
    Route::post('/capture-order', [PayPalController::class, 'captureOrder']);
});
