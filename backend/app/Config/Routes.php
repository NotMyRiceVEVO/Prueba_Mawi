<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->resource('proyectos', ['controller' => 'Proyectos']);
$routes->resource('empleados', ['controller' => 'Empleados']);
$routes->resource('registros-tiempo', ['controller' => 'RegistrosTiempo']);
