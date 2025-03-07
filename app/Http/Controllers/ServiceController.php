<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Service::where('status', 1)->paginate(10);
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
        'service_slug' => 'required|unique:services,service_slug',
        'short_description' => 'nullable|string|max:255',
        'long_description' => 'nullable|string',
        'price' => 'required|numeric',
        'status' => 'required|boolean',
        'image' => [
            'nullable',
            'array', // Ensure it's an array if multiple files are uploaded
            function ($attribute, $value, $fail) use ($request) {
                if ($request->hasFile('image')) {
                    foreach ($request->file('image') as $image) {
                        $sizeInKB = $image->getSize() / 1024;
                        if ($sizeInKB < 10) {
                            $fail('Each ' . $attribute . ' must be at least 10 KB.');
                        }
                    }
                }
            },
        ],
        'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120', // Validate each image file
    ]);
    // Correct way to add tax to validated data
    $validatedData['tax'] = $request->input('tax');
    $product_image = [];

    if ($request->hasFile('images')) {  // Corrected input name from 'images' to 'image'
        $folder = "services";
        $destinationPath = '/uploads/' . $folder . "/";

        foreach ($request->file('images') as $image) {
            // Generate unique filename to avoid conflicts
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path($destinationPath), $filename);

            // Store the uploaded image URL
            $product_image[] = url($destinationPath . $filename);
        }

        // Combine the image URLs into a single string separated by "|"
        $validatedData['images'] = implode('|', $product_image);
    }

    // Remove unnecessary fields from request data
    unset($validatedData['_token']);

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
        // dd($request->all());
        // Validate incoming data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'service_slug' => 'required|unique:services,service_slug,' . $service->id,
            'short_description' => 'nullable|string|max:255',
            'long_description' => 'nullable|string',
            'price' => 'required|numeric',
            'status' => 'required|boolean',
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:5120', // Max size in KB (5 MB)
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->hasFile('image')) {
                        $sizeInKB = $request->file('image')->getSize() / 1024;
                        if ($sizeInKB < 10) {
                            $fail('The ' . $attribute . ' must be at least 10 KB.');
                        }
                    }
                },
            ],
        ]);
        
        // Correct way to add tax to validated data
        $validatedData['tax'] = $request->input('tax');
        
        $product_image = [];

    if ($request->hasFile('images')) {  // Corrected input name from 'images' to 'image'
        $folder = "services";
        $destinationPath = '/uploads/' . $folder . "/";

        foreach ($request->file('images') as $image) {
            // Generate unique filename to avoid conflicts
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path($destinationPath), $filename);

            // Store the uploaded image URL
            $product_image[] = url($destinationPath . $filename);
        }

        // Combine the image URLs into a single string separated by "|"
        $validatedData['images'] = implode('|', $product_image);
    }
   
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
    public function getSlug(Request $request)
    {
        $slug = Str::slug($request->title);
        return response()->json(['status' => true, 'slug' => $slug]);
    }
    public function show($slug)
    {
        $services = Service::where('service_slug', $slug)->get();
        return view('frontend.services', compact('services'));
    }

}
