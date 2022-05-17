<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;

class DashboardHomeController extends Controller
{
    public function index()
    {
        return view('dashboard.home');
    }
}
