<?php

namespace Tests\Feature;

use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BooksApiTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_fetch_all_books()
    {
        $books = Book::factory(4)->create();

        $response = $this->getJson(route('books.index'));

        $response->assertJsonFragment([
           'title' => $books[0]->title
        ])->assertJsonFragment([
            'title' => $books[1]->title
        ]);
    }

    /** @test */
    function can_fetch_one_book()
    {
        $book = Book::factory()->create();

        $this->getJson(route('books.show', $book))
            ->assertJsonFragment([
            'title' => $book->title
        ]);
    }

    /** @test */
    function the_title_is_required()
    {
        $this->postJson(route('books.store'), [])
            ->assertJsonValidationErrorFor('title');
    }

    /** @test */
    function can_create_books()
    {
        $this->postJson(route('books.store', [
            'title' => 'React JS'
        ]))->assertJsonFragment([
            'title' => 'React JS'
        ]);

        $this->assertDatabaseHas('books', [
            'title' => 'React JS'
        ]);
    }

    /** @test */
    function can_update_a_book()
    {
        $book = Book::factory()->create();

        $this->patchJson(route('books.update', $book), [
            'title' => 'React Native JS'
        ])->assertJsonFragment([
            'title' => 'React Native JS'
        ]);

        $this->assertDatabaseHas('books', [
            'title' => 'React Native JS'
        ]);
    }

    /** @test */
    function can_delete_a_book()
    {
        $book = Book::factory()->create();

        $this->deleteJson(route('books.destroy', $book))
            ->assertNoContent();

        $this->assertDatabaseCount('books', 0);
    }

}
