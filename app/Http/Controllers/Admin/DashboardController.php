<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{
    Guest,
    User,
    Vehicle
};
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::/* where('tenant_id', $tenant->id)-> */count();

        $totalGuests = Guest::count();
        $totalVehicles = Vehicle::count();

        return view('admin.pages.home.index', compact(
            'totalUsers',
            'totalGuests',
            'totalVehicles'
        ));
    }
}
