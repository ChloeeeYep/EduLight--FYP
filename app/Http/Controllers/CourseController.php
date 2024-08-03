<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course; 
use App\Models\News; 
use App\Models\Instructor;
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Str;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Videos;


class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::where('status', 1)->get(); 
        return view ('course')->with('courses',$courses);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $instructors = Instructor::all(); // Retrieve all instructors from the database
        return view('createcourse', compact('instructors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    { 
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|min:1',
            'instructor' => 'required',
            'type' => 'required',
            'level' => 'required|min:1',
            'lesson' => 'required',
            'language' => 'required',
            'learn1' => 'required',
            'learn2' => 'required',
            'learn3' => 'required',
        ]);

        $input = $request->all();
        $input['price'] = $request->input('price', 0);
        $input['duration'] = $request->input('duration', 1);
        $input['lesson'] = $request->input('lesson', 1);

        if($photo = $request->file('photo')) {
            $destinationPath = 'images/';
            $courseImage = date('YmdHis') . "." . $photo->getClientOriginalExtension();
            $photo->move($destinationPath,$courseImage);
            $input['photo'] = $courseImage;
        }

        Course::create($input);
        return redirect('course')->with('success','Course Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $item, Order $order)
    {        
        if ($item->status == 0) {
            return redirect()->route('adminhome')->with('error', 'Sorry, the requested course is not available.');
        }
    
        $instructors = Instructor::all(); // Retrieve all instructors from the database
        $instructorName = $instructors->firstWhere('id', $item->instructor)->name ?? 'Instructor not found';
        return view('showcourse', compact('item', 'instructorName')); // Removed the space after 'instructorName'
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $item)
    {
        $instructors = Instructor::all(); // Retrieve all instructors from the database
        return view('editcourse',compact('item','instructors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $item)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required',
            'duration' => 'required',
            'instructor' => 'required',
            'type' => 'required',
            'level' => 'required',
            'lesson' => 'required',
            'language' => 'required',
            'learn1' => 'required',
            'learn2' => 'required',
            'learn3' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $input = $request->all();

        if ($photo = $request->file('photo')) {
            $destinationPath = 'images/';
            $courseImage = date('YmdHis') . "." . $photo->getClientOriginalExtension();
            $photo->move($destinationPath, $courseImage);
            $input['photo'] = $courseImage;
        } else {
            unset($input['photo']);
        }

        try {
            \DB::beginTransaction();

            // Update the course with new details
            $item->update($input);

            // Retrieve all cart items linked to this course and update them
            CartItem::where('courseId', $item->id)
                    ->update([
                        'courseName' => $input['title'],
                        'courseLevel' => $input['level'],
                        'coursePrice' => $input['price'],
                    ]);

            \DB::commit();
            return redirect('course')->with('success', 'Course Updated Successfully!');
        } catch (\Exception $e) {
            \DB::rollback();
            Log::error($e->getMessage());
            return back()->withErrors('There was an error updating the course and cart items.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Course $item)
    {
        try {
            \DB::beginTransaction();

            // Update the status of the course instead of deleting it
            $item->update(['status' => 0]);

            \DB::commit();
            return redirect('course')->with('success', 'Course Deleted Successfully!');
        } catch (\Exception $e) {
            \DB::rollback();
            Log::error($e->getMessage());
            return back()->withErrors('There was an error deleteing the course.');
        }
    }


    public function search(Request $request)
    {
        $searchQuery = $request->query('query', '');
        $query = Course::where('status', 1); // Initialize the query to only include active courses.

        if ($searchQuery) {
            // The query will now only return courses with a 'status' of 1 that match the search criteria.
            $courses = $query->where(function ($query) use ($searchQuery) {
                        $query->where('title', 'LIKE', "%{$searchQuery}%")
                            ->orWhere('level', 'LIKE', "%{$searchQuery}%");
                    })->get();
        } else {
            // If there's no search query, it will return all active courses.
            $courses = $query->get();
        }

        return view('course', compact('courses', 'searchQuery'));
    }



    public function filter(Request $request)
    {
        $sortOrder = $request->query('sort');

        // Start the query with a condition to only include courses with 'status' of 1
        $query = Course::where('status', 1);

        // Apply the sort order if provided
        if ($sortOrder == 'price-asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sortOrder == 'price-desc') {
            $query->orderBy('price', 'desc');
        }

        // Get the results of the query
        $courses = $query->get();

        return view('course', compact('courses'));
    }


    public function home() 
    {
        $cours4 = Course::where('status', 1)->latest()->take(4)->get();
        $news3 = News::latest()->take(3)->get(); 
        
        $enrollmentCounts = [];
        foreach ($cours4 as $course) {
            $enrollmentCounts[$course->id] = $this->getEnrollmentCount($course->id);
        }
    
        return view('home', compact('cours4', 'news3', 'enrollmentCounts')); 
    }
    

    public function showCourse(Request $request) 
    {     
        $courses = Course::where('status', 1)->get(); // Fetch  courses is active

        // Initialize an array to hold enrollment counts
        $enrollmentCounts = [];

        foreach ($courses as $course) {
            $enrollmentCounts[$course->id] = $this->getEnrollmentCount($course->id);
        }

        $currentLevel = $request->query('level', 'Level');
        $currentLanguage = $request->query('language', 'Language');

        $cours4 = Course::latest()
                        ->where('status', 1)  // Only consider active courses
                        ->take(4)
                        ->get();

        // Pass the courses and their enrollment counts to the view
        return view('usercourse', compact('cours4','courses', 'enrollmentCounts', 'currentLevel', 'currentLanguage'));
    }

    public function showvideo(Request $request, $courseId) 
    {
        $course = Course::findOrFail($courseId);

        // Retrieve videos related to the courseId
        $videos = Videos::where('courseId', $courseId)->get();
    
        // Pass the videos to the view
        return view('video', compact('course', 'videos'));
    }
    

    public function showCourseDetail(Course $item)
    {
        // Check if the course is active before proceeding
        if ($item->status == 0) {
            return redirect()->route('userorder')->with('error', 'Sorry, the requested course is not available.');
        }

        // Fetch 4 random courses excluding the current course ID
        $cours4 = Course::where('status', 1)
                        ->where('id', '!=', $item->id) // Exclude the current course
                        ->inRandomOrder() // Fetch in random order
                        ->take(4)
                        ->get();

        // Initialize an array to hold enrollment counts for the 4 courses
        $enrollmentCounts = [];
        foreach ($cours4 as $course) {
            $enrollmentCounts[$course->id] = $this->getEnrollmentCount($course->id);
        }

        // Retrieve all instructors from the database
        $instructors = Instructor::all(); 

        // Retrieve instructor details using a safe method that avoids errors if not found
        $instructorName = $instructors->firstWhere('id', $item->instructor)->name ?? 'Instructor not found';
        $instructorImage = $instructors->firstWhere('id', $item->instructor)->image ?? 'Default image path';
        $instructorTitle = $instructors->firstWhere('id', $item->instructor)->title ?? 'No title available';
        $instructorAbout = $instructors->firstWhere('id', $item->instructor)->about ?? 'No details available';

        // Get the enrollment count for the current course
        $enrollmentCount = $this->getEnrollmentCount($item->id);

        // Pass the necessary data to the view
        return view('usercoursedetail', compact(
            'cours4', 'item', 'instructorName', 'instructorImage', 
            'instructorTitle', 'instructorAbout', 'enrollmentCount', 'enrollmentCounts'
        ));
    }



    public function showinstructors($instructorId)
    {
        $instructor = Instructor::findOrFail($instructorId);

        // Retrieve all active courses taught by the specific instructor
        $courses = Course::where('instructor', $instructorId)
                        ->where('status', 1)
                        ->get();

        $enrollmentCounts = [];

        // Fetch enrollment count for each active course
        foreach ($courses as $course) {
            $enrollmentCounts[$course->id] = $this->getEnrollmentCount($course->id);
        }

        return view('userinstructor', compact('instructor', 'courses', 'enrollmentCounts'));
    }


    public function getEnrollmentCount($courseId)
    {
        // Ensure that there are no trailing spaces in the column names
        $enrollmentCount = OrderItem::where('courseId', $courseId)
                                    ->distinct('orderId')
                                    ->count('orderId');
        return $enrollmentCount;
    }

    public function coursefilter(Request $request)
    {
        // Get the sort and filter options from the query string
        $sortOrder = $request->query('sort', 'price-asc');
        $levelFilter = $request->query('level');
        $languageFilter = $request->query('language');

        $currentLevel = $request->query('level', 'Level');
        $currentLanguage = $request->query('language', 'Language');


        // Start building the query with only active courses
        $query = Course::where('status', 1);

        // Apply sorting based on the sort order
        if ($sortOrder == 'price-asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sortOrder == 'price-desc') {
            $query->orderBy('price', 'desc');
        }

        // Apply filtering based on the level if provided
        if (!empty($levelFilter)) {
            $query->where('level', $levelFilter);
        }

        // Apply filtering based on the language if provided
        if (!empty($languageFilter)) {
            $query->where('language', $languageFilter);
        }

        // Execute the query and get the results
        $courses = $query->get();

        // Initialize an array to hold enrollment counts
        $enrollmentCounts = [];

        foreach ($courses as $course) {
            $enrollmentCounts[$course->id] = $this->getEnrollmentCount($course->id);
        }

        // Return the view with the filtered and sorted courses
        return view('usercourse', compact('courses', 'enrollmentCounts', 'currentLevel', 'currentLanguage'));
    }



} 
