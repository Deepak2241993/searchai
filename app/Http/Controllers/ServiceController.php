<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Service::where('status', 1)->paginate(5); 

        return view('admin.service.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.service.create')->with('pageTitle', 'Create Service');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request,Service $service)
    {
        $data=$request->all();
        $service->create($data);
        return redirect()->route('admin.service.index')->with('message','Services Created Successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($service_id)
    {
        $serviceData=Service::where('status','1')->find($service_id);
        return view('admin.service.create', compact('serviceData'))->with('pageTitle', 'Edit Service');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
        ]);
        $service->update($validatedData);

        // Redirect with a success message
        return redirect()->route('admin.service.index')->with('message', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        // Return a success response
        return response()->json([
            'success' => true,
            'message' => 'Service deleted successfully.',
        ]);
    }
}
