<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Applicant; 
use App\Models\Scholarship; 
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ApplicantsController extends Controller
{
    public function store(Request $request)
    {
        // Check if the user already has an application with 'Pending' status for the same scholarship
        $existingApplication = Applicant::where('userId', Auth::id())
                                        ->where('scholarshipId', $request->input('scholarshipId'))
                                        ->whereIn('status', ['Pending'])
                                        ->first();

        // If an existing application is found, return with an error message
        if ($existingApplication) {
            return redirect()->back()->with('error', 'You have already applied for this scholarship.');
        }

         // Get the current user's ID and scholarship ID from the request
        $userId = Auth::id();
        $scholarshipId = $request->input('scholarshipId');

        // Check if the user has an 'Accepted' application for the same scholarship
        $acceptedApplication = Applicant::where('userId', $userId)
                                        ->where('scholarshipId', $scholarshipId)
                                        ->where('status', 'Accept')
                                        ->first();

        if ($acceptedApplication) {
            return redirect()->back()->with('error', 'You have already been accepted for this scholarship and cannot apply again.');
        }

        // Count the number of existing applications for the same scholarship by the user
        $applicationCount = Applicant::where('userId', $userId)
                                    ->where('scholarshipId', $scholarshipId)
                                    ->count();

        // Check if the user already has three or more applications for the same scholarship
        if ($applicationCount >= 3) {
            return redirect()->back()->with('error', 'You cannot apply for the same scholarship more than three times.');
        }


        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string',
            'gender' => 'required|string',
            'birthday' => 'required|date',
            'nric' => 'required|string|regex:/^\d{12}$/',
            'email' => 'required|email',
            'address' => 'required|string',
            'contact' => 'required|regex:/^\d{10,11}$/',
            'course' => 'required|string',
            'qualification' => 'required|string',
            'file' => 'nullable|file|mimes:pdf', 
        ]);

        // Handle the file upload if provided
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('user_files', 'public');
            $validatedData['file'] = $filePath; // Save the new path to the validated data array
        } else {
            $user = Auth::user();
            $validatedData['file'] = $user->file; // Keep the existing path
        }

        $validatedData['userId'] = Auth::id();
        $validatedData['status'] = 'Pending';
        $validatedData['scholarshipId'] = $request['scholarshipId'];
        $validatedData['universityId'] = $request['universityId'];


        // Create a new applicant record
        Applicant::create($validatedData);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Application Submitted Successfully!');
    }

    public function showApplicants()
    {

        // Get the current logged-in user's ID
        $universityId = Auth::id();
        
        // Retrieve applicants and their related scholarship using Eager Loading
        $applicants = Applicant::with('scholarship')
                            ->where('universityId', $universityId)
                            ->get();
        log::info($applicants);
        
        // Calculate the totals for each status and the total number of applicants
        $statusTotals = [
            'total' => $applicants->count(),
            'pending' => $applicants->where('status', 'Pending')->count(),
            'accept' => $applicants->where('status', 'Accept')->count(),
            'reject' => $applicants->where('status', 'Reject')->count()
        ];

        // Pass the applicants data and the status totals to the view
        return view('unihome', compact('applicants', 'statusTotals'));
    }

    //export-csv
    public function exportApplicantsCSV()
    {
        $filename = "applicants.csv";
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        $applicants = Applicant::select('applicants.id', 'users.username', 'scholarship.title', 'applicants.status',
                                    'applicants.name','applicants.nric','applicants.gender','applicants.email',
                                    'applicants.address','applicants.contact','applicants.course','applicants.qualification')
                        ->join('users', 'users.id', '=', 'applicants.userId')
                        ->join('scholarship', 'scholarship.id', '=', 'applicants.scholarshipId')
                        ->orderBy('applicants.id', 'ASC')
                        ->get();

        $callback = function() use ($applicants) {
            $file = fopen('php://output', 'w');
            // Add CSV headers
            fputcsv($file, ['No.', 'Username', 'Scholarship Title', 'Full Name','NRIC','Gender','Birthday',
            'Email','Home Address','Contact','Course Interested','Current Qualification','Status']);
            
            foreach ($applicants as $index => $applicant) {
                // Write the data to the CSV
                fputcsv($file, [
                    $index + 1, 
                    $applicant->username, 
                    $applicant->title, 
                    $applicant->name, 
                    $applicant->nric, 
                    $applicant->gender, 
                    $applicant->birthday, 
                    $applicant->email, 
                    $applicant->address, 
                    $applicant->contact, 
                    $applicant->course, 
                    $applicant->qualification, 
                    $applicant->status
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }





    public function filterapplicant(Request $request)
    {
        $universityId = Auth::id();
        $statusFilter = $request->query('status');
    
        // Start the query with a condition on universityId
        $query = Applicant::where('universityId', $universityId);
    
        // If a status filter is provided, add a where condition for it
        if ($statusFilter) {
            $query->where('status', $statusFilter);
        }
    
        $applicants = $query->get();
    
       // Calculate the totals based on the filtered applicants
        $statusTotals = [
            'total' => $applicants->count(),
            'pending' => $applicants->where('status', 'Pending')->count(),
            'accept' => $applicants->where('status', 'Accept')->count(),
            'reject' => $applicants->where('status', 'Reject')->count(),
        ];
    
        // Pass the filtered applicants and the status totals to the view
        return view('unihome', compact('applicants', 'statusTotals'));
    }
    
    public function search(Request $request)
    {
        $universityId = Auth::id();
        $searchTerm = $request->query('query');
    
        // The base query for applicants with eager loading of scholarship
        $query = Applicant::with('scholarship')
                          ->where('universityId', $universityId)
                          ->join('users', 'applicants.userId', '=', 'users.id')
                          ->select('applicants.*', 'users.username');
    
        // Apply search criteria to applicant's name and scholarship title
        if (!empty($searchTerm)) {
            $query->where(function($query) use ($searchTerm) {
                $query->where('users.username', 'LIKE', "%{$searchTerm}%")
                      ->orWhereHas('scholarship', function($subQuery) use ($searchTerm) {
                          $subQuery->where('title', 'LIKE', "%{$searchTerm}%");
                      });
            });
        }
    
        $applicants = $query->get();    
    
        // Calculate the totals
        $statusTotals = [
            'total' => $applicants->count(),
            'pending' => $applicants->where('status', 'Pending')->count(),
            'accept' => $applicants->where('status', 'Accept')->count(),
            'reject' => $applicants->where('status', 'Reject')->count(),
        ];
    
        // Pass the filtered applicants and the status totals to the view
        return view('unihome', compact('applicants', 'statusTotals'));
    }
    


    public function editApplication($id)
    {
        $applicant = Applicant::with('scholarship')->findOrFail($id);
        $scholarshipTitle = $applicant->scholarship ? $applicant->scholarship->title : 'N/A';

        // Convert the birthday to a Carbon instance if it's not already
        if ($applicant->birthday) {
            $birthday = Carbon::parse($applicant->birthday);
            $birthdayComponents = [
                'day' => $birthday->format('d'),
                'month' => $birthday->format('m'),
                'year' => $birthday->format('Y'),
            ];
        } else {
            $birthdayComponents = null; // Or ['day' => null, 'month' => null, 'year' => null];
        }

        return view('editapplication', [
            'applicant' => $applicant, 
            'birthdayComponents' => $birthdayComponents ?: ['day' => null, 'month' => null, 'year' => null],
            'scholarshipTitle' => $scholarshipTitle
        ]);
    }

    public function showApplicantFile($id)
    {
        $applicant = Applicant::findOrFail($id);

        // Ensure the file exists
        if (!$applicant->file || !Storage::exists('user_file/' . $applicant->file)) {
            abort(404, 'File not found.');
        }

        $path = storage_path('storage/user_file/' . $applicant->file);
        
        // Return file response
        return response()->file($path);
    }

    public function updateApplicationStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Accept,Reject',
        ]);

        $applicant = Applicant::findOrFail($id);
        $applicant->status = $request->status;
        $applicant->save();

        return redirect()->route('unihome')->with('success', 'Application Status Updated Successfully.');
    }


    //user-side
    public function userApplications()
    {
        $userId = Auth::id(); 

        $applications = Applicant::with(['scholarship', 'university'])
                                 ->where('userId', $userId)
                                 ->orderBy('created_at', 'desc') 
                                 ->get();
    
        return view('userapplication', compact('applications'));
    }

    public function filterApplications(Request $request)
    {
        $userId = Auth::id();
        $sortOrder = $request->query('sort', 'latest') === 'latest' ? 'desc' : 'asc';

        // Retrieve the user's applications with related scholarship and university details
        $applications = Applicant::with(['scholarship', 'university'])
                                ->where('userId', $userId)
                                ->orderBy('created_at', $sortOrder)
                                ->get();

        // Return the userapplication view with the sorted applications
        return view('userapplication', compact('applications'));
    }


}
