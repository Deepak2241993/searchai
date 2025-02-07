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
        $folder = 'banners';  // You can modify this folder name as needed
        $destinationPath = public_path('/uploads/' . $folder . '/');

        // Ensure the directory exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        $file = $request->file('image');
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Move the file to the custom path
        $file->move($destinationPath, $fileName);

        // Save the relative path to the database
        $validatedData['image'] = '/uploads/' . $folder . '/' . $fileName;
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

    // Update banner fields
    $banner->title = $validatedData['title'];
    $banner->description = $validatedData['description'];
    $banner->status = $validatedData['status'];
    $banner->order = $validatedData['order'];

    // Handle the image upload
    if ($request->hasFile('image')) {
        $folder = 'banners';
        $destinationPath = public_path('/uploads/' . $folder . '/');

        // Ensure the directory exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }

        // Delete the old image if it exists
        if ($banner->image && file_exists(public_path($banner->image))) {
            unlink(public_path($banner->image));
        }

        $file = $request->file('image');
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Move the new file to the custom path
        $file->move($destinationPath, $fileName);

        // Save the new relative path to the database
        $banner->image = '/uploads/' . $folder . '/' . $fileName;
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