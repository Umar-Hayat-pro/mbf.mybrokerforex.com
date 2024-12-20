<?php
   
namespace App\Http\Controllers;
   
use Illuminate\Http\Request;
use App\Models\Ibform;
   
class IbController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('IbForm');
    }
   
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10|numeric',
            'subject' => 'required',
            'message' => 'required'
        ]);
   
        Contact::create($request->all());
   
        return redirect()->back()
                         ->with(['success' => 'Thank you for contacting us. We will get back to you shortly.']);
    }
}