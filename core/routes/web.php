<?php

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

Route::get('/', 'Frontend\Indexcontroller@index')->name('index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'user', 'namespace' => 'User'], function () {
    Route::get('/login', 'UserController@index')->name('user.login');
    Route::post('/loginCheck', 'UserController@loginCheck')->name('user.loginCheck');

    Route::middleware('auth:web')->group(function () {
        Route::get('/dashboard', 'UserController@userDashboard')->name('user.dashboard');
        Route::get('/logout', 'UserController@userLogout')->name('user.logout');

        Route::get('/profile', 'UserController@profile')->name('user.profile');
        Route::post('/profile/update', 'UserController@profileUpdate')->name('user.profile_update');

        Route::get('/change/password', 'UserController@changePassword')->name('user.change.password');
        Route::post('/submit/change/password', 'UserController@submitChangePassword')->name('user.submit.change.password');

        /* Start Survey */
        Route::get('/start/survey', 'SurveyController@startSurvey')->name('start.survey');
        Route::post('/submit/survey', 'SurveyController@submitSurvey')->name('submit.survey');

        Route::get('/collected/data', 'SurveyController@userCollectedData')->name('user.collected.data');
        Route::get('/get-collected-data', 'SurveyController@getCollectedData'); //ajax request
        Route::get('/view/collected/data/{id}/{user_id}', 'SurveyController@userViewCollectedData')->name('user.view.collected.data');
    });
});

Route::group(['prefix' => 'admin', 'namespace' => 'Backend'], function () {
    Route::get('/', 'AdminController@adminLogin')->name('admin.login');
    Route::post('/login', 'AdminController@adminLoginCheck')->name('admin.loginCheck');

    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', 'AdminController@admindashboard')->name('admin.dashboard');
        Route::get('/profile', 'AdminController@profile')->name('profile');
        Route::get('/logout', 'AdminController@adminLogout')->name('admin.logout');

        Route::get('/change/password', 'AdminController@changePassword')->name('change.password');
        Route::post('/submit/change/password', 'AdminController@submitChangePassword')->name('submit.change.password');

        /*Question Category*/
        Route::get('/add/question/category', 'QuestionController@addQuestionCategory')->name('add.question.category');
        Route::post('/save/question/category', 'QuestionController@saveQuestionCategory')->name('save.question.category');
        Route::get('/manage/question/category', 'QuestionController@manageQuestionCategory')->name('manage.question.category');
        Route::get('/get-question-category', 'QuestionController@getQuestionCategory');
        Route::get('/edit/question/category/{id}', 'QuestionController@editQuestionCategory')->name('edit.question.category');
        Route::post('/update/question/category', 'QuestionController@updateQuestionCategory')->name('update.question.category');
        Route::post('/delete/question/category', 'QuestionController@deleteQuestionCategory');
        /* save position */
        Route::post('/save/position', 'QuestionController@SavePosition')->name('save.position');
        /*Question*/
        Route::get('/add/question', 'QuestionController@addQuestion')->name('add.question');
        Route::post('/save/question', 'QuestionController@saveQuestion')->name('save.question');
        Route::get('/question/category/list', 'QuestionController@questionCategoryList')->name('question.category.list');
        Route::get('/get-question-category-filter', 'QuestionController@questionCategoryFilter');
        Route::get('/manage/question/{id}', 'QuestionController@manageQuestion')->name('manage.question');
        Route::get('/get-question', 'QuestionController@getQuestion');
        Route::get('/edit/question/{id}', 'QuestionController@editQuestion')->name('edit.question');
        Route::post('/update/question', 'QuestionController@updateQuestion')->name('update.question');
        Route::post('/delete/question', 'QuestionController@deleteQuestion');

        /*User*/
        Route::get('/add/user', 'UserController@addUser')->name('add.user');
        Route::post('/save/user', 'UserController@saveUser')->name('save.user');
        Route::get('/manage/user', 'UserController@manageUser')->name('manage.user');
        Route::get('/get-user', 'UserController@getUser');
        Route::get('/edit/user/{id}', 'UserController@editUser')->name('edit.user');
        Route::post('/update/user', 'UserController@updateUser')->name('update.user');
        Route::post('/delete/user', 'UserController@deleteUser');

        /* User Track */
        Route::get('/user/track', 'UserController@adminUserTrack')->name('admin.user.track');
        Route::get('/get-user-track', 'UserController@getUserTrack'); //ajax request
        Route::get('/view/login/history/{id}', 'UserController@viewLoginHistory')->name('admin.view.login.history');
        Route::get('/get-user-login-history', 'UserController@getUserLoginHistory'); //ajax request
        Route::get('/view/user/servey/{id}', 'UserController@viewUserServey')->name('admin.view.user.servey');
        Route::get('/get-user-survey', 'UserController@getUserServey'); //ajax request

        /* show survey */
        Route::get('/show/survey', 'SurveyController@showSurvey')->name('show.survey');
        Route::get('/get-survey-all', 'SurveyController@getSurveyAll'); //ajax request
        Route::get('/view/survey/{id}/{user_id}', 'SurveyController@viewSurvey')->name('view.survey');

        /* maps */
        Route::get('/show/maps/{id}', 'SurveyController@showMaps')->name('show.maps');
        Route::get('/all/maps/', 'SurveyController@showMapsAll')->name('show.maps.all');
    });
});
