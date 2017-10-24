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
        $articles = factory(Article::class,5)->create();
        $response = $this->json('GET','/api/articles');

        $response->assertSuccessful();

        $response->assertJsonStructure([[
            'id','title','description','created_at','updated_at'
        ]]);
    }

    public function testShowArticleViaApi()
    {
        $article = factory(Article::class)->create();
        $response = $this->json('GET','/api/article'.$article->id);

        $response->assertSuccessful();

        $response->assertJsonStructure([
            'id' => $article->id,
            'title'=> $article->title,
            'description' => $article->description,
            'created_at' => $article->created_at,
            'updated_at' => $article->updated_at
        ]);
    }

    public function testShowArticlesViaApiAreBlankIfDatabaseIsEmpty()
    {
        $response = $this->json('GET','/api/articles');
        // TODO comprovar es buit!
        $response->assertSuccessful();
    }
}
