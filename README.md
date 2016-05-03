### laravelprojectbooks
You can view online deployment at : https://laravelprojectbooks.herokuapp.com
with functional API REST services and HTML5 UI.

## Book Sales Management in Laravel
####Henry Alejandro Orjuela Torres

### 1. Create Book model and migration:

  `php artisan make:model Book --migration`

  Create  Sale model and migration:

  `php artisan make:model Sale --migration`

  This problem was managed as many to many relation,  is necessary add to model Sale.
  (the models are in app folder)
  ```php
  class Book extends Model
  {
      public $timestamps = false;//no timestamps on DB
      public function sales()
      {
          return $this->belongsToMany('App\Sale','sale_books')->withPivot('num_books','book_curr_val');
      }
  }
  ```
  The corresponding  to sale model
  ```php
  class Sale extends Model
  {
      public $timestamps = false;//no timestamps on DB
      public function books()
      {
          return $this->belongsToMany('App\Book','sale_books')->withPivot('num_books','book_curr_val');
      }
  }
  ```
  Then create only a migration for many to many table which is called `sale_books`.

  `php artisan make:migration CreateSale_booksTable --create=sale_books`


  Now for migrations add the corresponding Schema for each migration:

  Books:
  ```php
  Schema::create('books', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('avaliable');
      $table->string('name');
      $table->string('author');
      $table->string('isbn');
      $table->date('publication');
      $table->decimal('value', 5, 2);
      $table->integer('total_sales');
  });
  ```
  Sales:

  ```php
  Schema::create('sales', function (Blueprint $table) {
    $table->increments('id');
    $table->date('dateofsale');
    $table->decimal('amount', 5, 2);
  });
  ```
  Sale_books:

  ```php
  Schema::create('sale_books', function (Blueprint $table) {
      $table->integer('sale_id')->unsigned();
      $table->integer('book_id')->unsigned();
      $table->integer('num_books');
      $table->decimal('book_curr_val', 5, 2);
      $table->foreign('sale_id')->references('id')->on('sales');
      $table->foreign('book_id')->references('id')->on('books');

  });
  ```
  You can check the created seeds at folder `database\migrations\`

  Execute migrations:

  `php artisan migrate`

  Now there is a database created.
### 2. Seeds
  Laravel uses seeds to add information to the database. Artisan has this functionality, below are the commands used to create the seeds:

  `php artisan make:seeder BooksTableSeeder`

  `php artisan make:seeder SalesTableSeeder`

  You can check the created seeds at folder `database\seeds\`

  When the seeds are finished, use artisan to execute the seeds:

  `php artisan db:seed --class=BooksTableSeeder`

  `php artisan db:seed --class=SalesTableSeeder`


### 3. Controllers

  To create a REST API, Laravel has routes and controller to make it easy.

  Use artisan to create Controllers:

  `php artisan make:controller BookController`
  `php artisan make:controller SaleController`


  The file of routes is in  `app\Http\routes.php` and contains:
  ```php
  Route::get('/', function () { return view('booksales');});
  Route::get('/sale/book/{id}', 'SaleController@salesByBook');
  Route::resource('sale', 'SaleController', ['only' => ['index','store','show']]);
  Route::get('book/admin', function () { return view('bookadmin');});
  Route::resource('book', 'BookController', ['only' => ['index','store','show','update','destroy']]);
  ```


  See the route listing:

  `php artisan route:list`

  ```
  +--------+-----------+----------------+--------------+-------------------------------------------------+------------+
  | Domain | Method    | URI            | Name         | Action                                          | Middleware |
  +--------+-----------+----------------+--------------+-------------------------------------------------+------------+
  |        | GET|HEAD  | /              |              | Closure                                         | web        |
  |        | GET|HEAD  | book           | book.index   | App\Http\Controllers\BookController@index       | web        |
  |        | POST      | book           | book.store   | App\Http\Controllers\BookController@store       | web        |
  |        | GET|HEAD  | book/admin     |              | Closure                                         | web        |
  |        | GET|HEAD  | book/{book}    | book.show    | App\Http\Controllers\BookController@show        | web        |
  |        | PUT|PATCH | book/{book}    | book.update  | App\Http\Controllers\BookController@update      | web        |
  |        | DELETE    | book/{book}    | book.destroy | App\Http\Controllers\BookController@destroy     | web        |
  |        | GET|HEAD  | sale           | sale.index   | App\Http\Controllers\SaleController@index       | web        |
  |        | POST      | sale           | sale.store   | App\Http\Controllers\SaleController@store       | web        |
  |        | GET|HEAD  | sale/book/{id} |              | App\Http\Controllers\SaleController@salesByBook | web        |
  |        | GET|HEAD  | sale/{sale}    | sale.show    | App\Http\Controllers\SaleController@show        | web        |
  +--------+-----------+----------------+--------------+-------------------------------------------------+------------+


  ```

  #Advice:
  To avoid some security go to the file `app\Http\Middleware\VerifyCsrfToken.php`. And add the craeted routes to `$except` list.

  ```php
  class VerifyCsrfToken extends BaseVerifier
  {
  protected $except = ['book*', 'sale*'];
  }
  ```
### 4. Testing with PhpUnit

  To test using PhpUnit, first check if PhpUnit is avaliable:

  `/vendor/bin/phpunit --version`

  You shall see:

  `PHPUnit 4.8.24 by Sebastian Bergmann and contributors.`

  Then through artisan create a test for Book:

  `php artisan make:test BookApiTest`

  To check and modify the file go to `/test/BookApiTest.php`

  Then through artisan create a test for Sale:

  `php artisan make:test SaleApiTest`

  To check and modify the file go to `/test/SaleApiTest.php`/

  To execute the Test call PhpUnit:

  `/vendor/bin/phpunit`
