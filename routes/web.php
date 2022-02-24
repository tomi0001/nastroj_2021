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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/loginDr', [App\Http\Controllers\doctorController::class, 'loginDr'])->name('doctorlogin');
Route::get('/register', [App\Http\Controllers\HomeController::class, 'register'])->name('register');
Route::post('/registerSubmit', [App\Http\Controllers\RegisterController::class, 'registerSubmit'])->name('registerSubmits');
Route::get('/loginUser', [App\Http\Controllers\HomeController::class, 'loginUser'])->name('userlogin');
Route::post("/loginDr",[App\Http\Controllers\doctorController::class, 'loginDoctor'])->name("loginDoctor");
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('main');


Route::get('/users.addMood', [App\Http\Controllers\Mood\MoodController::class, 'addTestMood'])->name('users.addMood')
                    ->middleware('auth')->middleware('can:users');
Route::get('/users/{year?}/{month?}/{day?}/{action?}', [App\Http\Controllers\Main\MainController::class, 'index'])->name('users.main')
        ->middleware('auth')->middleware('can:users');            
Route::get('/users.drugsAdd', [App\Http\Controllers\Main\MainController::class, 'addProduct'])->name('users.drugsAdd')
                    ->middleware('auth')->middleware('can:users');
Route::get('/users.moodAdd',  [App\Http\Controllers\Main\MainController::class, 'addMood'])->name('users.moodAdd')
                    ->middleware('auth')->middleware('can:users');
Route::get('/users.sleepAdd', [App\Http\Controllers\Main\MainController::class, 'addSleep'])->name('users.sleepAdd')
                    ->middleware('auth')->middleware('can:users');
Route::get('/users.actionDayAdd', [App\Http\Controllers\Main\MainController::class, 'addActionDay'])->name('users.actionDaypAdd')
                    ->middleware('auth')->middleware('can:users');
                    
                    
            
Route::get("/ajax/atHourActonPlan",[App\Http\Controllers\Main\MainController::class, 'atHourActonPlan'])
                    ->name("ajax.atHourActonPlan")->middleware('auth')->middleware('can:users');     
Route::get("/ajax/showAllSubstance", [App\Http\Controllers\Main\MainController::class, 'showAllSubstance'])
                    ->name("ajax.showAllSubctance")->middleware('auth')->middleware('can:users');            
Route::get("/ajax/deleteActionDay",[App\Http\Controllers\Main\MainController::class, 'deleteActionDay'])
        ->name("ajax.deleteActionDay")->middleware('auth')->middleware('can:users');
Route::get("/ajax/editActionDay",[App\Http\Controllers\Main\MainController::class, 'editActionDay'])
        ->name("ajax.editActionDay")->middleware('auth')->middleware('can:users');
Route::get("/ajax/cancelActionDay",[App\Http\Controllers\Main\MainController::class, 'cancelActionDay'])
        ->name("ajax.cancelActionDay")->middleware('auth')->middleware('can:users');
Route::get("/ajax/updateActionDay",[App\Http\Controllers\Main\MainController::class, 'updateActionDay'])
        ->name("ajax.updateActionDay")->middleware('auth')->middleware('can:users');
Route::get("/ajax/updateMood",[App\Http\Controllers\Main\MainController::class, 'updateMood'])
        ->name("ajax.updateMood")->middleware('auth')->middleware('can:users');
Route::get("/ajax/deleteMood",[App\Http\Controllers\Main\MainController::class, 'deleteMood'])
        ->name("ajax.deleteMood")->middleware('auth')->middleware('can:users');
Route::get("/ajax/editMoodDescription",[App\Http\Controllers\Main\MainController::class, 'editMoodDescription'])
        ->name("ajax.editMoodDescription")->middleware('auth')->middleware('can:users');
Route::get("/ajax/updateDescription",[App\Http\Controllers\Main\MainController::class, 'updateDescription'])
        ->name("ajax.updateDescription")->middleware('auth')->middleware('can:users');
Route::get("/ajax/showMoodDescription",[App\Http\Controllers\Main\MainController::class, 'showMoodDescription'])
        ->name("ajax.showMoodDescription")->middleware('auth')->middleware('can:users');
Route::get("/ajax/showAction",[App\Http\Controllers\Main\MainController::class, 'showAction'])
        ->name("ajax.showAction")->middleware('auth')->middleware('can:users');
Route::get("/ajax/showDrugs",[App\Http\Controllers\Main\MainController::class, 'showDrugs'])
        ->name("ajax.showDrugs")->middleware('auth')->middleware('can:users');
Route::get("/ajax/editActionMood",[App\Http\Controllers\Main\MainController::class, 'editActionMood'])
        ->name("ajax.editActionMood")->middleware('auth')->middleware('can:users');
Route::get("/ajax/updateAction",[App\Http\Controllers\Main\MainController::class, 'updateAction'])
        ->name("ajax.updateAction")->middleware('auth')->middleware('can:users');
Route::get("/ajax/showMoodDescriptionSleep",[App\Http\Controllers\Main\MainController::class, 'showMoodDescriptionSleep'])
        ->name("ajax.showMoodDescriptionSleep")->middleware('auth')->middleware('can:users');
Route::get("/ajax/updateSleep",[App\Http\Controllers\Main\MainController::class, 'updateSleep'])
        ->name("ajax.updateSleep")->middleware('auth')->middleware('can:users');
Route::get("/ajax/editSleepDescription",[App\Http\Controllers\Main\MainController::class, 'editSleepDescription'])
        ->name("ajax.editSleepDescription")->middleware('auth')->middleware('can:users');
Route::get("/ajax/deleteSleep",[App\Http\Controllers\Main\MainController::class, 'deleteSleep'])
        ->name("ajax.deleteSleep")->middleware('auth')->middleware('can:users');
Route::get("/ajax/deleteDrugs",[App\Http\Controllers\Main\MainController::class, 'deleteDrugs'])
        ->name("ajax.deleteDrugs")->middleware('auth')->middleware('can:users');
Route::get("/ajax/showDescriptionDrugs",[App\Http\Controllers\Main\MainController::class, 'showDescriptionDrugs'])
        ->name("ajax.showDescriptionDrugs")->middleware('auth')->middleware('can:users');
Route::get("/ajax/addDescriptionDrugs",[App\Http\Controllers\Main\MainController::class, 'addDescriptionDrugs'])
        ->name("ajax.addDescriptionDrugs")->middleware('auth')->middleware('can:users');
Route::get("/ajax/editDrugs",[App\Http\Controllers\Main\MainController::class, 'editDrugs'])
        ->name("ajax.editDrugs")->middleware('auth')->middleware('can:users');
Route::get("/ajax/updateDrugs",[App\Http\Controllers\Main\MainController::class, 'updateDrugs'])
        ->name("ajax.updateDrugs")->middleware('auth')->middleware('can:users');
Route::get("/ajax/loadTypePortion",[App\Http\Controllers\Main\MainController::class, 'loadTypePortion'])
        ->name("ajax.loadTypePortion")->middleware('auth')->middleware('can:users');
Route::get("/ajax/actionPlanedpAdd",[App\Http\Controllers\Main\MainController::class, 'actionPlanedpAdd'])
        ->name("users.actionPlanedpAdd")->middleware('auth')->middleware('can:users');
Route::get("/ajax/showAverage",[App\Http\Controllers\Main\MainController::class, 'showAverage'])
        ->name("ajax.showAverage")->middleware('auth')->middleware('can:users');
Route::get("/ajax/sumAverage",[App\Http\Controllers\Main\MainController::class, 'sumAverage'])
        ->name("ajax.sumAverage")->middleware('auth')->middleware('can:users');



Route::get("/settings/addNewAction",[App\Http\Controllers\Settings\SettingsMoodController::class, 'addNewAction'])
        ->name("settings.addNewAction")->middleware('auth')->middleware('can:users');
Route::get("/settings/addNewActionSubmit",[App\Http\Controllers\Settings\SettingsMoodController::class, 'addNewActionSubmit'])
        ->name("settings.addNewActionSubmit")->middleware('auth')->middleware('can:users');

Route::get("/settings/levelMood",[App\Http\Controllers\Settings\SettingsMoodController::class, 'levelMood'])
        ->name("settings.levelMood")->middleware('auth')->middleware('can:users');
Route::get("/settings/levelMoodSubmit",[App\Http\Controllers\Settings\SettingsMoodController::class, 'levelMoodSubmit'])
        ->name("settings.levelMoodSubmit")->middleware('auth')->middleware('can:users');

Route::get("/settings/changeNameAction",[App\Http\Controllers\Settings\SettingsMoodController::class, 'changeNameAction'])
        ->name("settings.changeNameAction")->middleware('auth')->middleware('can:users');
Route::get("/settings/changeNameActionSubmit",[App\Http\Controllers\Settings\SettingsMoodController::class, 'changeNameActionSubmit'])
        ->name("settings.changeNameActionSubmit")->middleware('auth')->middleware('can:users');

Route::get("/settings/loadValuePlasure",[App\Http\Controllers\Settings\SettingsMoodController::class, 'loadValuePlasure'])
        ->name("settings.loadValuePlasure")->middleware('auth')->middleware('can:users');

Route::get("/settings/changeDateAction",[App\Http\Controllers\Settings\SettingsMoodController::class, 'changeDateAction'])
        ->name("settings.changeDateAction")->middleware('auth')->middleware('can:users');
Route::get("/settings/changeDateActionSubmit",[App\Http\Controllers\Settings\SettingsMoodController::class, 'changeDateActionSubmit'])
        ->name("settings.changeDateActionSubmit")->middleware('auth')->middleware('can:users');

Route::get("/settings/loadActionChange",[App\Http\Controllers\Settings\SettingsMoodController::class, 'loadActionChange'])
        ->name("settings.loadActionChange")->middleware('auth')->middleware('can:users');

Route::get("/settings/deleteAction",[App\Http\Controllers\Settings\SettingsMoodController::class, 'deleteAction'])
        ->name("settings.deleteAction")->middleware('auth')->middleware('can:users');



Route::get("/settings/addNewGroup",[App\Http\Controllers\Settings\SettingsProductController::class, 'addNewGroup'])
        ->name("settings.addNewGroup")->middleware('auth')->middleware('can:users');
Route::get("/settings/addNewGroupSubmit",[App\Http\Controllers\Settings\SettingsProductController::class, 'addNewGroupSubmit'])
        ->name("settings.addNewGroupSubmit")->middleware('auth')->middleware('can:users');

Route::get("/settings/addNewSubstance",[App\Http\Controllers\Settings\SettingsProductController::class, 'addNewSubstance'])
        ->name("settings.addNewSubstance")->middleware('auth')->middleware('can:users');
Route::get("/settings/addNewSubstanceSubmit",[App\Http\Controllers\Settings\SettingsProductController::class, 'addNewSubstanceSubmit'])
        ->name("settings.addNewSubstanceSubmit")->middleware('auth')->middleware('can:users');

Route::get("/settings/addNewProduct",[App\Http\Controllers\Settings\SettingsProductController::class, 'addNewProduct'])
        ->name("settings.addNewProduct")->middleware('auth')->middleware('can:users');
Route::get("/settings/addNewProductSubmit",[App\Http\Controllers\Settings\SettingsProductController::class, 'addNewProductSubmit'])
        ->name("settings.addNewProductSubmit")->middleware('auth')->middleware('can:users');

Route::get("/settings/editGroup",[App\Http\Controllers\Settings\SettingsProductController::class, 'editGroup'])
        ->name("settings.editGroup")->middleware('auth')->middleware('can:users');
Route::get("/settings/editGroupSubmit",[App\Http\Controllers\Settings\SettingsProductController::class, 'editGroupSubmit'])
        ->name("settings.editGroupSubmit")->middleware('auth')->middleware('can:users');

Route::get("/settings/editSubstance",[App\Http\Controllers\Settings\SettingsProductController::class, 'editSubstance'])
        ->name("settings.editSubstance")->middleware('auth')->middleware('can:users');
Route::get("/settings/editSubstanceSubmit",[App\Http\Controllers\Settings\SettingsProductController::class, 'editSubstanceSubmit'])
        ->name("settings.editSubstanceSubmit")->middleware('auth')->middleware('can:users');

Route::get("/settings/editProduct",[App\Http\Controllers\Settings\SettingsProductController::class, 'editProduct'])
        ->name("settings.editProduct")->middleware('auth')->middleware('can:users');
Route::get("/settings/editProductSubmit",[App\Http\Controllers\Settings\SettingsProductController::class, 'editProductSubmit'])
        ->name("settings.editProductSubmit")->middleware('auth')->middleware('can:users');

Route::get("/settings/changeProduct",[App\Http\Controllers\Settings\SettingsProductController::class, 'changeProduct'])
        ->name("settings.changeProduct")->middleware('auth')->middleware('can:users');

Route::get("/settings/changeSubstance",[App\Http\Controllers\Settings\SettingsProductController::class, 'changeSubstance'])
        ->name("settings.changeSubstance")->middleware('auth')->middleware('can:users');

Route::get("/settings/planedDose",[App\Http\Controllers\Settings\SettingsProductController::class, 'planedDose'])
        ->name("settings.planedDose")->middleware('auth')->middleware('can:users');
Route::get("/settings/planedDoseSubmit",[App\Http\Controllers\Settings\SettingsProductController::class, 'planedDoseSubmit'])
        ->name("settings.planedDoseSubmit")->middleware('auth')->middleware('can:users');
Route::get("/settings/addNewPlaned",[App\Http\Controllers\Settings\SettingsProductController::class, 'addNewPlaned'])
        ->name("settings.addNewPlaned")->middleware('auth')->middleware('can:users');
Route::get("/settings/loadChangePlaned",[App\Http\Controllers\Settings\SettingsProductController::class, 'loadChangePlaned'])
        ->name("settings.loadChangePlaned")->middleware('auth')->middleware('can:users');
Route::get("/settings/deletePlaned",[App\Http\Controllers\Settings\SettingsProductController::class, 'deletePlaned'])
        ->name("settings.deletePlaned")->middleware('auth')->middleware('can:users');
Route::get("/settings/editPlanedsubmit",[App\Http\Controllers\Settings\SettingsProductController::class, 'editPlanedsubmit'])
        ->name("setting.editPlanedsubmit")->middleware('auth')->middleware('can:users');


Route::get('/users4/{year?}/{month?}/{day?}/{action?}', [App\Http\Controllers\Search\SearchController::class, 'index2'])->name('users.search')
                    ->middleware('auth')->middleware('can:users');
            
Route::get('/users.settings', [App\Http\Controllers\Settings\SettingsController::class, 'index'])->name('users.setting')
                    ->middleware('auth')->middleware('can:users');
            
            
            
            
            
Route::get('/doctor', [App\Http\Controllers\HomeController::class, 'index2'])->name('doctor.main')->middleware('auth')->middleware('can:doctor');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout')->middleware('auth');
