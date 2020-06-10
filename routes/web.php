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


Route::get('/index', function () {
    return view('index');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('inicio');

Route::get('/miperfil', 'usersController@miperfil')->name('miperfil');
Route::get('/miperfil/cambiarPass', 'usersController@cambiarPass')->name('cambiarPass');
Route::post('/miperfil/cambiarPass/actualizar', 'usersController@actualizarPass')->name('actualizarPass');
Route::post('/miperfil/actualizar', 'usersController@actualizarAvatar')->name('actualizarAvatar');
Route::get('/miperfil/avatar/{filename}', 'usersController@getImagen')->name('user.avatar');


//experiencias
Route::get('/crearexperiencia', 'experienciaeducativaController@crearexperiencia')->name('crearexperiencia');
Route::post('/crearexperiencia/registro', 'experienciaeducativaController@registrarexperiencia')->name('registrarexperiencia');
Route::get('/ExperienciaEducativa/{experiencia}', 'experienciaeducativaController@verExperiencia')->name('verExperiencia');
//estudiantes
Route::get('/ExperienciaEducativa/estudiantes/{experiencia}', 'experienciaeducativaController@misEstudiantes')->name('misEstudiantes');
Route::get('/ExperienciaEducativa/estudiantes/agregar/{experiencia}', 'experienciaestudianteController@agregarEstudiante')->name('agregarEstudiante');
Route::post('/ExperienciaEducativa/estudiantes/agrega/crear', 'experienciaestudianteController@crearEstudiante')->name('crearEstudiante');

Route::get('/ExperienciaEducativa/estudiantes/importar/{experiencia}', 'excelController@importarExcelEstudiantes')->name('importarExcelEstudiantes');
Route::post('ExperienciaEducativa/importar/excel/Estudiantes', 'excelController@importExcel')->name('importExcel');

Route::get('/ExperienciaEducativa/estudiantes/experiencia/{experiencia}', 'experienciaestudianteController@experienciasDocente')->name('experienciasDocente');
Route::post('ExperienciaEducativa/estudiantes/tomar/experiencia', 'experienciaestudianteController@tomarEstudiantes')->name('tomarEstudiantes');

//Temas
Route::get('/ExperienciaEducativa/temas/{experiencia}', 'temaController@misTemas')->name('misTemas');
Route::get('/ExperienciaEducativa/temas/nuevo/{experiencia}', 'temaController@nuevoTema')->name('nuevoTema');
Route::post('/ExperienciaEducativa/temas/registro/nuevo', 'temaController@registrartema')->name('registrartema');
Route::get('/ExperienciaEducativa/temas/editar/{tema}', 'temaController@editarTema')->name('editarTema');
Route::post('/ExperienciaEducativa/temas/editar', 'temaController@guardartema')->name('guardartema');
//ListaPase
Route::get('/ExperienciaEducativa/Lista/{experiencia}', 'listaasistenciaController@misPaseLista')->name('misPaseLista');
Route::get('/ExperienciaEducativa/Lista/nuevo/{experiencia}', 'listaasistenciaController@nuevoLista')->name('nuevoLista');
Route::post('/ExperienciaEducativa/Lista/registro/nuevo', 'listaasistenciaController@registrarPaseLista')->name('registrarPaseLista');
Route::get('/ExperienciaEducativa/Lista/editar/{pase}', 'listaasistenciaController@editarPaseLista')->name('editarPaseLista');
Route::post('/ExperienciaEducativa/Lista/editar', 'listaasistenciaController@guardarPaseLista')->name('guardarPaseLista');
//ListaPaseDetaa
Route::get('/ExperienciaEducativa/Lista/ver/{pase}', 'listaasistenciaestudianteController@verPaseLista')->name('verPaseLista');
Route::get('/ExperienciaEducativa/Lista/ver/editar/{detallePase}', 'listaasistenciaestudianteController@editarDetallePaseLista')->name('editarDetallePaseLista');
Route::post('/ExperienciaEducativa/Lista/ver/editar/detalle/guardar', 'listaasistenciaestudianteController@guardarDetallePaseLista')->name('guardarDetallePaseLista');
Route::get('/ExperienciaEducativa/Lista/activar/{pase}', 'listaasistenciaestudianteController@ActivarPaseLista')->name('ActivarPaseLista');
//Participaciones
Route::get('/ExperienciaEducativa/participaciones/{experiencia}', 'participacionController@verParticipaciones')->name('verParticipaciones');
Route::get('/ExperienciaEducativa/participaciones/asignar/{experiencia}', 'participacionController@darParticipaciones')->name('darParticipaciones');
Route::post('/ExperienciaEducativa/participaciones/nuevo/asignar', 'participacionController@asignarParticipacion')->name('asignarParticipacion');
Route::get('/ExperienciaEducativa/participaciones/detalle/{estudianteExp}', 'participacionController@detalleParticipacion')->name('detalleParticipacion');
Route::post('/ExperienciaEducativa/participaciones/estudiante/detalle', 'participacionController@detalleParticipaciones')->name('detalleParticipaciones');
Route::get('/ExperienciaEducativa/participaciones/estudiante/editar/{participacion}', 'participacionController@editarParticipacion')->name('editarParticipacion');
Route::post('/ExperienciaEducativa/participaciones/estudiante/editar/guardar/detalle', 'participacionController@guardarParticipacionCambio')->name('guardarParticipacionCambio');

//Notificaciones
Route::get('/notificaciones/{notificacion}', 'notificacionController@notificaciones')->name('notificaciones');

//Mensajes
Route::get('/mensajes/{mensaje}', 'mensajeController@mensajes')->name('mensajes');
Route::get('/mensajes/ver/{mensaje}', 'mensajeController@verMensaje')->name('verMensaje');
Route::get('/mensaje/nuevo', 'mensajeController@nuevoMensaje')->name('nuevoMensaje');
Route::post('/mensajes/enviar/nuevo', 'mensajeController@enviarMensaje')->name('enviarMensaje');
Route::post('/mensaje/enviar/nuevo', 'mensajeController@enviarNuevoMensaje')->name('enviarNuevoMensaje');

//ESTUDIANTE
Route::get('/ExperienciaEducativa/Est/{experiencia}', 'experienciaeducativaController@verExperienciaEst')->name('verExperienciaEst');
Route::get('/ExperienciaEducativa/Est/salon/{experiencia}', 'experienciaeducativaController@salonEst')->name('salonEst');
Route::get('/ExperienciaEducativa/Est/paseLista/{experiencia}', 'listaasistenciaestudianteController@paseListaEst')->name('paseListaEst');
Route::get('/ExperienciaEducativa/Est/paseLista/check/{pase}', 'listaasistenciaestudianteController@checkEst')->name('checkEst');
Route::get('/ExperienciaEducativa/Est/participacion/{experiencia}', 'participacionController@verParticipacionesEst')->name('verParticipacionesEst');




