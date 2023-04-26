<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Filter;
use App\Models\ImagesFilter;

class ImageController extends Controller
{

    public function addImage(Request $request)
    {
        // return $request;
        if ($request->hasFile('image')) {
            // $path = $request->file('image')->store('public/uploads');
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            // return $imageName;
            // $newPath = $request->image->store('public/uploads', 's3');
            // return $newPath;

            $path = 'public/uploads/' . $imageName;
            $description = $request->description;
            // return $description;
            $imageFilters = $request->imageFilters;

            if ($path != null && $description != null) {

                $image = Image::create(['path' => $path, 'description' => $description]);

                if ($imageFilters != null) {
                    foreach ($imageFilters as $imageFilter) {
                        $filter = Filter::find($imageFilter['id'])->first();
                        if ($filter != null && $filter != '' && $filter != []) {
                            $imagesFilter = ImagesFilter::create([
                                'image_id' => $image->id,
                                'filter_id' => $filter->id,
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function getImages(Request $request)
    {
        $images = Image::all();
        $filters = Filter::all();

        return response()->json(['images' => $images, 'filters' => $filters]);
    }
}
