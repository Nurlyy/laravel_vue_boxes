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

            $images = Image::skip(($page - 1) * $per_page)->take($per_page)->get();
            // }
        }


        return response()->json(['images' => $images, 'filters' => $filters, 'lastPage' => $lastPage]);
    }

    public function getCategoryImages(Request $request)
    {
        $filters = Filter::all();

        $filter_id = $request->category_id;
        if($filter_id==null){
            return response()->json(['message' => "Unkown id"], 404);
        }
        $filter = Filter::where('id', $filter_id)->first();
        if(empty($filter)){
            return response()->json(['message' => "Unkown id02"], 404);
        }


        $page = $request->page;
        $per_page = $request->per_page;

        $imagesFilter = ImagesFilter::where('filter_id', $filter_id)->get();
        $ids = [];

        foreach($imagesFilter as $imageFilter){
            array_push($ids, $imageFilter->image_id);
        }
        $items = Image::whereIn('id', $ids)->count();
        $lastPage = ceil($items / $per_page);
        // if ($page != 1) {
        // $images = Image::all();
        // } else {
        
        $images = Image::whereIn('id', $ids)->skip(($page - 1) * $per_page)->take($per_page)->get();
        // }



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

    public function udpateImage(Request $request)
    {
        $id = $request->id;
        $main_image = Image::where('id', $id)->first();

        $description = $request->description;
        // return $description;
        $imageFilters = json_decode($request->imageFilters);

        if ($description != null) {

            $main_image::update(['description' => $description]);

            if ($imageFilters != null) {

                // $imagesFilters = ImagesFilter::where('image_id', $main_image->id)->get();
                // foreach($imagesFilters as $imgsFiltrs){
                //     $imgsFiltrs->delete();
                // }
                $db_deleted_filters = [];
                foreach ($imageFilters as $imageFilter) {
                    // return $imageFilter['id'];
                    $filter = Filter::where('id', $imageFilter->id)->first();
                    // return $filter;
                    if ($filter != null && $filter != '' && $filter != []) {
                        $db_imageFilter = ImagesFilter::where('id', $imageFilter->id)->first();
                        array_push($db_deleted_filters, $db_imageFilter->id);
                        if ($db_imageFilter->filter_id != $filter->id && $db_imageFilter->image_id != $main_image->id) {
                            $imagesFilter = ImagesFilter::create([
                                'image_id' => $main_image->id,
                                'filter_id' => $filter->id,
                            ]);
                        }
                    }
                }
                if(!empty($db_deleted_filters)){
                    foreach($db_deleted_filters as $d){
                        $d->delete();
                    }
                }
            }
        }
        return response()->json(['message' => "Image Updated Successfully"]);
        // $main_image->path = 
    }

    public function deleteImage(Request $request)
    {
        $id = $request->id;
        $image = Image::where('id', $id)->first();
        $imageFilters = ImagesFilter::where('image_id', $image->id)->get();
        foreach($imageFilters as $imageFilter){
            $imageFilter->delete();
        }
        $image->delete();
        return response()->json(['images' => Image::all()], 204);
    }

    public function getImageAdmin(Request $request){
        return response()->json(['image' => Image::where('id', $request->id)->first(), 'image_filters' => ImagesFilter::where('image_id', $request->id)->get()]);
    }
}
