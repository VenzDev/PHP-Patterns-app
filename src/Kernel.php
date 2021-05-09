<?php

namespace App;

class Kernel
{
    public static function runControllers($controllers)
    {
        $request = new Request($_GET, $_POST, $_SERVER);

        $isAction = false;

        foreach ($controllers as $controller) {
            if ((new $controller($request))->run()) {
                $isAction = true;
            }
        }

        if (!$isAction) {
            Response::MethodNotFound();
        }
    }
}