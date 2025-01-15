<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');
        $filter = $request->get('filter'); // Capture filter from the request

        return Inertia::render('Views/Home', [
            'users' => User::query()
                ->when($search, function ($query, $search) {
                    $query->where('name', 'like', '%' . $search . '%');
                })
                ->when($filter, function ($query, $filter) {
                    $query->where('role', $filter); // Adjust this based on your filter logic
                })
                ->paginate(8)
                ->withQueryString(),

            'searchTerm' => $search,
            'filterTerm' => $filter,
        ]);
    }
}
