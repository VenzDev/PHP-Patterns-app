<?php

namespace App\Controllers;


use App\Response;

class Controller extends AbstractController
{
    public function helloAction()
    {
        Response::json('success', '', 'success', 201);
    }

}