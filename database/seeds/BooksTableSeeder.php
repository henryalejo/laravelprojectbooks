<?php

use Illuminate\Database\Seeder;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('books')->insert([
        [
          'name' => 'The Great Design',
          'avaliable' => 20,
          'author' => 'Stephen Hawking, Leonard Mlodinow',
          'isbn' => '055338466X',
          'publication' => date('2001-10-05'),
          'value' => 12.99,
          'total_sales'=> 0
        ],
        [
          'name' => 'Anne Frank: The Diary of a Young Girl',
          'avaliable' => 11,
          'author' => 'Anne Frank',
          'isbn' => '8497593065',
          'publication' => date('2015-02-24'),
          'value' => 10.29,
          'total_sales'=> 0
        ],
        [
          'name' => 'Predictably Irrational',
          'avaliable' => 5,
          'author' => 'Dan Ariely',
          'isbn' => '9780061353246',
          'publication' => date('2010-04-27'),
          'value' => 9.78,
          'total_sales'=> 0
        ],
        [
          'name' => 'The Prince (Dover Thrift Editions)',
          'avaliable' => 3,
          'author' => 'Niccolò Machiavelli',
          'isbn' => '0486272745',
          'publication' => date('1992-09-21'),
          'value' => 3.48,
          'total_sales'=> 0
        ],
        [
          'name' => 'The Theory Of Everything',
          'avaliable' => 20,
          'author' => 'Stephen Hawking',
          'isbn' => '8179925919',
          'publication' => date('2007-01-01'),
          'value' => 16.50,
          'total_sales'=> 0
        ],
        [
          'name' => 'Cosmos',
          'avaliable' => 7,
          'author' => 'Carl Sagan',
          'isbn' => '0345539435',
          'publication' => date('2013-12-10'),
          'value' => 21.99,
          'total_sales'=> 0
        ],
        [
          'name' => 'The World As I See It',
          'avaliable' => 2,
          'author' => 'Albert Einstein',
          'isbn' => '0806527900',
          'publication' => date('2006-10-05'),
          'value' => 12.00,
          'total_sales'=> 0
        ],
        [
          'name' => 'The Art Of War',
          'avaliable' => 30,
          'author' => 'Sun Tzu',
          'isbn' => '1599869772',
          'publication' => date('2007-01-05'),
          'value' => 4.50,
          'total_sales'=> 0
        ],
        [
          'name' => 'Twenty Love Poems and a Song of Despair',
          'avaliable' => 3,
          'author' => 'Pablo Neruda',
          'isbn' => '0143039962',
          'publication' => date('2006-11-05'),
          'value' => 12.99,
          'total_sales'=> 0
        ],
        [
          'name' => 'The Hunger Games (Book 1)',
          'avaliable' => 6,
          'author' => 'Suzanne Collins',
          'isbn' => '055338466X',
          'publication' => date('2003-06-05'),
          'value' => 19.25,
          'total_sales'=> 0
        ],
        [
          'avaliable' => 34,
          'name' => 'HTML5 Games',
          'author' => 'Jacob Seidelin',
          'isbn' => '9781119975083',
          'publication' => '2013-10-05',
          'value' => 12.50,
          'total_sales'=> 0]
    ]);
    }
}
