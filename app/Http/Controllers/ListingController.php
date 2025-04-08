<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::with('carModels')->get();
        return view('listings.create', compact('brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'model_year_id' => 'required|exists:model_years,id',
            'price' => 'required|numeric|min:1000',
            'description' => 'required|string|min:20|max:2000',
            'location' => 'required|string|max:255',
            'mileage' => 'nullable|integer|min:0',
            'color' => 'nullable|string|max:50',
            'photos' => 'required|array|min:1|max:10',
            'photos.*' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            $listing = Listing::create([
                'user_id' => Auth::id(),
                'model_year_id' => $validated['model_year_id'],
                'price' => $validated['price'],
                'description' => $validated['description'],
                'location' => $validated['location'],
                'mileage' => $validated['mileage'],
                'color' => $validated['color']
            ]);

            foreach ($request->file('photos') as $key => $photo) {
                $path = $photo->store('listings/' . $listing->id, 'public');

                ListingPhoto::create([
                    'listing_id' => $listing->id,
                    'path' => $path,
                    'is_main' => $key === 0
                ]);
            }

            return redirect()->route('listings.show', $listing)
                ->with('success', 'Anúncio publicado com sucesso!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Erro ao publicar anúncio: ' . $e->getMessage());
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
