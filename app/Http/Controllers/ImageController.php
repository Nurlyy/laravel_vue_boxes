<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Filter;
use App\Models\ImagesFilter;

class ImageController extends Controller
{

    public function addImage(Request $request){
        $path = $request->path;
        $description = $request->description;
        $imageFilters = $request->imageFilters;

        $image = Image::create(['path' => $path, 'description' => $description]);

        foreach($imageFilters as $imageFilter){
            $filter = Filter::find($imageFilter['id'])->first();
            if($filter != null && $filter != '' && $filter != []){
                $imagesFilter = ImagesFilter::create([
                    'image_id' => $image->id,
                    'filter_id' => $filter->id,
                ]);
            }
        }

    }

    public function getImages(Request $request){
        $images = Image::all();
        $filters = Filter::all();

        return response()->json(['images' => $images, 'filters' => $filters]);
    }

}