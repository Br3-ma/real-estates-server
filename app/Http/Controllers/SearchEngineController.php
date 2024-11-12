<?php

namespace App\Http\Controllers;

use App\Models\PropertyPost;
use Illuminate\Http\Request;

class SearchEngineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Extract filters from the request
        $location = $request->input('location');
        $minPrice = $request->input('minPrice');
        $maxPrice = $request->input('maxPrice');
        $propertyType = $request->input('propertyType');
        $category = $request->input('category');
        $numBeds = $request->input('numBeds');
        $numBaths = $request->input('numBaths');

        // Build the query with applied filters
        $query = PropertyPost::inRandomOrder();

        // Apply filters if they are present in the request
        if (!is_null($location)) {
            $query->where('location_id', ((int)$location));
        }

        if (!is_null($minPrice)) {
            $query->where('price', '>=', $minPrice);
        }

        if (!is_null($maxPrice)) {
            $query->where('price', '<=', $maxPrice);
        }

        if (!is_null($propertyType)) {
            $query->where('property_type_id', $propertyType);
        }

        if (!is_null($category)) {
            $query->where('category_id', $category);
        }

        if (!is_null($numBeds)) {
            $query->where('bedrooms', $numBeds);
        }

        if (!is_null($numBaths)) {
            $query->where('bathrooms', $numBaths);
        }

        // Execute the query and get the results
        $results = $query->get();
        return response()->json($results);
    }

    public function index2(){
        $results = PropertyPost::inRandomOrder()->get();
        return response()->json($results);
    }
}
