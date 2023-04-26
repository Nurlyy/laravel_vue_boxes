<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filter;

class FilterController extends Controller
{

    public function addFilter(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|unique:filters|max:255',
        ]);

        $filter = Filter::create([
            'name' => $validatedData['name'],
        ]);

        return response()->json(['filter' => $filter], 201);
    }

    public function getFilters(Request $request){
        $filters = Filter::all();
        return response()->json(['filters' => $filters]);
    }

    public function show(Filter $filter)
    {
        return response()->json(['filter' => $filter]);
    }

    public function updateFilter(Request $request)
    {
        $filter = Filter::find($request->filterId);

        $validatedData = $request->validate([
            'name' => 'required|unique:filters|max:255',
        ]);

        $filter->update([
            'name' => $validatedData['name'],
        ]);

        return response()->json(['filter' => $filter]);
    }

    public function destroy(Filter $filter)
    {
        $filter->delete();

        return response()->json(null, 204);
    }

}