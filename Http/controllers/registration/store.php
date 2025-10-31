<?php

use Core\App;
use Core\Authenticator;
use Core\Database;
use Http\Forms\LoginForm;

$email = $_POST["email"];
$password = $_POST["password"];

// validate form inputs

$form = new LoginForm();
if (! $form->validate($email, $password)) {
        return view('registration/create.view.php', [
        'errors' => $form->errors()
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

    $auth = new Authenticator();
    $auth->attempt($email, $password);

    header('Location: /');
    exit();
}
