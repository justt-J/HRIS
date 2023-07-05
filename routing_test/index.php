<?php 

// require 'functions.php';
$uri = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes = [
    '/' => 'homepage.php',
    '/login' => 'login.php',

    //users
    '/user_profile' => 'user_pages/user_profile.php',
    '/attendance' => 'user_pages/attendance_page.php',


    //admin
    '/add_user' => 'admin_pages/addUser.php',
    '/admin_profile' => 'admin_pages/admin_profile.php',
    '/attendance_list_IN' => 'admin_pages/attendance_list_in.php',
    '/attendance_list_OUT' => 'admin_pages/attendance_list_out.php',
    '/attendance_list' => 'admin_pages/attendance_list.php',
    '/add_job_order' => 'admin_pages/jobOrder.php',
    '/add_memo' => 'admin_pages/memo.php',
    '/edit_payroll' => 'actions/edit_payroll.php',
    '/payroll_list' => 'admin_pages/payroll_list.php',
    
];

if(array_key_exists($uri, $routes)){
    require $routes[$uri];
}