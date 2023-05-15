<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use App\Models\Filter;
use App\Models\ImagesFilter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\QueryException;
use PDO;
use PDOException;

class ImageController extends Controller
{

    public function addImage(Request $request)
    {
        // return $request;
        if ($request->hasFile('image')) {
            // $path = $request->file('image')->store('public/uploads');
            // $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            // $request->image->move(public_path('uploads'), $imageName);

            $imageName = time();
            $ext = $request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName . "." . $ext);
            $file =  $imageName . '.' . $ext;
            $this->convertImageToWebp($file);
            $this->createPreview($imageName . '.' . 'webp');
            $path = '/uploads/' . $imageName . '.' . 'webp';
            $preview = '/uploads/' . $imageName . '-preview' . '.' . 'webp';
            // return $imageName;
            // $newPath = $request->image->store('public/uploads', 's3');
            // return $newPath;

            // $path = '/uploads/' . $imageName;
            $description = $request->description;
            // return $description;
            $imageFilters = json_decode($request->imageFilters);

            // return $imageFilters[1];

            if ($path != null && $description != null) {

                $image = Image::create(['path' => $path, 'description' => $description, 'preview' => $preview]);

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
            $images = Image::whereIn('id', json_decode($request->images_ids))->orderBy('id', 'desc')->get();
        } else {
            $page = $request->page;
            $per_page = $request->per_page;
            $items = Image::count();
            $lastPage = ceil($items / $per_page);
            $images = Image::skip(($page - 1) * $per_page)->take($per_page)->orderBy('id', 'desc')->get();
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

        $images = Image::whereIn('id', $ids)->skip(($page - 1) * $per_page)->take($per_page)->orderBy('id', 'desc')->get();
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
        $images = Image::whereIn('id', json_decode($request->images_ids))->orderBy('id', 'desc')->get();



        return response()->json(['images' => $images, 'filters' => $filters]);
    }

    public function getImagesAdmin(Request $request)
    {
        $filters = Filter::all();
        $filters = json_decode(json_encode($filters), true);
        $new_filters = [];
        foreach ($filters as $filter) {
            $new_filters[$filter['id']] = $filter['name'];
        }

        if (isset($request->search)) {
            $images = Image::where('id', 'like', $request->search . '%')->orderBy('id', 'desc')->get();
        } else {
            if ($request->images_ids != null) {
                if ($request->images_ids == []) {
                    return response()->json(['images' => [], 'filters' => $filters]);
                }
                // return "FOFJEWO";
                // return $request->images_ids[0];
                $images = Image::whereIn('id', json_decode($request->images_ids))->orderBy('id', 'desc')->get();
            } else {
                $images = Image::orderBy('id', 'desc')->get();

                // $page = $request->page;
                // $per_page = $request->per_page;

                // $items = Image::count();
                // $lastPage = ceil($items / $per_page);
                // // if ($page != 1) {
                // // $images = Image::all();
                // // } else {

                // $images = Image::skip(($page - 1) * $per_page)->take($per_page)->get();
            }
        }



        foreach ($images as $image) {
            $images_filters = ImagesFilter::where('image_id', $image->id)->get();
            foreach ($images_filters as &$img) {
                $img->name = $new_filters[$img->filter_id];
            }
            $image->filters = $images_filters;
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


    private function convertImageToWebp($file)
    {
        ini_set('memory_limit', '256M');
        $directory = str_replace('\\', '/', public_path()) . '/' . "uploads/";
        if (in_array(pathinfo($file, PATHINFO_EXTENSION), array('jpg', 'jpeg', 'png', "JPG", "JPEG", "PNG"))) {

            if (in_array(pathinfo($file, PATHINFO_EXTENSION), array('jpg', 'jpeg', "JPG", "JPEG"))) {
                // Load the original image
                $original_image = imagecreatefromjpeg($directory . $file);

                // Create a new WebP image
                $new_image = imagecreatetruecolor(imagesx($original_image), imagesy($original_image));
                imagepalettetotruecolor($new_image);

                // Convert the original image to the WebP format
                imagewebp($original_image, $directory . pathinfo($file, PATHINFO_FILENAME) . '.webp');

                // Clean up the resources
                imagedestroy($original_image);
                imagedestroy($new_image);
            } elseif (in_array(pathinfo($file, PATHINFO_EXTENSION), array('png', 'PNG'))) {
                // Load the original image
                $original_image = imagecreatefrompng($directory . $file);

                // Create a new WebP image
                $new_image = imagecreatetruecolor(imagesx($original_image), imagesy($original_image));
                imagepalettetotruecolor($new_image);

                // Convert the original image to the WebP format
                imagewebp($original_image, $directory . pathinfo($file, PATHINFO_FILENAME) . '.webp');

                // Clean up the resources
                imagedestroy($original_image);
                imagedestroy($new_image);
            }
        }
        unlink($directory . $file);
    }

    private function convertAllImagesToWebp()
    {
        ini_set('memory_limit', '256M');
        // Set the directory path
        $directory = str_replace('\\', '/', public_path()) . '/' . 'uploads/new/';

        // Get all files in the directory
        $files = scandir($directory);

        // Loop through each file
        foreach ($files as $file) {
            // Check if the file is a JPG or PNG
            if (in_array(pathinfo($file, PATHINFO_EXTENSION), array('jpg', 'jpeg', 'png', "JPG", "JPEG", "PNG"))) {

                if (in_array(pathinfo($file, PATHINFO_EXTENSION), array('jpg', 'jpeg', "JPG", "JPEG"))) {
                    // Load the original image
                    $original_image = imagecreatefromjpeg($directory . $file);

                    // Create a new WebP image
                    $new_image = imagecreatetruecolor(imagesx($original_image), imagesy($original_image));
                    imagepalettetotruecolor($new_image);

                    // Convert the original image to the WebP format
                    imagewebp($original_image, $directory . pathinfo($file, PATHINFO_FILENAME) . '.webp');

                    // Clean up the resources
                    imagedestroy($original_image);
                    imagedestroy($new_image);
                } elseif (in_array(pathinfo($file, PATHINFO_EXTENSION), array('png', 'PNG'))) {
                    // Load the original image
                    $original_image = imagecreatefrompng($directory . $file);

                    // Create a new WebP image
                    $new_image = imagecreatetruecolor(imagesx($original_image), imagesy($original_image));
                    imagepalettetotruecolor($new_image);

                    // Convert the original image to the WebP format
                    imagewebp($original_image, $directory . pathinfo($file, PATHINFO_FILENAME) . '.webp');

                    // Clean up the resources
                    imagedestroy($original_image);
                    imagedestroy($new_image);
                }
                unlink($directory . pathinfo($file, PATHINFO_FILENAME) . '.' . pathinfo($file, PATHINFO_EXTENSION));
            }
        }

        $files = scandir($directory);
        foreach ($files as $file) {
            if (in_array(pathinfo($file, PATHINFO_EXTENSION), array('webp'))) {
                $this->createPreview(pathinfo($file, PATHINFO_FILENAME) . '.' . pathinfo($file, PATHINFO_EXTENSION));
            }
        }
    }


    private function createPreview($file)
    {
        ini_set('memory_limit', '256M');
        $directory = str_replace('\\', '/', public_path()) . '/' . "uploads/new/";
        $image = imagecreatefromwebp($directory . $file);

        // Get the current dimensions of the image
        $width = imagesx($image);
        $height = imagesy($image);

        // Calculate the new dimensions
        $new_height = 400; // 50% of the original height or minimum 400 pixels
        $new_width = $new_height * $width / $height; // Maintain the aspect ratio

        // Create a new image with the new dimensions
        $new_image = imagecreatetruecolor($new_width, $new_height);

        // Squeeze the original image into the new image
        imagecopyresampled($new_image, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

        // Save the new image as a .webp file
        imagewebp($new_image, $directory . pathinfo($file, PATHINFO_FILENAME) . '-preview' . '.webp', 80); // 80 is the quality parameter, which can be set between 0 and 100

        // Free up memory
        imagedestroy($image);
        imagedestroy($new_image);
    }

    public function cv()
    {
        $host = 'localhost';      // Hostname
        $username = 'your_username';   // Database username
        $password = 'your_password';   // Database password
        $database = 'your_database';   // Database name

        // Create a new database connection
        $conn = mysqli_connect($host, $username, $password, $database);

        // Check if the connection was successful
        if (!$conn) {
            die('Failed to connect to the database: ' . mysqli_connect_error());
        }
        $tableName = 'your_table_name';
        $columnName = 'new_column';
        $columnType = 'VARCHAR(255)'; // Adjust the data type and length as per your requirements

        // Prepare the ALTER TABLE statement
        $sql = "ALTER TABLE $tableName ADD $columnName $columnType";

        // Execute the ALTER TABLE statement
        if (mysqli_query($conn, $sql)) {
            echo "Column $columnName added successfully to table $tableName";
        } else {
            echo "Error adding column: " . mysqli_error($conn);
        }

        // Close the database connection
        mysqli_close($conn);
    }

    public function cve()
    {


        // $envVariable = getenv('DB_HOST');

        // echo $envVariable;
        // echo "<br>";
        // echo getenv("DB_PASSWORD");

        $host = 'mysql';      // Hostname
        $username = 'root';   // Database username
        $password = 'xa7thieM7sheiBaeJ2Ug2zuk8eidoo1l';   // Database password
        $database = 'propako';   // Database name

        // Create a new database connection
        // DB::connection([
        //     'host' => $host,
        //     'username' => $username,
        //     'password' => $password,
        //     'database' => $database,
        // ]);


        $tableName = 'image';
        $columnName = 'preview';
        $columnType = 'TEXT';


        try {
            // Create a new PDO connection
            $conn = new PDO("mysql:host=$host;dbname=$database;charset=utf8", $username, $password);

            // // Generate the SQL dump file
            //     $dumpFile = str_replace('\\', '/', public_path()) . '/' . 'backup.sql';
            //     $command = "mysqldump --user=$username --password=$password --host=$host $database > $dumpFile";
            //     exec($command);

            //     echo "Database exported successfully.";
            // } catch (PDOException $e) {
            //     echo "Error exporting database: " . $e->getMessage();
            // }






            //     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //     // Select all items from the image table
            //     $sql = "SELECT * FROM image";
            //     $stmt = $conn->query($sql);


            //     // Iterate over the rows and update the file extensions
            //     while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //         $id = $row['id'];
            //         $path = $row['path'];

            //         // Change the file extension (e.g., from .jpg to .png)
            //         $newPath = str_replace('.webp', '-preview.webp', $path);

            //         // Update the 'path' field with the new extension
            //         $updateSql = "UPDATE image SET preview = :newPath WHERE id = :id";
            //         $updateStmt = $conn->prepare($updateSql);
            //         $updateStmt->bindValue(':newPath', $newPath);
            //         $updateStmt->bindValue(':id', $id);
            //         $updateStmt->execute();
            //     }

            //     echo "File extensions updated successfully.";
            // } catch (PDOException $e) {
            //     echo "Error updating file extensions: " . $e->getMessage();
            // }





$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Select all rows from the image table
$sql = "SELECT * FROM image";
$stmt = $conn->query($sql);

// Fetch all rows and display the results
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
var_dump($rows);
} catch (PDOException $e) {
echo "Error retrieving data: " . $e->getMessage();
}






        // try {
        //     DB::statement("ALTER TABLE `$tableName` ADD `$columnName` $columnType");
        //     echo "Table $tableName altered successfully.";
        // } catch (QueryException $e) {
        //     echo "Error altering table: " . $e->getMessage();
        // }

        // $conn = mysql_connect($host, $username, $password, $database);
        // if (!$conn) {
        //     die('Failed to connect to the database: ' . mysqli_connect_error());
        // }

        // // $sql = "ALTER TABLE `$tableName` ADD `$columnName` $columnType";
        // $sql = "SELECT * FROM contact";

        // var_dump(mysql_query($conn, $sql));

        // DB::statement("ALTER TABLE $tableName ADD $columnName $columnType");

        // if (Schema::hasColumn($tableName, $columnName)) {
        // echo "Column $columnName added successfully to table $tableName";
        // } else {
        // echo "Error adding column";
        // }

    }
}
