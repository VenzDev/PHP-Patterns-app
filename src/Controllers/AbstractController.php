<?php

namespace App\Controllers;

use App\Request;

abstract class AbstractController
{
    protected Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function run(): bool
    {
        $isActionExecuted = false;

        $action = $this->action().'Action';
        if (method_exists($this, $action)) {
            $this->$action();
            $isActionExecuted = true;
        }

        return $isActionExecuted;
    }

    private function action(): string
    {
        return $this->request->getParam('action');
    }
}