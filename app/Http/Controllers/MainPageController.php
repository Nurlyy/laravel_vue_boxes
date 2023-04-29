<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MainPage;

class MainPageController extends Controller
{

    public function saveMainPage(Request $request){
        // return $request;
        $header = $request->header;
        $title = $request->title;
        $body = $request->body;

        $mainPage = MainPage::first();
        $mainPage->update([
            'header' => $header,
            'title' => $title,
            'body' => $body
        ]);
        return response()->json(['mainPage' => $mainPage]);
    }

    public function getMainPage(){
        return response()->json(['mainPage' => MainPage::first()]);
    }

}