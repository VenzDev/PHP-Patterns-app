<?php

namespace App\Repository;

use App\Models\Person;
use App\Services\PasswordService;

class UserRepository
{
    public function tryLogin($email, $password): bool
    {
        $password = PasswordService::encrypt($password);

        $result = Person::query()->select('Persons')
                ->where('email', $email)
                ->where('password', $password)
                ->first();

        if ($result) {
            return true;
        }
        return false;
    }

    public function register($data)
    {
        $data['password'] = PasswordService::encrypt($data['password']);
        return Person::query()->insert('Persons', $data);
    }
}