<?php
/** @test */
namespace Tests\Unit;

// use PHPUnit\Framework\TestCase;
use Tests\TestCase;
use App\Models\{User,Post};
 
class PostTest extends TestCase
{
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

    public function test_create_post()
    {
        $this->actingAs($this->user);
        $this->assertTrue(true);
        $rand = rand(1,100);
        $data = [
            'title' => "New Post title".$rand,
            'slug' => 'new-post-title-'.$rand,
            'small_description' => "This is a post small description".$rand,
            'description' => "This is a product".$rand,
            'category' => rand(1,7),
        ];
        $response = $this->post('post', $data);
        return $response->assertStatus(302); 
        // $this->assertDatabaseHas('posts', ['slug' => $data['slug']]);
    }
}
