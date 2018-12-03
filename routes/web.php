<?php

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

Route::get('/', 'HomeController@index')->name('home');

# auth
Auth::routes();

# uploader
Route::post('/upload', 'UploadController@up')->name('upload.up');
Route::post('/upload/remove', 'UploadController@down')->name('upload.down');
Route::post('/upload/datatable', 'UploadController@datatable')->name('upload.datatable');
Route::get('/upload/get/{id}', 'UploadController@get')->name('upload.get');

# Backend
Route::group([
  "prefix"     => "bismillah",
  "namespace"  => "Backend",
  "middleware" => [
    "auth"
  ],
], function() {
  # index
  Route::get('/', function() {
    if (Route::has('login')) {
      return redirect()->route('dashboard');
    } else {
      return redirect()->route('login');
    }
  });

  # dashboard
  Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

  # config
  Route::resource('configuration', 'ConfigurationController');

  # faq
  Route::post('faq/datatable', 'FaqController@datatable')->name('faq.datatable');
  Route::post('faq/delete', 'FaqController@delete')->name('faq.delete');
  Route::resource('faq', 'FaqController');

  # speaker
  Route::post('speaker/datatable', 'SpeakerController@datatable')->name('speaker.datatable');
  Route::post('speaker/delete', 'SpeakerController@delete')->name('speaker.delete');
  Route::resource('speaker', 'SpeakerController');

  # speaker
  Route::post('sponsor/datatable', 'SponsorController@datatable')->name('sponsor.datatable');
  Route::post('sponsor/delete', 'SponsorController@delete')->name('sponsor.delete');
  Route::resource('sponsor', 'SponsorController');

  # location
  Route::post('location/datatable', 'LocationController@datatable')->name('location.datatable');
  Route::post('location/delete', 'LocationController@delete')->name('location.delete');
  Route::resource('location', 'LocationController');

  # event
  Route::post('event/datatable', 'EventController@datatable')->name('event.datatable');
  Route::post('event/delete', 'EventController@delete')->name('event.delete');
  Route::resource('event', 'EventController');

  # gallery
  Route::post('gallery/datatable', 'GalleryController@datatable')->name('gallery.datatable');
  Route::post('gallery/delete', 'GalleryController@delete')->name('gallery.delete');
  Route::resource('gallery', 'GalleryController');
});
