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

            $path = '/uploads/' . $imageName;
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
        if ($filter_id == null) {
            return response()->json(['message' => "Unkown id"], 404);
        }
        $filter = Filter::where('id', $filter_id)->first();
        if (empty($filter)) {
            return response()->json(['message' => "Unkown id02"], 404);
        }


        $page = $request->page;
        $per_page = $request->per_page;

        $imagesFilter = ImagesFilter::where('filter_id', $filter_id)->get();
        $ids = [];

        foreach ($imagesFilter as $imageFilter) {
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

            // $page = $request->page;
            // $per_page = $request->per_page;

            // $items = Image::count();
            // $lastPage = ceil($items / $per_page);
            // // if ($page != 1) {
            // // $images = Image::all();
            // // } else {

            // $images = Image::skip(($page - 1) * $per_page)->take($per_page)->get();
        }




        return response()->json(['images' => $images, 'filters' => $filters]);
    }

    public function updateImage(Request $request)
    {
        // return response()->json([$request->imageFilters], 500);

        $id = $request->id;
        $main_image = Image::where('id', $id)->first();

        $description = $request->description;
        // return $description;
        $imageFilters = json_decode($request->imageFilters);
        $previousFilters = ImagesFilter::where('image_id', $main_image->id)->get();

        // var_dump(!empty(get_object_vars($previousFilters)));
        // return response()->json();
        // var_dump(empty($imageFilters));exit;

        if ($description != null) {

            $main_image->update(['description' => $description]);
        }

        if (empty($imageFilters) && !empty(json_decode(json_encode($previousFilters), true))) {

            foreach ($previousFilters as $prev) {
                $prev->delete();
            }
        } elseif (empty($imageFilters) && empty(json_decode(json_encode($previousFilters), true))) {


            foreach ($imageFilters as $img) {

                if (isset($img->image_id)) {
                    continue;
                } else {
                    ImagesFilter::create([
                        'image_id' => $main_image->id,
                        'filter_id' => $img->id,
                    ]);
                }
            }
        } else {

            $imageFilters = json_decode(json_encode($imageFilters), true);
            $previousFilters = json_decode(json_encode($previousFilters), true);

            $idImages = array_map(function ($element) {
                return $element['id'];
            }, $imageFilters);

            $idPrev = array_map(function ($element) {
                return $element['id'];
            }, $previousFilters);

            $deleted_filters = array_diff($idPrev, $idImages);

            foreach ($deleted_filters as $id) {
                $imagef = ImagesFilter::where('id', $id)->first();
                $imagef->delete();
            }

            $idPrev = array_diff($idPrev, $deleted_filters);

            $added_filters = array_diff($idImages, $idPrev);

            foreach ($added_filters as $id) {
                $img = ImagesFilter::create([
                    'image_id' => $main_image->id,
                    'filter_id' => $id,
                ]);
            }
        }

        // return response()->json(['gfdsj'], 404);

        // $new_filters = [];

        // $deleted_filters = [];

        // foreach ($previousFilters as $prev) {
        //     foreach ($imageFilters as $imageFilter) {
        //         if (isset($imageFilter->image_id)) {
        //             if ($imageFilter->image_id == $prev->filter_id) {
        //                 continue 2;
        //             } else {
        //                 array_push($deleted_filters, $imageFilter);
        //                 continue 2;
        //             }
        //         } else {
        //             array_push($new_filters, $imageFilter);
        //             continue 2;
        //         }
        //     }
        // }

        // foreach ($new_filters as $new) {
        //     $new = ImagesFilter::create([
        //         'image_id' => $new->image_id,
        //         'filter_id' => $new->filter_id,
        //     ]);
        // }

        // foreach ($deleted_filters as $del) {
        //     $filter = ImagesFilter::where('id', $del->id);
        //     $filter->delete();
        // }

        // $imagesFilters = ImagesFilter::where('image_id', $main_image->id)->get();
        // foreach($imagesFilters as $imgsFiltrs){
        //     $imgsFiltrs->delete();
        // }
        // $db_deleted_filters = [];
        // foreach ($imageFilters as $imageFilter) {
        //     // return $imageFilter['id'];
        //     $filter = Filter::where('id', $imageFilter->id)->first();
        //     // return $filter;
        //     if ($filter != null && $filter != '' && $filter != []) {
        //         $db_imageFilter = ImagesFilter::where('id', $imageFilter->id)->first();
        //         array_push($db_deleted_filters, $db_imageFilter->id);
        //         if ($db_imageFilter->filter_id != $filter->id && $db_imageFilter->image_id != $main_image->id) {
        //             $imagesFilter = ImagesFilter::create([
        //                 'image_id' => $main_image->id,
        //                 'filter_id' => $filter->id,
        //             ]);
        //         }
        //     }
        // }
        // if(!empty($db_deleted_filters)){
        //     foreach($db_deleted_filters as $d){
        //         $d->delete();
        //     }
        // }


        return response()->json(['message' => "Image Updated Successfully"]);
        // $main_image->path = 
    }

    public function deleteImage(Request $request)
    {
        $id = $request->id;
        $image = Image::where('id', $id)->first();
        $imageFilters = ImagesFilter::where('image_id', $image->id)->get();
        foreach ($imageFilters as $imageFilter) {
            $imageFilter->delete();
        }
        if (file_exists($image->path)) {
            unlink($image->path);
            echo 'File deleted successfully.';
        } else {
            echo 'File not found.';
        }
        $image->delete();
        return response()->json(['message' => 'Image deleted'], 204);
    }

    public function getImageAdmin(Request $request)
    {
        $image = Image::where('id', $request->id)->first();
        $imageFilters = ImagesFilter::where('image_id', $request->id)->get();
        foreach ($imageFilters as &$imageFilter) {
            $imageFilter['name'] = Filter::where('id', $imageFilter->filter_id)->first()->name;
        }
        return response()->json(['image' => $image, 'image_filters' => $imageFilters]);
    }
}
