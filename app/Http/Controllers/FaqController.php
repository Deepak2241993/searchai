<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Faq $faq)
    {
        $data = $faq->paginate(5); 
        return view('admin.faq.index', compact('data'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.faq.create')->with('pageTitle', 'Create Faq');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Faq $faq)
    {
        $data=$request->all();
        $faq->create($data);
        return redirect()->route('admin.faq.index')->with('message','FAQs Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Faq $faq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($faq_id)
    {
        $faqData=Faq::where('status','1')->find($faq_id);
        return view('admin.faq.create', compact('faqData'))->with('pageTitle', 'Edit Faq');
    }

    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faq $faq)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
            'status' => 'required|boolean',
        ]);
        $faq->update($validatedData);

        // Redirect with a success message
        return redirect()->route('admin.faq.index')->with('message', 'FAQ updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faq $faq)
    {
        // Delete the FAQ
        $faq->delete();
    
        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'FAQ deleted successfully.',
        ]);
    }    
}
