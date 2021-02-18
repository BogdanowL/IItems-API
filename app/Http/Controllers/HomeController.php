<?php

namespace App\Http\Controllers;

use App\Facades\ItemService;
use App\Http\Requests\MakeSeedRequest;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function makeFactory(MakeSeedRequest $request)
    {
        ItemService::makeItemsSeed($request->validated()['count']);
        return redirect()->back();
    }

    public function refreshDB()
    {
        ItemService::refreshDataBase();
        return redirect()->back();
    }

    public function deleteForever($id)
    {
       ItemService::deleteItemForever($id);
    }


}
