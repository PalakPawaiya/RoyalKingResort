<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
// Frontend
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



/// Backend
$routes->get('/room', 'backend\RoomController::room');
$routes->get('/get-room', 'backend\RoomController::getRoom');
$routes->post('/add-room', 'backend\RoomController::addRoom');
$routes->get('/edit-room/(:num)', 'backend\RoomController::editRoom/$1');
$routes->post('/update-room/(:num)', 'backend\RoomController::updateRoom/$1');
$routes->get('delete-room/(:num)', 'backend\RoomController::deleteRoom/$1');


$routes->get('/facility', 'backend\FacilityController::facility');
$routes->get('/get-facility', 'backend\FacilityController::getFacility');
$routes->post('/add-facility', 'backend\FacilityController::addFacility');
$routes->get('/edit-facility/(:num)', 'backend\FacilityController::editFacility/$1');
$routes->post('/update-facility/(:num)', 'backend\FacilityController::updateFacility/$1');
$routes->get('delete-facility/(:num)', 'backend\FacilityController::deleteFacility/$1');



$routes->get('/booking', 'backend\BookingController::booking');
$routes->get('/get-booking', 'backend\BookingController::getBooking');
$routes->post('/add-booking', 'backend\BookingController::addBooking');
$routes->get('/edit-booking/(:num)', 'backend\BookingController::editBooking/$1');
$routes->post('/update-booking/(:num)', 'backend\BookingController::updateBooking/$1');
$routes->get('delete-booking/(:num)', 'backend\BookingController::deleteBooking/$1');

$routes->get('/facilityfeature', 'backend\FacilityFeatureController::facilityFeature');
$routes->get('/get-facilityFeature', 'backend\FacilityFeatureController::getfacilityFeature');
$routes->post('/add-facilityFeature', 'backend\FacilityFeatureController::addfacilityFeature');
$routes->get('/edit-facilityFeature/(:num)', 'backend\FacilityFeatureController::editfacilityFeature/$1');
$routes->post('/update-facilityFeature/(:num)', 'backend\FacilityFeatureController::updatefacilityFeature/$1');
$routes->get('delete-facilityFeature/(:num)', 'backend\FacilityFeatureController::deletefacilityFeature/$1');