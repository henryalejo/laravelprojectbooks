<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BookApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetBook()
    {
      $response = $this->call('GET', '/book');
      $this->assertEquals(200, $response->status());
        //$this->assertTrue(true);
    }
    public function testGetBookWithId()
    {
      $response = $this->call('GET', '/book/1');
      $this->assertEquals(200, $response->status());
    }
    public function testPostBook()
    {
      $response = $this->call('POST','/book', [
        'avaliable' => '34',
        'name' => 'HTML5 Games',
        'author' => 'Jacob Seidelin',
        'isbn' => '9781119975083',
        'publication' => '2013-10-05',
        'value' => '12.50']);
      $this->assertEquals(201, $response->status());
    }
    public function testPutBook()
    {
      $response = $this->call('PUT','/book/1', [
        'avaliable' => '30',
        'name' => 'The Great Design',
        'author' => 'Stephen Hawking, Leonard Mlodinow',
        'isbn' => '055338466X',
        'publication' => '2001-10-05',
        'value' => '12.99']);
      $this->assertEquals(200, $response->status());
    }
    public function testDeleteBook()
    {
      $response = $this->call('DELETE','/book/14');
      $this->assertEquals(200, $response->status());
    }



}
