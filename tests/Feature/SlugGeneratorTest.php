<?php

namespace Tests\Feature;

use App\Services\SlugGenerator;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SlugGeneratorTest extends TestCase
{
    protected $slugGenerator;

   public function setUp()
   {
       parent::setUp();

       $this->slugGenerator = new SlugGenerator();
   }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function testSlugGeneratorReturnsValue()
    {
         $slug = $this->slugGenerator->generateSlug();

        $this->assertNotEmpty($slug);
    }

    public function testSlugGeneratorReturns16Characters()
    {
        $slug = $this->slugGenerator->generateSlug();

        $this->assertEquals(16,strlen($slug));
    }
}
