<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Http\Resources\BookResource;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return BookResource::collection(Book::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'min:3|max:10',
            'body' => 'min:3|max:50'
        ]);
        $book = new Book();
        $book->author_id = $request->author_id;
        $book->title = $request->title;
        $book->body = $request->body;
        $book->save();

        return response()->json(["Message" => "Book Created", "data" => $book], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Book::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'min:3|max:10',
            'body'=>'min:3|max:50',
        ]);
        $book = Book::findOrFail($id);
        $book->title = $request->title;
        $book->body = $request->body;

        $book->save();
        return response()->json(['massage'=>' Book Update', 'data'=> $book], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $isDeleted = Book::destroy($id);
        if($isDeleted == 1){
            return response()->json(['massage'=>' Book Deleted'], 200);
        }else{
            return response()->json(['massage'=>'ID already exit'], 404);
        }
    }
}