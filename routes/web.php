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



Auth::routes();
Route::get('/', 'HomeController@index')->name('home');
Route::get('home', 'HomeController@index')->name('home');
Route::get('welcome', 'HomeController@index')->name('');
//Route::get('/users', 'UsersController@index')->name('users');
Route::resource('users', 'UsersController');
Route::get('logout', 'LoginController@logout');
Route::resource('currencies', 'CurrenciesController');
Route::resource('exchanges', 'ExchangesController');

Route::resource('sponsors', 'SponsorsController');
Route::get('accounts/attachments/{id}', 'AccountsController@attachments')->name('accounts.attachments');
Route::resource('accounts', 'AccountsController');
Route::get('accounts/{sponsor_id}', 'AccountsController@show');
Route::delete('accounts/{account}/{sponsor_id}', 'AccountsController@destroy');
Route::get('accounts/report/{id}', 'AccountsController@report')->name('accounts.report');
Route::resource('useraccounts', 'UserAccountsController');
Route::get('useraccounts/{user_id}', 'UserAccountsController@show');

Route::get('/addMember', 'FamiliesController@addMember');
Route::post('/updateMember', 'FamiliesController@updateMember');
Route::post('/deleteMember', 'FamiliesController@deleteMember');
Route::get('/getMembers', 'FamiliesController@getMembers');



Route::get('/addDetail', 'FamiliesController@addDetail');
Route::post('/updateDetail', 'FamiliesController@updateDetail');
Route::post('/deleteDetail', 'FamiliesController@deleteDetail');
Route::get('/deleteDetail/{id}', 'FamiliesController@deleteDetail');
Route::get('/getDetails', 'FamiliesController@getDetails');


Route::get('/addMainAccount', 'FamiliesController@addMainAccount');
Route::post('/updateMainAccount', 'FamiliesController@updateMainAccount');
Route::get('/deleteMainAccount/{id}', 'FamiliesController@deleteMainAccount');
Route::get('/getMainAccount', 'FamiliesController@getMainAccount');
Route::get('/getFamilyMainAccount', 'FamiliesController@getFamilyMainAccount');
Route::get('/getSponsorAccount', 'FamiliesController@getSponsorAccount');
Route::post('/UploadImage', 'FamiliesController@UploadImage'); 
Route::get('/getImages', 'FamiliesController@getImages'); 

Route::get('/addChangement', 'FamiliesController@addChangement');
Route::post('/updateChangement', 'FamiliesController@updateChangement');
Route::get('/deleteChangement/{id}', 'FamiliesController@deleteChangement');
Route::get('/getChangements', 'FamiliesController@getChangements');


Route::get('/getCharges', 'FamiliesController@getCharges');

Route::get('/addFollowup', 'MothersInfoController@addFollowup');
Route::post('/updateFollowup', 'MothersInfoController@updateFollowup');
Route::post('/deleteFollowup', 'MothersInfoController@deleteFollowup');
Route::get('/getFollowup', 'MothersInfoController@getFollowup');

Route::get('/deleteMember/{id}', 'FamiliesController@deleteMember');


Route::get('families/account/{id}', 'FamiliesController@account')->name('families.account');
Route::get('families/details/{id}', 'FamiliesController@details')->name('families.details');
Route::get('families/declaration/{id}', 'FamiliesController@declaration')->name('families.declaration');

Route::post('/deleteimage/{id}', 'FamiliesController@deleteimage');
Route::get('families/cheque/{id}', 'FamiliesController@cheque')->name('families.cheque');
//Route::get('families/attachments/{id}', 'FamiliesController@attachments')->name('families.attachments');
Route::get('families/report/{id}', 'FamiliesController@report')->name('families.report');
Route::resource('families', 'FamiliesController');

Route::post('/updateUser', 'FamiliesController@updateUser');
Route::resource('salarybreakdowns', 'SalaryBreakDownsController');
Route::get('salarybreakdowns/{user_id}', 'SalaryBreakDownsController@show');
Route::delete('salarybreakdowns/{salarybreakdown}/{user_id}', 'SalaryBreakDownsController@destroy');

Route::get('/getmemberInfo', 'FamilyMembersController@getmemberInfo');
Route::get('/addMemberInfo', 'FamilyMembersController@addMemberInfo');
Route::post('/updateMemberInfo', 'FamilyMembersController@updateMemberInfo');
Route::get('/deleteMemberInfo/{id}', 'FamilyMembersController@deleteMemberInfo');

Route::get('/getacademicInfo', 'FamilyMembersController@getacademicInfo');
Route::get('/addAcademicInfo', 'FamilyMembersController@addAcademicInfo');
Route::post('/updateAcademicInfo', 'FamilyMembersController@updateAcademicInfo');
Route::get('/deleteAcademicInfo/{id}', 'FamilyMembersController@deleteAcademicInfo');

Route::delete('familymembers/{familymember}/{family_id}', 'FamilyMembersController@destroy');
Route::resource('familymembers', 'FamilyMembersController');
Route::resource('regions', 'RegionsController');
Route::resource('mothersinfo', 'MothersInfoController');
Route::resource('periods', 'PeriodsController');
Route::resource('charges', 'ChargesController');
Route::resource('changements', 'ChangementsController');
Route::resource('donations', 'DonationsController');
Route::post('accountreport/filter', 'AccountReportController@filter')->name('accountreport.filter');
Route::resource('accountreport', 'AccountReportController');
Route::post('donationreport/filter', 'DonationReportController@filter')->name('donationreport.filter');
Route::resource('donationreport', 'DonationReportController');
Route::post('membersreport/filter', 'MembersReportController@filter')->name('membersreport.filter');
Route::resource('membersreport', 'MembersReportController');