<?php


namespace App\Service;


use App\Models\Item;
use Illuminate\Support\Str;

class ItemLogic extends MainService
{

    public function makeItemsSeed($data = 1)
    {
      return Item::factory($data)->create();
    }

    public function createItem($data)
    {
        $item = new Item([
            'name' => $data,
            'key' => Str::random(25)
        ]);
        $item->save();
        return $item;
    }

    public function updateItem($fields, $id)
    {
        $item = Item::find($id);
        $item->fill($fields);
        $item->save();
        return $item;
    }

    public function deleteItem($id)
    {
        Item::find($id)->delete();

    }

    public function deleteItemForever($id)
    {
        Item::withTrashed()->find($id)->forceDelete();
    }



}
