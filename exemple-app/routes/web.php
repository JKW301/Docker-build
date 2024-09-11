<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\FaireUnDonController;
use App\Http\Controllers\AlerteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\PersonnelController;
use App\Http\Controllers\MaterielController;
use App\Http\Controllers\SalleController;
use App\Http\Controllers\MaraudeController;
use App\Http\Controllers\ChargementController;
use App\Http\Controllers\ProduitController;

use App\Http\Controllers\CoursController;
use App\Http\Controllers\VehiculeController;

use App\Http\Controllers\EntrepotController;
use App\Http\Controllers\NourritureController;

use App\Http\Controllers\CertificationController;


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
    return view('welcome');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::get('/planning', function () {
    return view('planning');
})->name('planning');



Route::get('/event', 'App\Http\Controllers\EventController@index')->name('event');
Route::put('/event/{id}', 'App\Http\Controllers\EventController@update')->name('events.update');
Route::delete('/event/{id}', [EventController::class, 'destroy'])->name('events.destroy');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/calendrier', 'EventController@calendrier')->name('calendrier');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::get('/events/{id}', [EventController::class, 'show'])->name('events.show');

Route::get('/select-personnel', [EventController::class, 'selectPersonnel'])->name('select.personnel');
Route::get('/select-materiel', [EventController::class, 'selectMateriel'])->name('select.materiel');
Route::get('/select-salle', [EventController::class, 'selectSalle'])->name('select.salle');

Route::get('/vehicules', [VehiculeController::class, 'index'])->name('vehicules.index'); // Utilisez le bon contrôleur ici
Route::post('/vehicules', [MaterielController::class, 'storeVehicule'])->name('vehicules.store');

Route::get('/materiel', [MaterielController::class, 'index'])->name('materiel');
Route::get('/materiels', [MaterielController::class, 'index'])->name('materiels.index');
Route::post('/materiel', 'App\Http\Controllers\MaterielController@store')->name('materiels.store');

Route::get('/salles', [SalleController::class, 'index'])->name('salles.index');
Route::post('/salles', [MaterielController::class, 'storeSalle'])->name('salles.store');


Route::get('/maraude', [MaraudeController::class, 'index'])->name('maraude');
Route::get('/maraudes', [MaraudeController::class, 'index'])->name('maraudes.index');
Route::get('/maraudes/create', [MaraudeController::class, 'create'])->name('maraudes.create');
Route::post('maraude', 'App\Http\Controllers\MaraudeController@store')->name('maraudes.store');


Route::get('/chargement', [MaraudeController::class, 'index'])->name('chargement');
Route::get('/chargements', [MaraudeController::class, 'index'])->name('chargements.index');
Route::post('chargement', 'App\Http\Controllers\ChargementController@store')->name('chargements.store');


Route::get('/produit', [ProduitController::class, 'index'])->name('produit');
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');


// Route pour afficher la liste des cours et pour créer un nouveau cours
Route::get('/cours', [CoursController::class, 'index'])->name('cours.index');
Route::get('/cours/create', [CoursController::class, 'create'])->name('cours.create');
Route::post('/cours', [CoursController::class, 'store'])->name('cours.store');
Route::delete('/cours/{id}', [CoursController::class, 'destroy'])->name('cours.destroy');
Route::get('/cours/{id}', [CoursController::class, 'show'])->name('cours.show');
Route::put('/cours/{id}', [CoursController::class, 'update'])->name('cours.update');
Route::get('/cours/{id}/animateur', [CoursController::class, 'animateur'])->name('cours.animateur');
//----------------------

//retiré pour dockerfile
//Route::get('/cours/{id}/inscription', [CoursController::class, 'showInscriptionForm'])->name('cours.inscription');
Route::post('/cours/{id}/inscription', [CoursController::class, 'inscription'])->name('cours.inscription');
Route::delete('/cours/{coursId}/retirer/{userId}', [CoursController::class, 'retirerUtilisateur'])->name('cours.retirer');

//Route::post('/inscription', [InscriptionController::class, 'store'])->name('inscription.store');
//----------------------

Route::get('/personnel', [PersonnelController::class, 'index'])->name('personnel.index');
Route::get('/personnel/{user}/edit', [PersonnelController::class, 'edit'])->name('personnel.edit');
Route::put('/personnel/{user}', [PersonnelController::class, 'update'])->name('personnel.update');
Route::get('/personnel/{user}', [PersonnelController::class, 'show'])->name('personnel.show');
Route::get('/personnel/{id}/events', [PersonnelController::class, 'events'])->name('personnel.events');
Route::put('/personnel/{user}', [PersonnelController::class, 'update'])->name('personnel.update');
Route::get('/personnel/{user}/certifications', [PersonnelController::class, 'showCertificationsForm'])->name('personnel.certifications');
Route::put('/personnel/{user}/certifications', [PersonnelController::class, 'updateCertifications'])->name('user.certifications.update');

Route::get('/certifications', [CertificationController::class, 'index'])->name('certifications.index');
Route::get('/certifications/create', [CertificationController::class, 'create'])->name('certifications.create');
Route::post('/certifications', [CertificationController::class, 'store'])->name('certifications.store');




//Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
//Route::get('/dashboard/inscription', [DashboardController::class, 'showInscriptionForm'])->name('dashboard.inscription');
// Route avec le paramètre {id} pour l'ID du cours
Route::get('/dashboard/{id}/inscription', [DashboardController::class, 'showInscriptionForm'])->name('dashboard.inscription');




Route::get('/dons', [FaireUnDonController::class, 'index'])->name('dons');

Route::post('/alertes', [AlerteController::class, 'store'])->name('alertes');

Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');

Route::get('/inscription', [InscriptionController::class, 'index']);
//

Route::get('service', [ServiceController::class, 'index'])->name('service.index');
Route::get('/service/{type}', [ServiceController::class, 'showByType'])
     ->name('service.showByType')
     ->where('type', '[A-Za-z_]+'); // Limite le type à des caractères alphabétiques et underscores
Route::get('/service/create', [ServiceController::class, 'create'])->name('service.create');
Route::post('/service', [ServiceController::class, 'store'])->name('service.store');
Route::get('/service/{type}/{id}/edit', [ServiceController::class, 'edit'])
    ->name('service.edit');
Route::put('/service/{type}/{id}', [ServiceController::class, 'update'])->name('service.update');
Route::delete('/service/{type}/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');

//Route::post('/service_mission/store', [ServiceController::class, 'storeMission'])->name('service_mission.store');

//

Route::get('/entrepot', [EntrepotController::class, 'index'])->name('entrepot');
Route::get('/entrepot/{id}/downloadMap', 'EntrepotController@downloadMap')->name('downloadMap');


Route::get('/nourriture', [NourritureController::class, 'index'])->name('nourriture');
Route::post('/nourriture', [NourritureController::class, 'store']);
