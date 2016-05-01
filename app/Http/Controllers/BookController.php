<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
//use Illuminate\Http\Response;
//use Illuminate\Contracts\Routing\ResponseFactory;

use App\Http\Requests;
use App\Book;

class BookController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
      //$books = Book::find(22);
      $books = Book::all();

      //$books->increment('avaliable', 5,[ 'value' => $books->value - 5]);
      return response()->json($books, 200);

      //return response()->json($books->sales()->get(), $statusCode);

  }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {

  }
  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'avaliable' => 'required|numeric',
      'name' => 'required|max:255',
      'author' => 'required|max:255',
      'isbn' => 'required|alpha_num|max:15',
      'publication' => 'required|date',
      'value' => 'required|regex:/^\s*-?[1-9]\d*(\.\d{1,2})?\s*$/'
    ]);

    if ($validator->fails()) {
          //  return redirect('post/create')->withErrors($validator)->withInput();
          return response()->json('Incomplete',409);
          //return response()->json($validator->valid(),409);

    }
    else{
      $book = new Book;
      $book->avaliable  = $request->input('avaliable');
      $book->name       = $request->input('name');
      $book->author     = $request->input('author');
      $book->isbn       = $request->input('isbn');
      $book->publication= $request->input('publication');
      $book->total_sales= 0;
      //value must be greater than Cero
        if(floatval($request->input('value'))>0){
          $book->value      = $request->input('value');
        }
        else{
        $book->value =1;
        }

      $book->save();
      return response()->json('Created',201);
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
    $book = Book::find($id);
    $statusCode = 200;
    return response()->json($book, $statusCode);
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
  public function update(Request $request,$id)
  {
    $book = Book::find($id);
    if (!empty((array) $book)) {
      if($request->has('avaliable'))  $book->avaliable   = $request->input('avaliable');
      if($request->has('name'))       $book->name        = $request->input('name');
      if($request->has('author'))     $book->author      = $request->input('author');
      if($request->has('isbn'))       $book->isbn        = $request->input('isbn');
      if($request->has('publication'))$book->publication = $request->input('publication');
      if($request->has('value')){
        //value must be greater than Cero
          if (floatval($request->input('value'))>0)$book->value    = $request->input('value');
      }
      $book->save();
      return response()->json('Success',200);
    }else
      return response()->json('Book not found',404);
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    $book = Book::find($id);
    if (!empty((array) $book)) {
      $foreing= (array) $book->sales()->first();
      //Check for foreing keys
      if(empty($foreing)){
        $book->delete();
        return response()->json('Success',200);
      }
      else{
        return response()->json('Delete Conflict ',409);
      }

    }
    else
      return response()->json('Book not found',404);
  }
}
