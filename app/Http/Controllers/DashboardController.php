<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $permissions = $request->user()->getAllPermissions();
        if (!$request->user()->can('view payments')) {
            abort(403, 'Unauthorized');
        }
        return view('dashboard');
    }
}
