<?php

namespace Tests\Unit\ItemApi;

use App\Facades\ItemService;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;
use Faker\Factory as Faker;
// use PHPUnit\Framework\TestCase;

class ItemControllerUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function testUpdateAction()
    {
       $item = Item::factory()->create();
       $dbItem = Item::find($item->id);
       $this->assertNotNull($dbItem);
       $faker = Faker::create();
       $fields = [
           'name' => $faker->name(),
           'key' => Str::random(25)
       ];
       $dbUpdatedItem = ItemService::updateItem($fields,$dbItem->id);
       $this->assertTrue( $dbUpdatedItem->name == $fields['name']
       and
       $dbUpdatedItem->key == $fields['key']);
    }
}
