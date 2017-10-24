<?php

namespace Tests\Feature;

use App\Article;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiArticleController extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testShowArticlesViaApi()
    {
        $this->withoutExceptionHandling();
        $articles = factory(Article::class,5)->create();
        $response = $this->json('GET','/api/articles');

        $response->assertSuccessful();

        $response->assertJsonStructure([[
            'id','title','description','created_at','updated_at'
        ]]);
    }

    public function testShowArticlesViaApiAreBlankIfDatabaseIsEmpty()
    {
        $response = $this->json('GET','/api/articles');
        // TODO comprovar es buit!
        $response->assertSuccessful();
    }
}
