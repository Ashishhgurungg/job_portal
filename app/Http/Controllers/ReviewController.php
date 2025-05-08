<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Auth;

class ReviewController extends Controller
{

    public function review()
    {
        return view('create_review');
    }

    public function createReview(Request $request)
    {
        $request->validate([
            'review'=>['required', 'string'],
            'status'=>['required']
        ]);

        $review = $request->review;
        $status = $request->status;

        Review::create([
            'user_id'=>Auth::id(),
            'review'=>$review,
            'status'=>$status

        ]);

        return redirect('/dashboard')->with('review', 'Review given successfully');
    }

    public function viewReview()
    {
        $reviews = Review::simplePaginate(3);
        return view('reviews', ['reviews'=>$reviews]);
    }

    public function reviewDetails(Request $request)
    {
        $review_id = $request->id;
        $reviews = Review::where('id', $review_id)->get();
        return view('review_details',['reviews'=>$reviews]);
    }

    public function detailsEdit(Request $request)
    {
        
         $validatedData = $request->validate([
            'id' => 'required|integer|exists:reviews,id',
            'status' => 'required',
        ]);
    
        
        $review = Review::findOrFail($validatedData['id']);
    
       
        $review->update([
            'status' => $validatedData['status'],
        ]);
    
       
        return redirect()->route('reviews')
        ->with('changed', 'review status updated successfully.');
    }

    public function deleteReview(Request $request)
    {
        $review_id = $request->id;
        $review = Review::find($review_id);
        $review->delete();
        return redirect()->route('reviews')->with('deleter', 'review deleted successfully');
    }
}
