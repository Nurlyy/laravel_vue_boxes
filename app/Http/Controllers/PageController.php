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
        $show = $request->show;

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

    public function getPage(Request $request)
    {
        $id = $request->page_id;
        $page = Page::find($id)->first();
        return response()->json(['page' => $page]);
    }

    public function getPages()
    {
        return response()->json(['items' => Page::all()]);
    }
}
