<?php

namespace App\Http\Controllers\Admin;

use App\Models\Deposit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    // Store a new comment in the deposits table
    public function store(Request $request, $deposit_id)
    {
        $request->validate([
            'comment' => 'nullable|string',
        ]);
    
        // Find the deposit by ID
        $deposit = Deposit::findOrFail($deposit_id);
    
        // Decode the current comments from JSON to an array, or initialize as an empty array if null
        $currentComments = json_decode($deposit->comment, true) ?: [];
    
        // Append the new comment to the array
        $currentComments[] = $request->comment;
    
        // Encode the comments array back to JSON and save
        $deposit->comment = json_encode($currentComments);
        $deposit->save();
    
        // Notify the user
        $notify = ['success', 'Comment Added Successfully'];
        return redirect()->back()->withNotify($notify);
    }
    
       // Show the comments for a specific deposit
       public function show($deposit_id)
       {
           $deposit = Deposit::findOrFail($deposit_id);
   
           return view('admin.deposits.show', compact('deposit'));
       }
}
