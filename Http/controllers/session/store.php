<?php

use Core\Authenticator;
use Http\Forms\LoginForm;

$form = LoginForm::validate($attributes = [
    'email' =>  $_POST["email"],
    'password' => $_POST["password"]
]);

$signedIn = (new Authenticator)->attempt(
    $attributes["email"], $_POST["password"]
);

if (! $signedIn) {
    $form->error(
        'email', 'No matching account found for that email address and password.'
    )->throw();
}
redirect('/');

