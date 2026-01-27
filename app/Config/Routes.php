<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/index', 'frontend\IndexController::index');
$routes->get('/contact', 'frontend\IndexController::contact');
$routes->get('/about', 'frontend\IndexController::about');
$routes->get('/rooms', 'frontend\IndexController::rooms');
$routes->get('/room-details', 'frontend\IndexController::roomDetails');
$routes->get('/blog', 'frontend\IndexController::blog');
$routes->get('/blog-details', 'frontend\IndexController::blogDetails');


$routes->get('/index', 'frontend\BookingController::booking');
$routes->post('booking/save','frontend\BookingController::saveBooking');
$routes->post('contact/save', 'frontend\ContactController::saveContact');
