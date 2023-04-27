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

            $path = 'uploads/' . $imageName;
            $description = $request->description;
            // return $description;
            $imageFilters = json_decode($request->imageFilters);

            // return $imageFilters[1];

            if ($path != null && $description != null) {

                $image = Image::create(['path' => $path, 'description' => $description]);

                if ($imageFilters != null) {

                    foreach ($imageFilters as $imageFilter) {
                        // return $imageFilter['id'];
                        $filter = Filter::where('id', $imageFilter->id)->first();
                        // return $filter;
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


        $filters = Filter::all();
        

        if ($request->images_ids != null) {
            if ($request->images_ids == []) {
                return response()->json(['images' => [], 'filters' => $filters]);
            }
            // return "FOFJEWO";
            // return $request->images_ids[0];
            $images = Image::whereIn('id', json_decode($request->images_ids))->get();
        } else {

            

            $page = $request->page;
            $per_page = $request->per_page;

            $items = Image::count();
            $lastPage = ceil($items / $per_page);
            // if ($page != 1) {
            // $images = Image::all();
            // } else {

            $images = Image::skip(($page-1) * $per_page)->take($per_page)->get();
            // }
        }


        return response()->json(['images' => $images, 'filters' => $filters, 'lastPage' => $lastPage]);
    }

    public function getLikes(Request $request)
    {
        $filters = Filter::all();


        if ($request->images_ids == []) {
            return response()->json(['images' => [], 'filters' => $filters]);
        }
        // return "FOFJEWO";
        // return $request->images_ids[0];
        $images = Image::whereIn('id', json_decode($request->images_ids))->get();



        return response()->json(['images' => $images, 'filters' => $filters]);
    }

    public function getImagesAdmin(Request $request)
    {
        $filters = Filter::all();

        if ($request->images_ids != null) {
            if ($request->images_ids == []) {
                return response()->json(['images' => [], 'filters' => $filters]);
            }
            // return "FOFJEWO";
            // return $request->images_ids[0];
            $images = Image::whereIn('id', json_decode($request->images_ids))->get();
        } else {
            $images = Image::all();
        }


        return response()->json(['images' => $images, 'filters' => $filters]);
    }

    // public function udpateImage(Request $request)
    // {
    //     $id = $request->id;
    //     $main_image = Image::where('id', $id)->first();

    //     $imageName = time() . '.' . $request->image->getClientOriginalExtension();
    //     $request->image->move(public_path('uploads'), $imageName);
    //     // return $imageName;
    //     // $newPath = $request->image->store('public/uploads', 's3');
    //     // return $newPath;

    //     $path = 'uploads/' . $imageName;
    //     $description = $request->description;
    //     // return $description;
    //     $imageFilters = json_decode($request->imageFilters);

    //     if ($path != null && $description != null) {

    //         $image = Image::create(['path' => $path, 'description' => $description]);

    //         if ($imageFilters != null) {

    //             foreach ($imageFilters as $imageFilter) {
    //                 // return $imageFilter['id'];
    //                 $filter = Filter::where('id', $imageFilter->id)->first();
    //                 // return $filter;
    //                 if ($filter != null && $filter != '' && $filter != []) {
    //                     $db_imageFilter = ImagesFilter::where('id', $imageFilter->id)->first();
    //                     if ($db_imageFilter->filter_id != $filter->id && $db_imageFilter->image_id != $image->id) {
    //                         $imagesFilter = ImagesFilter::create([
    //                             'image_id' => $image->id,
    //                             'filter_id' => $filter->id,
    //                         ]);
    //                     }
    //                 }
    //             }
    //         }
    //     }
    //     // $main_image->path = 
    // }

    public function deleteImage(Request $request)
    {
        $id = $request->id;
        $image = Image::where('id', $id)->first();
        $image->delete();
        return response()->json(null, 204);
    }
}
