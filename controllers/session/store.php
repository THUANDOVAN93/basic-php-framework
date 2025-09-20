<?php

use Core\Database;
use Core\Validator;
use Core\App;

$email = $_POST["email"];
$password = $_POST["password"];

$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please enter a valid email address';
}

if (!Validator::string($password)) {
    $errors['password'] = 'Please provide a valid password';
}

if (! empty($errors)) {
    return view('session/create.view.php', [
        'errors' => $errors
    ]);
}

// check if account already exists
$db = App::resolve(Database::class);
$user = $db->query('SELECT * FROM `users` WHERE `email` = :email', [
    'email' => $email
])->find();

if ($user) {
    if (password_verify($password, $user['password'])) {
        login($user);

        header('location: /');
        exit();
    }
}

return view('session/create.view.php', [
    'errors' => [
        'password' => 'No matching account found for that email address add password'
    ]
]);