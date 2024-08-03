<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Scholarship; 
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('login')->with('error', 'You must be logged in to view scholarships.');
        }

        // Fetch all scholarships for the user
        $scholarships = Scholarship::where('userId', $user->id)->get();

        // Group scholarships by type
        $groupedScholarships = $scholarships->groupBy('type');

        // Pass the grouped scholarships to the view
        return view('scholarship', ['groupedScholarships' => $groupedScholarships]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createscholarship');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        log::info($request);
        $user = Auth::user();
        if (!$user) {
            return back()->with('error', 'User not found.');
        }

        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'fundType' => 'required',
            'academic' => 'required',
            'requirement' => 'required',
            'description' => 'required',
            'website' => 'nullable',
            'file' => 'nullable|file|mimes:pdf', 
            'status' => 'required',
        ]);

        // Initialize the input with request data
        $input = $request->except(['userId', 'file']);  // Exclude 'username' and 'file' from input
        $input['userId'] = $user->id; // Set 'id' from the authenticated user
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            // Store the file and retrieve the path
            $filePath = $file->store('user_files', 'public');
            $input['file'] = $filePath; // Add file path to input
        }

        Scholarship::create($input);
        return redirect('scholarship')->with('success','Scholarship Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    /**
 * Display the specified resource.
 */
    public function show($id) 
    {
        $user = Auth::user();

        if (!$user) {
            // If user is not authenticated, redirect to login or give an error message
            return redirect('login')->with('error', 'You must be logged in to view this scholarship.');
        }

        // Retrieve the scholarship only if it belongs to the authenticated user
        $item = Scholarship::where('id', $id)->where('userId', $user->id)->firstOrFail();

        // If the scholarship does not belong to the user, it will throw a 404 exception

        return view('showscholarship', compact('item', 'user'));
    }

    public function edit($id)
    {
        $user = Auth::user();

        if (!$user) {
            // If user is not authenticated, redirect to login or give an error message
            return redirect('login')->with('error', 'You must be logged in to view this scholarship.');
        }

        // Retrieve the scholarship only if it belongs to the authenticated user
        $item = Scholarship::where('id', $id)->where('userId', $user->id)->firstOrFail();

         return view('editscholarship', compact('item', 'user'));
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();

        if (!$user) {
            return back()->with('error', 'You must be logged in to perform this action.');
        }

        // Retrieve the scholarship, ensuring it belongs to the current user
        $scholarship = Scholarship::where('id', $id)->where('userId', $user->id)->first();

        if (!$scholarship) {
            // If no scholarship is found for this user, prevent update
            return back()->with('error', 'Scholarship not found or you do not have permission to update this scholarship.');
        }

        $request->validate([
            'title' => 'required',
            'type' => 'required',
            'fundType' => 'required',
            'academic' => 'required',
            'requirement' => 'required',
            'description' => 'required',
            'website' => 'nullable',
            'file' => 'nullable|file|mimes:pdf',
            'status' => 'required',
        ]);

        // Initialize the input with request data, excluding 'userId' and 'file'
        $input = $request->except(['userId', 'file']);

        // Check if a new file is uploaded
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // If there's an existing file, consider removing it if necessary
            // Storage::delete('public/' . $scholarship->file);

            // Store the new file and retrieve the path
            $filePath = $file->store('user_files', 'public');
            $input['file'] = $filePath;
        }

        // Update the scholarship with new input data
        $scholarship->update($input);

        return redirect('scholarship')->with('success','Scholarship Updated Successfully!');
    }

     /**
     * Remove the specified resource from storage.
     */
   /**
 * Remove the specified resource from storage.
 */
    public function destroy($id)
    {
        $user = Auth::user();

        if (!$user) {
            // If the user is not authenticated, redirect to login or give an error message
            return redirect('login')->with('error', 'You must be logged in to delete scholarships.');
        }

        // Retrieve the scholarship only if it belongs to the authenticated user
        $scholarship = Scholarship::where('id', $id)->where('userId', $user->id)->first();

        if ($scholarship) {
            // Delete the scholarship if it exists and belongs to the user
            $scholarship->delete();
            return redirect('scholarship')->with('success','Scholarship Deleted Successfully!');
        } else {
            // If the scholarship doesn't exist or doesn't belong to the user, redirect back with an error message
            return back()->with('error', 'Scholarship not found or you do not have permission to delete this scholarship.');
        }
    }

    public function search(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return redirect('login')->with('error', 'You must be logged in to search scholarships.');
        }

        $query = $request->query('query');
        $scholarships = collect();

        if ($query) {
            $scholarships = Scholarship::where('userId', $user->id)
                                    ->where(function ($q) use ($query) {
                                        $q->where('title', 'LIKE', "%{$query}%")
                                            ->orWhere('fundType', 'LIKE', "%{$query}%")
                                            ->orWhere('academic', 'LIKE', "%{$query}%");
                                    })
                                    ->get();
        } else {
            $scholarships = Scholarship::where('userId', $user->id)->get();
        }

        // Group scholarships by type and filter out the empty groups
        $groupedScholarships = $scholarships->groupBy('type')->reject(function ($group) {
            return $group->isEmpty();
        });

        // Return the view with the search results
        return view('scholarship', ['groupedScholarships' => $groupedScholarships]);
    }

    public function filter(Request $request)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect('login')->with('error', 'You must be logged in to filter scholarships.');
        }

        // Get the academic, fund type, and status from the query string
        $academicType = $request->query('academic');
        $fundType = $request->query('fundType');
        $status = $request->query('status');
        
        // Start the query to get scholarships for the user
        $query = Scholarship::where('userId', $user->id);

        // Apply filters if provided
        if ($academicType) {
            $query->where('academic', $academicType);
        }
        if ($fundType) {
            $query->where('fundType', $fundType);
        }
        if ($status) {
            $query->where('status', $status);
        }

        // Execute the query and get the results
        $scholarships = $query->get();

        // Group scholarships by type
        $groupedScholarships = $scholarships->groupBy('type');

        // Return the view with the filtered results
        return view('scholarship', ['groupedScholarships' => $groupedScholarships]);
    }

    public function userscholarship(Request $request)
    {
        $scholarships = Scholarship::with('user')->get();

        $totalScholarships = $scholarships->count();

        // Get the fund type，academic type and status from the query parameter
        $currentFund = $request->query('fundType','Fund');
        $currentAcademic = $request->query('academic','Academic');
        $currentStatus = $request->query('status','Status');

        return view('userscholarship', [
            'scholarships' => $scholarships, 
            'totalScholarships' => $totalScholarships,
            'currentFund' => $currentFund,
            'currentAcademic' =>  $currentAcademic,
            'currentStatus' => $currentStatus,
        ]);
    }


    public function scholarshipfilter(Request $request)
    {

        // Get the sort and filter options from the query string
        $fundFilter = $request->query('fundType');
        $academicFilter = $request->query('academic');
        $statusFilter = $request->query('status');

        // Get the fund type，academic type and status from the query parameter
        $currentFund = $request->query('fundType','Fund');
        $currentAcademic = $request->query('academic','Academic');
        $currentStatus = $request->query('status','Status');

        // Start the query builder
        $query = Scholarship::query();

 
        if (!empty($fundFilter)) {
            $query->where('fundType', $fundFilter);
        }
      
        if (!empty($academicFilter)) {
            $query->where('academic', $academicFilter);
        }

        if (!empty($statusFilter)) {
            $query->where('status', $statusFilter);
        }

        // Execute the query to get filtered results
        $scholarships = $query->get();

        // Count the total number of scholarships after filtering
        $totalScholarships = $scholarships->count();

        // Pass the scholarships and the total number to the view
        return view('userscholarship', [
            'scholarships' => $scholarships,
            'totalScholarships' => $totalScholarships,
            'currentFund' => $currentFund,
            'currentAcademic' =>  $currentAcademic,
            'currentStatus' => $currentStatus,
        ]);
    }

    /**
     * Show the detailed page for a specific scholarship.
     */
    public function userscholarshipdetail($id) 
    {
        // Retrieve the scholarship with its related user based on the given scholarship ID.
        $item = Scholarship::with('user')->findOrFail($id);

        // Extract the username from the related user model.
        $username = $item->user->username;

        $user = auth()->user(); // Get the currently authenticated user

         // Convert the birthday to a Carbon instance if it's not already
        //  $birthday = Carbon::parse($user->birthday); // This line is just for safety

         // Convert the birthday to a Carbon instance if it's not already
        //  if ($user->birthday) {
        //     $birthday = Carbon::parse($user->birthday);
        //     $birthdayComponents = [
        //         'day' => $birthday->format('d'),
        //         'month' => $birthday->format('m'),
        //         'year' => $birthday->format('Y'),
        //     ];
        // } else {
        //     $birthdayComponents = null; // Or ['day' => null, 'month' => null, 'year' => null];
        // }


        // Return the detailed view with the scholarship data and username.
        return view('userscholarshipdetail', 
        ['item' => $item, 
        'username' => $username, 
        'user' => $user, 
        // 'birthdayComponents' => $birthdayComponents ?: ['day' => null, 'month' => null, 'year' => null],
        ]);
    }


}
