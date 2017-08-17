<?php
/**
 * @author         Pierre-Henry Soria <hi@ph7.me>
 * @copyright      (c) 2017, Pierre-Henry Soria. All Rights Reserved.
 * @license        GNU General Public License; <https://www.gnu.org/licenses/gpl-3.0.en.html>
 */

use Core\Route;

Route::get('/', 'LifeGenerator@residence');
Route::post('/my-nationality', 'LifeGenerator@nationality');
Route::post('/my-destination', 'LifeGenerator@destination');
Route::post('/my-gender', 'LifeGenerator@gender');
Route::post('/my-age', 'LifeGenerator@age');
Route::post('/my-lifestyle', 'LifeGenerator@lifestyle');
Route::post('/my-background', 'LifeGenerator@background');
Route::post('/job-type', 'LifeGenerator@job');
Route::post('/my-saving', 'LifeGenerator@saving');
Route::post('/availability', 'LifeGenerator@availability');
Route::post('/get-results', 'LifeGenerator@results');
Route::post('/confirmation', 'LifeGenerator@confirmation');