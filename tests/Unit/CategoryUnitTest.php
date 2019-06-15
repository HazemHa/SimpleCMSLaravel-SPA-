<?php
namespace Tests\Unit;

use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Users;
use App\Category;

class CategoryTest extends TestCase
{
    use WithFaker;
    /***
A Index test Category.*
*
@return void
 */
    public function testIndexCategory()
    {

        $response = $this->get('/Category');
        $response->assertOk();
    }
    /***
A Show test Category.*
*
@return void
 */
    public function testShowCategory()
    {
        $record = Category::inRandomOrder()->first();

        $response = $this->get('/Category/' + $record->id + '');
        $response->assertOk();
    }
    /***
A Store test Category.*
*
@return void
 */
    public function testStoreCategory()
    {
        $user = Users::inRandomOrder()->first();
        $response = $this->actingAs($user, 'api')->json('POST', '/Category', [
            'name' => $this->faker->name,
            'description' => $this->faker->name

        ]);
        $response->assertOk();
    }
    /***
A Destroy test Category.*
*
@return void
 */
    public function testDestroyCategory()
    {

        $user = Users::inRandomOrder()->first();
        $record = Category::inRandomOrder()->first();
        $response = $this->actingAs($user, 'api')->json('delete', '/Category/' + $record->id + '');
        $response->assertOk();
    }
    /***
A Update test Category.*
*
@return void
 */
    public function testUpdateCategory()
    {
        $user = Users::inRandomOrder()->first();
        $response = $this->actingAs($user, 'api')->json('PUT', '/Category/' + $record->id + '', [
            'name' => $this->faker->name,
            'description' => $this->faker->name

        ]);
        $response->assertOk();
    }
    /***
A Create test Category.*
*
@return void
 */
    public function testCreateCategory()
    {
        $record = Category::inRandomOrder()->first();

        $response = $this->get('/Category/create');
        $response->assertOk();
    }
    /***
A Edit test Category.*
*
@return void
 */
    public function testEditCategory()
    {
        $record = Category::inRandomOrder()->first();

        $response = $this->get('/Category/' + $record->id + '/edit');
        $response->assertOk();
    }
}