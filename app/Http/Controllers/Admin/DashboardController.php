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
        //$totalUsers = User::/* where('tenant_id', $tenant->id)-> */count();

        $totalUsers = User::where('role_id', '<>', '2')->count();

        $totalGuests = Guest::where('status', 'Pendente')->count();

        $totalEmployees = User::where('role_id', '2')->count();

        // $totalVehicles = Vehicle::count();

        return view('admin.pages.home.index', compact(
            'totalUsers',
            'totalGuests',
            'totalEmployees',/* ,
            'totalVehicles' */
        ));
    }
}
