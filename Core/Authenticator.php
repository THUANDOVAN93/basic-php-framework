<?php

namespace Core;

class Authenticator
{
    public function attempt($email, $password): bool
    {
        $db = App::resolve(Database::class);
        $user = $db->query('SELECT * FROM `users` WHERE `email` = :email', [
            'email' => $email
        ])->find();

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $this->login($user);

                return true;
            }
        }

        return false;
    }

    function login($user): void
    {
        $_SESSION['user'] = [
            'email' => $user['email'],
        ];

        session_regenerate_id(true);
    }

    function logout(): void
    {
        Session::destroy();
    }
}