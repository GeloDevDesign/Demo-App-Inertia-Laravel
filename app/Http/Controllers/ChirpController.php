<?php

namespace App\Http\Controllers;

use App\Models\Chirp;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Gate;


class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return Inertia::render('Views/Chirper/index', [
            'chirps' => Chirp::with('user:id,name')
                ->where('user_id', auth()->id()) // Filter chirps by the current user's ID
                ->latest()
                ->get()
                ->map(function ($chirp) {
                    $chirp->canEdit = auth()->user()->can(['update', $chirp, 'view', $chirp]); // Check policy
                    return $chirp;
                }),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Views/Chirper/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $request->user()->chirps()->create($validated);
        return redirect(route('chirps.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Chirp $chirp)
    {
        //


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp)
    {
        // Authorize the action
        Gate::authorize('update', $chirp);

        // Render the edit page and pass the chirp data 
        return Inertia::render('Views/Chirper/edit', [
            'chirp' => [
                'id' => $chirp->id,
                'message' => $chirp->message,
            ],
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Chirp $chirp)
    {
        Gate::authorize('update', $chirp);

        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ]);

        $chirp->update($validated);

        return redirect(route('chirps.index'))->with('success', 'Chirp updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp)
    {
        //
    }
}
