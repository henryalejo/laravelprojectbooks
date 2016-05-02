<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Sale;
use App\Book;
use Carbon\Carbon;
use Validator;

class SaleController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $sale = Sale::All();
    return response()->json($sale, 200);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    //books json array validation
    $rules = [];
    foreach($request->books as $key => $val)
    {
      $rules['books.'.$key.'.id'] = 'required|numeric';
      $rules['books.'.$key.'.num_books'] = 'required|numeric';
    }

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
          //  return redirect('post/create')->withErrors($validator)->withInput();
          //return response()->json('Incomplete',409);
          return response()->json('Bad Request',400);
    }
    else{
      //creation fo new sale
      $sale = new Sale;
      $sale->dateofsale  = Carbon::now();
      $sale->amount =0;
      $sale->save();
      //$request is an array of books adding books to the sale
      foreach ($request->books as $book) {
        $tempBook = Book::find($book['id']);
        $sale->books()->save($tempBook,['num_books'=> $book['num_books'],'book_curr_val'=> $tempBook->value ]);
        $sale->amount = $sale->amount + ($tempBook->value * $book['num_books'] );
        $tempBook->increment('total_sales', $book['num_books'],[ 'avaliable' => $tempBook->avaliable - $book['num_books']]);
      }
      //save amount of sale
      $sale->save();
      //$book->increment('avaliable', 5,[ 'value' => $books->value - 5]);
      return response()->json('SaleCreated',201);
      //return response()->json($request[0]['id'],201);

    }

  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {

    $validator = Validator::make([$id],['numeric']);
    if ($validator->fails()){
      return response()->json('Bad request: invalid id', 400);
    }
    else{
      $sale = Sale::find($id);
      if (!empty($sale))
      return response()->json($sale->books()->get(), 200);
      else return response()->json('Bad request: invalid id', 400);
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
      //
  }
}
