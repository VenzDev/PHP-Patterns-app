<?php

namespace App\Controllers;

use App\Repository\UserRepository;
use App\Request;
use App\Response;
use JetBrains\PhpStorm\Pure;

class UserController extends AbstractController
{
    private UserRepository $userRepository;

    #[Pure] public function __construct(Request $request)
    {
        $this->userRepository = new UserRepository();
        parent::__construct($request);
    }

    public function loginAction()
    {
        $data     = $this->request->json();
        $email    = $data['email'];
        $password = $data['password'];

        $status = $this->userRepository->tryLogin($email, $password);
        if($status) {
            Response::json('success', 'success', 'Login success');
        }
        Response::json('error', null, 'Invalid Credentials', 400);
    }

    public function registerAction()
    {
        $data = $this->request->json();

        $status = $this->userRepository->register($data);
        if($status) {
            Response::json('success', 'success', 'Register success');
        }
        Response::json('error', null, 'Invalid Credentials', 400);
    }
}