<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'client_id' => 'required|uuid|unique:comments,client_id',
            'email' => 'required|email|unique:comments,email',
            'phone_number' => 'nullable|string',
            'name' => 'required|string',
            'comment' => 'required|string|max:1000',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Create a new comment
        $comment = new Comment([
            'client_id' => $request->input('client_id'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'name' => $request->input('name'),
            'comment' => $request->input('comment'),
        ]);

        $comment->save();

        return response()->json(['message' => 'Comment created successfully'], 201);
    }

    public function index()
    {
        // Get all comments
        $comments = Comment::all();
        foreach($comments as $comment) {
            $filterComments[]  = array(
                'id' => encrypt($comment->id),
                'client_id' => $comment->client_id,
                'email' => $comment->email,
                'phone_number' => $comment->phone_number,
                'name' => $comment->name,
                'comment' => $comment->comment,
                'created_at' => $comment->created_at,
                'updated_at' => $comment->updated_at,
            );
        }
        
        return response()->json(['data' => $filterComments]);
    }


    public function show($id)
    {
        // Get a single comment by ID
        try {
            $id =  decrypt($id);
            $comment = Comment::find($id);

            if (!$comment) {
                return response()->json(['error' => 'Comment not found'], 404);
            }
            return response()->json(['data' => $comment]);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Something went wrong'], 400);
        }
        
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        try {
            $id =  decrypt($id);
            $validator = Validator::make($request->all(), [
                'client_id' => 'required|uuid|unique:comments,client_id,'.$id,
                'email' => 'required|email|unique:comments,email,'.$id,
                'phone_number' => 'nullable|string',
                'name' => 'required|string',
                'comment' => 'required|string|max:1000',
            ]);
            
            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()], 400);
            }
            
            // Update the comment

            $comment = Comment::find($id);
    
            if (!$comment) {
                return response()->json(['error' => 'Comment not found'], 404);
            }
    
            $comment->update($request->all());
    
            return response()->json(['message' => 'Comment updated successfully']);

        } catch (\Throwable $th) {
             return response()->json(['error' => 'Something went wrong'], 400);
        }
        
    }

    public function destroy($id)
    {
        // Delete a comment by ID
        try {
            $id =  decrypt($id);
            $comment = Comment::find($id);
            $comment->delete();
            return response()->json(['message' => 'Comment deleted successfully']);
        if (!$comment) {
            return response()->json(['error' => 'Comment not found'], 404);
        }
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Something went wrong'], 400);
        }
    }
}
