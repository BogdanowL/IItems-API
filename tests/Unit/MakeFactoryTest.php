<?php

namespace Tests\Unit;

use App\Facades\ItemService;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

//use PHPUnit\Framework\TestCase;

class MakeFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function testMakeFactory()
    {
        $item = ItemService::makeItemsSeed();
        $dbItem = Item::first();
        $this->assertNotNull($dbItem);
        $this->assertTrue($dbItem->id == $item->first()->id);
    }

    public function testMakeFactories()
    {
        $item =  Item::factory(10)->create();
        $dbItem = Item::all();
        $this->assertNotNull($dbItem);
        $this->assertTrue($dbItem->count() == $item->count());
    }


}
