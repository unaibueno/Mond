<?php

namespace App\Controllers;

class LandingController extends BaseController
{
    public function index(): string
    {
        return view('landing-page');
    }
}
