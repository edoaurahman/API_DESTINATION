<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new Comment();
        $comment->destination_id = $request->destination_id;
        $comment->user_id = $request->user_id;
        $comment->comment = $request->comment;
        $comment->rating = $request->rating;

        if ($comment) {
            $comment->save();
            return response()->json(['message' => 'Comment created successfully.']);
        }else{
            return response()->json(['message' => 'Comment not created.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    
     public function getByDestinationId($id){
        $comments = Comment::where('destination_id', $id)->with('user')->latest()->get();
        return response()->json($comments);
     }
}
