<?php

namespace Tests\Unit;

use App\Facades\ItemService;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// use PHPUnit\Framework\TestCase;

class RefreshDataBaseTest extends TestCase
{
    use RefreshDatabase;

    public function testRefreshDataBase()
    {
        $item =  Item::factory(10)->create();
        $this->assertNotNull($item);
        ItemService::refreshDataBase();
        $query = Item::all();
        $this->assertEmpty($query);
    }

    public function testDeleteForever()
    {
        $item =  Item::factory()->create([
            'created_at' => now()->addSeconds(-10)
        ]);
        ItemService::deleteItem($item->id);
        $trash = Item::withTrashed()->first();
        $this->assertNotNull($trash);
        ItemService::deleteItemForever($trash->id);
        $this->assertNull(Item::find($trash->id));
    }


}
