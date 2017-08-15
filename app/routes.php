<?php

$route->get('/', 'LifeGenerator@residence');
$route->post('/my-nationality', 'LifeGenerator@nationality');
$route->post('/my-destination', 'LifeGenerator@destination');
$route->post('/my-gender', 'LifeGenerator@gender');
$route->post('/my-age', 'LifeGenerator@age');
$route->post('/my-lifestyle', 'LifeGenerator@lifestyle');
$route->post('/my-background', 'LifeGenerator@background');
$route->post('/my-lifestyle', 'LifeGenerator@lifestyle');
$route->post('/my-saving', 'LifeGenerator@saving');
$route->post('/get-results', 'LifeGenerator@results');