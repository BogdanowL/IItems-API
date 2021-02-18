<?php

namespace App\Http\Controllers\API;

use App\Facades\ItemService;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Models\Item;

class ItemController extends Controller
{

    public function index()
    {
       return Item::latest()->paginate(5);
    }

    public function store(StoreItemRequest $request)
    {
        ItemService::createItem($request->validated()['name']);
    }

    public function update(UpdateItemRequest $request, $id)
    {
        ItemService::updateItem($request->validated(), $id);
    }

    public function destroy($id)
    {
       ItemService::deleteItem($id);
    }
}
