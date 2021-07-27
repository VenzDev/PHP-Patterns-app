<?php

namespace App\Repository;

use App\Models\Person;
use App\Services\PasswordService;
use Exception;

class UserRepository
{
    public function tryLogin($email, $password): array|bool
    {
        try {
            $password = PasswordService::encrypt($password);
            $result   = Person::query()
                    ->select('Persons')
                    ->where('email', $email)
                    ->where('password', $password)
                    ->first();

            if ($result) {
                return $result;
            }
            return false;
        } catch (Exception $e) {
            return false;
        }
    }

    public function register($data)
    {
        $data['password'] = PasswordService::encrypt($data['password']);
        return Person::query()->insert('Persons', $data);
    }
}