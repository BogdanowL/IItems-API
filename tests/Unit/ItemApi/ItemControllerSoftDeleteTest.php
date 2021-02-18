<?php

namespace Tests\Unit\ItemApi;

use App\Facades\ItemService;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

// use PHPUnit\Framework\TestCase;

class ItemControllerSoftDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function testSoftDeleteAction()
    {
        $item = Item::factory()->create();
        $dbItem = Item::find($item->id);
        $this->assertNotNull($dbItem);
        ItemService::deleteItem($dbItem->id);
        $query = Item::find($dbItem->id);
        $this->assertNull($query);
        $withTrashQuery = Item::withTrashed()->find($dbItem->id);
        $this->assertNotNull($withTrashQuery);
        $this->assertTrue($dbItem->id == $withTrashQuery->id);
    }
}
