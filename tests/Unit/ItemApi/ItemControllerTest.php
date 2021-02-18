<?php

namespace Tests\Unit\ItemApi;

//use PHPUnit\Framework\TestCase;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndexAction()
    {
        $item = Item::factory(5)->create();
        $request = Item::latest()->paginate(5);
        $this->assertNotNull($request);
        $this->assertTrue($item->count() == $request->count());
    }





}
