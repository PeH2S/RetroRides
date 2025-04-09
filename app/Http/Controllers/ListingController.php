<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Listing;
use App\Models\CarModel;
use App\Models\ModelYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ListingController extends Controller
{
    public function index()
    {
        $listings = \App\Models\Listing::latest()->paginate(10);
        return view('listings.index', compact('listings'));
    }



    public function create()
    {
        $brands = Brand::with(['carModels.modelYears'])->orderBy('name')->get();
        return view('listings.create', compact('brands'));
    }


    public function store(Request $request)
    {
        $data = $request->all();

        $data['user_id'] = 1;

        $listing = Listing::create($data);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $key => $image) {
                $path = $image->store('listings', 'public');
                $isMain = $key === 0;

                $listing->photos()->create([
                    'path' => $path,
                    'is_main' => $isMain
                ]);
            }
        }

        return redirect()->route('listings.index')->with('success', 'Anúncio criado com sucesso!');
    }



    public function edit(Listing $listing)
    {
        $brands = Brand::with('carModels.modelYears')->orderBy('name')->get();

        return view('listings.edit', compact('listing', 'brands'));
    }


    public function update(Request $request, Listing $listing)
    {


        $validated = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'model_id' => 'required|exists:car_models,id',
            'model_year_id' => 'required|exists:model_years,id',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string|min:10',
            'location' => 'required|string',
            'mileage' => 'required|numeric|min:0',
            'color' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $listing->update($validated);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('listings', 'public');

                $listing->photos()->create([
                    'path' => $path,
                    'is_main' => false
                ]);
            }
        }

        return redirect()->route('listings.index')->with('success', 'Anúncio atualizado com sucesso!');
    }

    public function destroy(Listing $listing)
    {


        // Remove as imagens do storage
        foreach ($listing->photos as $photo) {
            Storage::disk('public')->delete($photo->path);
        }

        $listing->delete();

        return redirect()->route('listings.index')->with('success', 'Anúncio removido com sucesso!');
    }

    public function getModels($brandId)
    {
        $models = CarModel::where('brand_id', $brandId)->orderBy('name')->get();
        return response()->json($models);
    }

    public function getYears($modelId)
    {
        $years = ModelYear::where('car_model_id', $modelId)->orderBy('year')->get();
        return response()->json($years);
    }
}
