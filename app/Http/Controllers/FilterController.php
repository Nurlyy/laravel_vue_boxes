<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Filter;

class FilterController extends Controller
{

    public function addFilter(Request $request){
        $name = $request->name;

        $filter = Filter::create([
            'name' => $name
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
        $filter = Filter::find($request->id);

        $validatedData = $request->validate([
            'name' => 'required|unique:filter|max:255',
        ]);

        $filter->update([
            'name' => $validatedData['name'],
        ]);

        return response()->json(['filter' => $filter]);
    }

    public function getFilterAdmin(Request $request){
        $id = $request->id;
        $filter = Filter::where('id', $id)->first();
        return response()->json(['filter' => $filter]);
    }

    public function deleteFilter(Request $request)
    {
        $filter = Filter::find($request->id);
        $filter->delete();

        return response()->json(['filters' => Filter::all()], 204);
    }

}