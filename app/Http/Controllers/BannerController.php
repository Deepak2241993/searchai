<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Banner::where('status',1)->paginate(5);
        return view('admin.banner.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.create')->with('pageTitle', 'Create Banner');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Banner $banner)
    {
        // Validate the input data
        $validatedData = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'      => 'required|boolean',
            'order'       => 'required|integer',
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName(); // Generate a unique filename
            $path = $image->storeAs('banners', $filename, 'public'); // Store the file with the desired name
            $validatedData['image'] = $filename; // Save only the filename in the database
        }

        // Create a new banner
        $banner->create($validatedData);

        // Redirect to the index route with a success message
        return redirect()->route('admin.banner.index')->with('message', 'Banner Created Successfully');
    }
    

    /**
     * Display the specified resource.
     */
    public function show(banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($banner_id)
    {
        $bannerData=Banner::where('status','1')->find($banner_id);
        return view('admin.banner.create', compact('bannerData'))->with('pageTitle', 'Edit Banner');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Banner $banner)
    {
        $validatedData = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status'      => 'required|boolean',
            'order'       => 'required|integer',
        ]);

        // Update basic fields
        $banner->title = $validatedData['title'];
        $banner->description = $validatedData['description'];
        $banner->status = $validatedData['status'];
        $banner->order = $validatedData['order'];

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Delete the existing image if it exists
            if ($banner->image && Storage::exists('public/banners/' . $banner->image)) {
                Storage::delete('public/banners/' . $banner->image);
            }

            // Store the new image with a unique name
            $image = $request->file('image');
            $filename = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('banners', $filename, 'public'); // Store with custom filename

            $banner->image = $filename; // Save only the filename
        }

        // Save the updated banner
        $banner->save();

        return redirect()->route('admin.banner.index')->with('success', 'Banner updated successfully!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        if ($banner->image && Storage::exists($banner->image)) {
            Storage::delete($banner->image);
        }
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully!');
    }

}
