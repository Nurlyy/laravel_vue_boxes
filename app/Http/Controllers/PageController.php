<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{

    public function addPage(){
        
    }

    public function getPage(Request $request){
        $id = $request->page_id;
        $page = Page::find($id)->first();
        return response()->json(['page' => $page]);
    }

    public function getPages(){
        return response()->json(['items' => Page::all()]);
    }

}