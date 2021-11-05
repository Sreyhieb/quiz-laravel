<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;
class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Author::with('user')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $author = new Author();
        $author->name=$request->name;
        $author->age=$request->age;
        $author->province=$request->province;
        $author->save();

        return response()->json(['sms'=>'created!'],201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Author::findOrFail($id);
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
        //
        $author = new Author();
        $author->name=$request->name;
        $author->age=$request->age;
        $author->province=$request->province;
        $author->save();

        return response()->json(['sms'=>'updated!'],200);


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $author = Author::destroy($id);
        if($author == 1){
            return response()->json(['message' => 'delete succesfully'], 200);
        }else{
            return response()->json(['message' => 'cannot delete no id' ], 404);
        }

    }
}