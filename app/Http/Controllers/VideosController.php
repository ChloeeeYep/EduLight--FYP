<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Videos;  
use App\Models\Instructor;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;



class VideosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($courseId)
    {
        // Assuming status '1' indicates that the course is active or available.
        $course = Course::where('id', $courseId)->where('status', 1)->firstOrFail();
        
        return view('createvideo', compact('course','courseId'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation
        $validated = Validator::make($request->all(), [
            'courseId' => 'required|exists:courses,id',
            'session' => 'required|string|max:255',
            'video' => 'required|file|mimes:mp4', // max 10MB
        ]);

        if ($validated->fails()) {
            return back()->withErrors($validated)->withInput();
        }

        // Store the video file and get the path
        $videoPath = $request->file('video')->store('user_video', 'public'); // Adjust 'videos' and 'public' as needed

        // Create the video record
        $video = new Videos();
        $video->courseId = $request->input('courseId');
        $video->session = $request->input('session');
        $video->video = $videoPath;
        $video->save();

        // Redirect after saving with a success message
        return redirect()->to('/courses/' . $request->input('courseId') . '/videos/create')->with('success', 'Video Uploaded Successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($videoId)
    {
        // Retrieve the video based on the videoId
        $video = Videos::find($videoId);

        $courseId = $video->course->id;
       
        // Pass the video to the view
        return view('editvideo', compact('video','courseId'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $videoId)
    {
        // Validation
        $validated = Validator::make($request->all(), [
            'session' => 'required|string|max:255',
            'video' => 'sometimes|file|mimes:mp4|max:10000', 
        ]);

        if ($validated->fails()) {
            return back()->withErrors($validated)->withInput();
        }

        // Retrieve the video record
        $video = Videos::findOrFail($videoId);

        // Update session
        $video->session = $request->input('session');

        try {
            // Check if a new video file is uploaded
            if ($request->hasFile('video')) {
                // Store the new video file and get the path
                $videoPath = $request->file('video')->store('user_video', 'public');
    
                // Update video path if a new video is uploaded
                $video->video = $videoPath;
            }
    
            // Save the video record
            $video->save();
    
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->withErrors('There was an error updating the video.')->withInput();
        }
    
        // Redirect after updating with a success message
        return redirect()->route('video', ['course' => $video->courseId])
            ->with('success', 'Video Updated Successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($videoId)
    {
        try {
            // Retrieve the video record
            $video = Videos::findOrFail($videoId);
            
            // Store the courseId before deleting the video
            $courseId = $video->courseId;
            
            // Delete the video
            $video->delete();

            // Redirect to the 'showvideo' route with success message
            return redirect()->route('video', ['course' => $courseId])
                ->with('success', 'Video Deleted Successfully!');

        } catch (\Exception $e) {
            // If there's an exception, log it and redirect back with an error message.
            Log::error($e->getMessage());
            return back()->withErrors('There was an error deleting the video.');
        }
    }

    public function showCourseDetail(Course $item)
    {
        $videos = $item->videos;

        // Check if the course is active before proceeding
        if ($item->status == 0) {
            return redirect()->route('userorder')->with('error', 'Sorry, the requested course is not available.');
        }

        // Retrieve all instructors from the database
        $instructors = Instructor::all(); 

        // Retrieve instructor details using a safe method that avoids errors if not found
        $instructorName = $instructors->firstWhere('id', $item->instructor)->name ?? 'Instructor not found';

        // Get the enrollment count for the current course
        $enrollmentCount = $this->getEnrollmentCount($item->id);

        // Pass the necessary data to the view
        return view('coursedetailpurchase', compact(
             'item', 'instructorName','enrollmentCount','videos'
        ));
    }

    public function getEnrollmentCount($courseId)
    {
        // Ensure that there are no trailing spaces in the column names
        $enrollmentCount = OrderItem::where('courseId', $courseId)
                                    ->distinct('orderId')
                                    ->count('orderId');
        return $enrollmentCount;
    }

}
