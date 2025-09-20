<?php

use Core\Database;
use Core\Validator;
use Core\App;

$email = $_POST["email"];
$password = $_POST["password"];

// validate form inputs

$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please enter a valid email address';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password at least 7 characters long';
}

if (! empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

// check if account already exists
$db = App::resolve(Database::class);
$user = $db->query('SELECT * FROM `users` WHERE `email` = :email', [
    'email' => $email
])->find();
if ($user) {
    // If yes, redirect to login page
    header('Location: /');
    exit();
} else {
    //  If no, store user to database, log user in, redirect
    $db->query('INSERT INTO `users` (`email`, `password`) VALUES (:email, :password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    login($user);

    header('Location: /');
    exit();
}
