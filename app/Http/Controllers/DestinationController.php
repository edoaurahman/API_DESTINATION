<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Destination;
use App\Models\Image_Destionation;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
        
    public function store(Request $request)
    {
        $destination = new Destination();
        $destination->destination_name = $request->destination_name;
        $destination->description = $request->description;
        $destination->facility = $request->facility;
        $destination->type = $request->type;

        if ($destination) {
            $destination->save();

            $image = new Image_Destionation();
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $image->image_name = $fileNameWithExt;
            $image->destination_id = $destination->id;
            //move upload file
            $destinationPath = 'images/destination/';
            $request->file('image')->move($destinationPath, $fileNameWithExt);
            $image->save();
           
            return response()->json([
                'message' => 'Destination created successfully',
            ],200);
        }
    }

    public function update(Request $request)
    {
        $destination = Destination::find($request->id);
        $destination->destination_name = $request->destination_name;
        $destination->description = $request->description;
        $destination->facility = $request->facility;
        $destination->type = $request->type;

        if ($destination) {
            $destination->save();
            return response()->json([
                'message' => "Update Destination Success"
            ]);
        }
    }

    public function get(){
        $destination = Destination::with('Image')->latest()->get();
        return response()->json($destination);
    }

    public function destroy($id){
        $destination = Destination::find($id);
        $comment = Comment::where('destination_id', $id);
        $image = Image_Destionation::where('destination_id', $id);
        $comment->delete();
        $image->delete();
        $destination->delete();
        return response()->json([
            'message' => "Delete Destination Success"
        ]);
    }

    public function addImageDestination(Request $request){
        $image = new Image_Destionation();
        $fileNameWithExt = $request->file('image')->getClientOriginalName();
        $image->image_name = $fileNameWithExt;
        $image->destination_id = $request->destination_id;
        //move upload file
        $destinationPath = 'images/destination/';
        $request->file('image')->move($destinationPath, $fileNameWithExt);
        if ($image) {
            $image->save();
            return response()->json([
                'message' => "Add Image Success"
            ]);
        }
    }

    public function getByName($slug){
        $destination = Destination::with('Image')->where('destination_name',$slug)->first();
        return response()->json($destination);
    }

    public function getTrendingTours(){
        $destination = Destination::with('Image')->where('type','trending_tours')->get();
        return response()->json($destination);
    }

    public function getTopDestinations(){
        $destination = Destination::with('Image')->where('type','top_destinations')->get();
        return response()->json($destination);
    }
}
