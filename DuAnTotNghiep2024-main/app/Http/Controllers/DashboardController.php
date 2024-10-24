<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    const VIEW_PATH = "admin.";
    public function index() {
        return view(self::VIEW_PATH . __FUNCTION__);
    }
}
