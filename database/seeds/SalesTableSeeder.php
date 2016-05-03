<?php

use Illuminate\Database\Seeder;

class SalesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $numSales= 10;
      $books = DB::table('books')->get();
      /**
       * First "For" to intesr 10 new sales
       *
       */
      for ($i=0; $i < $numSales; $i++) {
        $mySaleId = DB::table('sales')->insertGetId(
          [
            'dateofsale' => date('20'.mt_rand(10, 16).'-'.mt_rand(01, 12).'-'.mt_rand(01, 28)),
            'amount' => 1
          ]
        );

        $numBooksInSale = mt_rand(1,sizeof($books));
        $booksrand = array_rand($books,$numBooksInSale);//random ids of books
        if (!is_array($booksrand)){
          $booksrand = array($booksrand);
        };
        /**
         * Second "For" to insert random books to the sales
         *
         */
        for ($j=0; $j < sizeof($booksrand) ; $j++) {
          $randNumBooks=mt_rand(1, 2);
          DB::table('sale_books')->insert(
            [
              'sale_id' => $mySaleId,
              'book_id' => $books[$booksrand[$j]]->id,
              'num_books' => $randNumBooks,
              'book_curr_val' => $books[$booksrand[$j]]->value
            ]
          );
          //increment sales ofeach book
          DB::table('books')->where('id',$books[$booksrand[$j]]->id)->increment('total_sales', $randNumBooks);

        };
        //Update amount of sale
        $amountsTables =DB::table('sale_books')->where('sale_id',$mySaleId)->get();
        $temp=0;
        foreach ($amountsTables as $key => $value) {
          $temp = $temp + ($value->num_books*$value->book_curr_val);
        }
        DB::table('sales')->where('id',$mySaleId)->update(['amount'=>$temp]);
      };

    }
}
