<?php

namespace Tests\Unit\ItemApi;

use App\Facades\ItemService;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

//use PHPUnit\Framework\TestCase;

class ItemControllerStoreTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreAction()
    {
        $item = ItemService::createItem('test name');
        $dbItem = Item::first();
        $this->assertNotNull($dbItem);
        $this->assertTrue($dbItem->id == $item->id);
    }
}
