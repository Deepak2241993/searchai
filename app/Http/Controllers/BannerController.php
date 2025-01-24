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
            'image'       => [
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
            'status'      => 'required|boolean',
            'order'       => 'required|integer',
        ]);
        
    
        // Handle the image upload
        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('banners', 'public'); // Save the image in the "banners" directory on the public disk
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
            'image'       => [
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
            'status'      => 'required|boolean',
            'order'       => 'required|integer',
        ]);
        $banner->title = $validatedData['title'];
        $banner->description = $validatedData['description'];
        $banner->status = $validatedData['status'];
        $banner->order = $validatedData['order'];
        if ($request->hasFile('image')) {
            if ($banner->image && Storage::exists($banner->image)) {
                Storage::delete($banner->image);
            }
            $banner->image = $request->file('image')->store('banners', 'public');
        }
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
