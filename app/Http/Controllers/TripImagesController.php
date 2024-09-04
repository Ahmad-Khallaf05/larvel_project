<?php

namespace App\Http\Controllers;

use App\Models\trip_images;
use Illuminate\Http\Request;

class TripImagesController extends Controller
{

    public function index()
    {

    }


    public function create($tripid)
    {
        //

        return view('dashboard/tripImages.create', compact('tripid'));
    }


    public function store(Request $request, $tripid)
    {
        // Validate the image
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Ensure that an image is required and is of a valid image type
        ]);

        // Handle the image upload
        if ($request->hasFile('image')) {
            // Get the uploaded file
            $file = $request->file('image');

            // Generate a unique filename
            $filename = time() . '.' . $file->getClientOriginalExtension();

            // Define the path where the image will be stored
            $path = public_path('uploads/trip_images/');

            // Move the image to the specified path
            $file->move($path, $filename);

            // Save the image path and trip ID to the database
            trip_images::create([
                'image' => 'uploads/trip_images/' . $filename, // Save the relative path of the uploaded image
                'trip_id' => $tripid, // Save the trip ID
            ]);
        }

        // Redirect to the trips index page
        return redirect()->route('trips.index');
    }



    public function show(trip_images $trip_images)
    {
        //
    }


    public function edit(trip_images $trip_images)
    {
        //
    }


    public function update(Request $request, trip_images $trip_images)
    {
        //
    }


    public function destroy($id)
    {
        // Find the trip image by its ID
        $tripImage = trip_images::find($id);

        // Delete the image file from the server
        if (file_exists(public_path($tripImage->image))) {
            unlink(public_path($tripImage->image));
        }

        // Delete the image record from the database
        $tripImage->delete();

        // Redirect back to the trip details page with a success message
        return redirect()->back()->with('success', 'Image deleted successfully.');
    }

}
