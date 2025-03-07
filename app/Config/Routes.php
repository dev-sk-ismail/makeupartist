<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/about', 'Home::about');
$routes->get('/team', 'Home::team');
$routes->get('/gallery', 'Home::gallery');
$routes->get('/faq', 'Home::faq');
$routes->get('/course', 'Home::course');
$routes->get('/404', 'Home::notFound');
$routes->get('/contact', 'Home::contact');


// service.php controller

$routes->get('/services', 'SdpController::services');
$routes->get('/services/(:any)', 'SdpController::sdp/$1');
$routes->get('/services-single', 'SdpController::servicesSingle');
//booking
$routes->post('/services/apiBooking', 'SdpController::apiBooking');

//Blogs
$routes->get('/blogs', 'Home::blogs');
$routes->get('/blog/(:any)', 'Home::blogPost/$1');








// admin panel routing
// Public routes (no auth required)
$routes->get('admin/login', 'Admin\Auth::login');
$routes->post('admin/authenticate', 'Admin\Auth::authenticate');
$routes->get('admin/logout', 'Admin\Auth::logout');





// Password reset routes
$routes->get('admin/forgot-password', 'Admin\Auth::forgotPassword');
$routes->post('admin/forgot-password-submit', 'Admin\Auth::forgotPasswordSubmit');
$routes->get('admin/reset-password/(:any)', 'Admin\Auth::resetPassword/$1');
$routes->post('admin/reset-password-submit', 'Admin\Auth::resetPasswordSubmit');

// Protected admin routes
$routes->group('admin', ['filter' => 'adminAuth', 'namespace' => 'App\Controllers\Admin'], function ($routes) {
  // Dashboard
  $routes->get('dashboard', 'DashboardController::index');

  // Settings
  $routes->get('settings', 'SettingsController::index');
  $routes->get('settings/create', 'SettingsController::create');
  $routes->post('settings/store', 'SettingsController::store');
  $routes->get('settings/edit/(:num)', 'SettingsController::edit/$1');
  $routes->post('settings/update/(:num)', 'SettingsController::update/$1');

  // Gallery
  $routes->get('gallery', 'GalleryController::index');
  $routes->get('gallery/create', 'GalleryController::create');
  $routes->post('gallery/store', 'GalleryController::store');
  $routes->get('gallery/edit/(:num)', 'GalleryController::edit/$1');
  $routes->post('gallery/update/(:num)', 'GalleryController::update/$1');
  $routes->get('gallery/delete/(:num)', 'GalleryController::delete/$1');

  // Services
  $routes->get('services', 'ServicesController::index');
  $routes->get('services/create', 'ServicesController::create');
  $routes->post('services/store', 'ServicesController::store');
  $routes->get('services/edit/(:num)', 'ServicesController::edit/$1');
  $routes->post('services/update/(:num)', 'ServicesController::update/$1');
  $routes->get('services/delete/(:num)', 'ServicesController::delete/$1');

  // Variants
  $routes->get('variants', 'VariantsController::index');
  $routes->get('variants/create', 'VariantsController::create');
  $routes->post('variants/store', 'VariantsController::store');
  $routes->get('variants/edit/(:num)', 'VariantsController::edit/$1');
  $routes->post('variants/update/(:num)', 'VariantsController::update/$1');
  $routes->get('variants/delete/(:num)', 'VariantsController::delete/$1');





  // Bookings
  $routes->get('bookings', 'BookingsController::index');
  $routes->get('bookings/create', 'BookingsController::create');
  $routes->post('bookings/store', 'BookingsController::store');
  $routes->get('bookings/edit/(:num)', 'BookingsController::edit/$1');
  $routes->post('bookings/update/(:num)', 'BookingsController::update/$1');
  $routes->get('bookings/delete/(:num)', 'BookingsController::delete/$1');
  $routes->get('bookings/getVariants', 'BookingsController::getVariants');

  // Blogs
  $routes->get('blogs', 'BlogController::index');
  $routes->get('blogs/create', 'BlogController::create');
  $routes->post('blogs/store', 'BlogController::store');
  $routes->get('blogs/edit/(:num)', 'BlogController::edit/$1');
  $routes->post('blogs/update/(:num)', 'BlogController::update/$1');
  $routes->get('blogs/delete/(:num)', 'BlogController::delete/$1');

  //BlogGallery
  $routes->get('blog_gallery', 'BlogGalleryController::index');
  $routes->get('blog_gallery/create', 'BlogGalleryController::create');
  $routes->post('blog_gallery/store', 'BlogGalleryController::store');
  $routes->get('blog_gallery/edit/(:num)', 'BlogGalleryController::edit/$1');
  $routes->post('blog_gallery/update/(:num)', 'BlogGalleryController::update/$1');
  $routes->get('blog_gallery/delete/(:num)', 'BlogGalleryController::delete/$1');


    // Courses
    $routes->get('courses', 'CourseController::index');
    $routes->get('courses/create', 'CourseController::create');
    $routes->post('courses/store', 'CourseController::store');
    $routes->get('courses/edit/(:num)', 'CourseController::edit/$1');
    $routes->post('courses/update/(:num)', 'CourseController::update/$1');
    $routes->get('courses/delete/(:num)', 'CourseController::delete/$1');

  // Courses/Syllabus
  $routes->get('courses/syllabus/(:num)', 'CourseSyllabusController::index/$1');
  $routes->get('courses/syllabus/create/(:num)', 'CourseSyllabusController::create/$1');
    $routes->post('courses/syllabus/store', 'CourseSyllabusController::store');
    $routes->get('courses/syllabus/edit/(:num)', 'CourseSyllabusController::edit/$1');
    $routes->post('courses/syllabus/update/(:num)', 'CourseSyllabusController::update/$1');
    $routes->get('courses/syllabus/delete/(:num)', 'CourseSyllabusController::delete/$1');

    // Courses/Batches
    $routes->get('courses/batches', 'CourseBatchController::index');
    $routes->get('courses/batches/create', 'CourseBatchController::create');
    $routes->post('courses/batches/store', 'CourseBatchController::store');
    $routes->get('courses/batches/edit/(:num)', 'CourseBatchController::edit/$1');
    $routes->post('courses/batches/update/(:num)', 'CourseBatchController::update/$1');
    $routes->get('courses/batches/delete/(:num)', 'CourseBatchController::delete/$1');

  


});
