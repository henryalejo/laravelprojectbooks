<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SaleApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGetApiSale()
    {
      $response = $this->call('GET', '/sale');
      $this->assertEquals(200, $response->status());
    }
    public function testGetSaleWithId()
    {
      $response = $this->call('GET', '/sale/3');
      $this->assertEquals(200, $response->status());
    }
    public function testPostSale()
    {
      $myJson=[];
      $myJson['books'][0]['id']=1;
      $myJson['books'][0]['num_books']=1;
      $myJson['books'][1]['id']=2;
      $myJson['books'][1]['num_books']=1;
      
      $response = $this->call('POST','/sale',$myJson);
      $this->assertEquals(201, $response->status());
    }
}
