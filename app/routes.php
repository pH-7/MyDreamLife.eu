<?php

Route::get('/', 'LifeGenerator@residence');
Route::post('/my-nationality', 'LifeGenerator@nationality');
Route::post('/my-destination', 'LifeGenerator@destination');
Route::post('/my-gender', 'LifeGenerator@gender');
Route::post('/my-age', 'LifeGenerator@age');
Route::post('/my-lifestyle', 'LifeGenerator@lifestyle');
Route::post('/my-background', 'LifeGenerator@background');
Route::post('/my-lifestyle', 'LifeGenerator@lifestyle');
Route::post('/my-saving', 'LifeGenerator@saving');
Route::post('/get-results', 'LifeGenerator@results');
Route::post('/confirmation', 'LifeGenerator@confirmation');