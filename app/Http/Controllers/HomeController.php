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
                ->when(!empty($filter), function ($query) use ($filter) {
                    $query->where('role', $filter);
                })
                ->paginate(8)
                ->withQueryString(), // Preserve query string for pagination

            'searchTerm' => $search,
            'filterTerm' => $filter,
        ]);
    }
}
