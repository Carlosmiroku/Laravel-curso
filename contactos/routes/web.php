<?php


use App\Mail\ContactMe;
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

/*Route::get('hola', function () {
   return view('welcome');
});

Route::get('/', function () {
	return 'Lista de contactos!';
});

Route::get('saludo/{name}', function ($name) {
	return 'Hola' . $name;
}); */

//Route::get('contacts', 'ContactsController@index');


Route::get('/', ['as' => 'index', function() {

	return 'Contactos!';
}]);
Route::get('contacts/{contact}/confirm-deletion', [
	'as' => 'contacts.confirm.destroy',
	'uses' => 'ContactsController@confirmDestroy',
	]);

Route::resource('contacts', 'ContactsController');

/*use Illuminate\Http\Request;
Route::get('countries/{country}/states/{state}', function(Request $request) {
	$country = $request->route('country');
	$state = $request->route('state');
	return 'Pais: ' . $country . ' Estado:  ' . $state;
});*/



Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('send-my-contact-information', function () {
	Mail::to('cemmanuel298@gmail.com')->send(new ContactMe());
	return 'Datos Enviados...';
});

Route::get('text', function() {
	 return view('emails.myContactInformation');
	
});