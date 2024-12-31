<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
    public function store(Request $request)
    {
        // Validate incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'short_description' => 'nullable|string|max:255',
            'long_description' => 'nullable|string',
            'price' => 'required|numeric',
            'status' => 'required|boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image files
        ]);

        $uploadedImages = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('uploads/services', 'public');
                $uploadedImages[] = $path;
            }
        }

        // Save the service
        $validatedData['images'] = json_encode($uploadedImages);
        Service::create($validatedData);

        return redirect()->route('admin.service.index')->with('message', 'Service created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($service_id)
    {
        $serviceData = Service::findOrFail($service_id);
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
            'short_description' => 'nullable|string|max:255',
            'long_description' => 'nullable|string',
            'price' => 'required|numeric',
            'status' => 'required|boolean',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image files
        ]);

        $uploadedImages = json_decode($service->images, true) ?? [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('uploads/services', 'public');
                $uploadedImages[] = $path;
            }
        }

        // Update service
        $validatedData['images'] = json_encode($uploadedImages);
        $service->update($validatedData);

        return redirect()->route('admin.service.index')->with('message', 'Service updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        // Delete images from storage
        $images = json_decode($service->images, true) ?? [];
        foreach ($images as $image) {
            Storage::disk('public')->delete($image);
        }

        $service->delete();

        return response()->json([
            'success' => true,
            'message' => 'Service deleted successfully.',
        ]);
    }
}
