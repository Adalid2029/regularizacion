<?php

namespace App\Controllers;

class Home extends BaseController
{

    public function index()
    {
        $this->response->setContentType('application/pdf');
        $reporte = new Reporte();
        $reporte->reporte2();
        // return view('welcome_message');
    }
}
