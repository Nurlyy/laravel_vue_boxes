<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{

    public function addPage(Request $request)
    {

        $name = $request->name;
        $slug  = $request->slug;
        $title = $request->title;
        $body = $request->body;
        $keyword = $request->keyword;
        $description = $request->description;
        $show = $request->visibility;

        $slug_page = Page::where('slug', $slug)->first();
        if($slug_page != null && $slug_page != []){
            $page = Page::create([
                'name' => $name,
                'slug' => $slug,
                'title' => $title,
                'body' => $body,
                'keyword' => $keyword,
                'description' => $description,
                'show' => $show
            ]);
    
            return response()->json(['page' => $page], 201);
        }
        else {
            return response()->json(['message' => 'Page with this slug already exists'], 500);
        }
        
    }

    public function updatePage(Request $request)
    {

        $name = $request->name;
        $slug  = $request->slug;
        $title = $request->title;
        $body = $request->body;
        $keyword = $request->keyword;
        $description = $request->description;
        $show = $request->visibility;
        $id = $request->id;

        $page = Page::where('id', $id)->first();

        $page->update([
            'name' => $name,
            'slug' => $slug,
            'title' => $title,
            'body' => $body,
            'keyword' => $keyword,
            'description' => $description,
            'show' => $show,
        ]);

        return response()->json(['page' => $page], 201);
    }


    public function getPage(Request $request)
    {
        $slug = $request->slug;
        $page = Page::where('slug', $slug)->first();
        if ($page->show == 1) {
            return response()->json(['page' => $page]);
        } else {
            return response()->json(['message' => 'Page is not available']);
        }
    }

    public function getPages()
    {
        $items = Page::where('show', '1')->get();
        return response()->json(['items' => $items]);
    }

    public function getPagesAdmin()
    {
        $items = Page::all();
        return response()->json(['items' => $items]);
    }

    public function getPageAdmin(Request $request)
    {
        $slug = $request->slug;
        $page = Page::where('slug', $slug)->first();
        return response()->json(['page' => $page]);
    }

    public function deletePage(Request $request){
        $id = $request->id;
        $page = Page::where('id', $id)->first();
        $page->delete();
        return response()->json(null, 204);
    }
}
