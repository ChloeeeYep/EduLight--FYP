<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial; 
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Str;

class TutorialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $type = $request->query('type');

    if ($type) {
        $tutorials = Tutorial::where('type', $type)->get();
    } else {
        $tutorials = Tutorial::all();
    }

    return view('tutorial', compact('tutorials'));
}


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createtutorial');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'required',
            'example' => 'required',
            'question' => 'required',
            'option1' => 'required',
            'option2' => 'required'
        ]);


        $input = $request->all();
        Tutorial::create($input);
        return redirect('tutorial')->with('success','Tutorial Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tutorial $item)
    {
        return view('showtutorial',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tutorial $item)
    {
        return view('edittutorial',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tutorial $item)
    {
        $request->validate([
            'name' => 'required',
            'details' => 'required',
            'example' => 'required',
            'question' => 'required',
            'option1' => 'required',
            'option2' => 'required'
        ]);

        $input = $request->all();
        $item->update($input);
        return redirect('tutorial')->with('success','Tutorial Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Tutorial $item)
    {
        $input = $request->all();
        $item->delete($input);
        return redirect('tutorial')->with('success','Tutorial Deleted Successfully!');
    }

    public function search(Request $request)
    {
        $searchQuery = $request->query('query', '');
        
        if($searchQuery) {
            $tutorials = Tutorial::where('type', 'LIKE', "%{$searchQuery}%")
                                ->orWhere('name', 'LIKE', "%{$searchQuery}%")
                                ->orWhere('details', 'LIKE', "%{$searchQuery}%")
                                ->get();
        } else {
            $tutorials = Tutorial::all();
        }

        $types = ['HTML', 'CSS', 'PHP', 'JAVASCRIPT', 'JAVA', 'PYTHON', 'C', 'C++', 'C#', 'R', 
                'SWIFT', 'KOTLIN', 'TYPESCRIPT', 'RUBY', 'GO', 'RUST', 'DART', 'SCALA', 'PERL', 'LUA', 
                'HASKELL', 'ERLANG', 'CLOJURE', 'MATLAB', 'GROOVY', 'POWERSHELL', 'SHELL', 'OBJECTIVE-C', 
                'VISUAL BASIC', 'SQL', 'ASSEMBLY LANGUAGE', 'PASCAL', 'FORTRAN', 'COBOL', 'ELM', 'JULIA', 
                'SCHEME', 'PROLOG', 'SAS', 'APL', 'ADA', 'OCAML', 'ELIXIR', 'VHDL', 'VERILOG']; 

        return view('tutorial', compact('tutorials', 'types', 'searchQuery'));
    }

    public function showTutorialsByType(Request $request, $typeSlug = null)
    {

        $selectedType = $typeSlug ?? 'HTML'; // Default type is 'HTML'
        $tutorials = Tutorial::where('type', $selectedType)->get();
        
        // Fetch unique types from the existing tutorials collection
        $alltutorials = Tutorial::all();
        $uniqueTypes = $alltutorials->pluck('type')->unique();
        // dd($uniqueTypes); // Debugging line

        
        return view('usertutorial', compact('tutorials', 'selectedType', 'uniqueTypes'));
    }
    
    public function showByTypeAndId($type, $id)
    {
        // Fetch the tutorial by its unique ID.
        $tutorial = Tutorial::findOrFail($id);

        // You can double-check if the type matches if you want to ensure consistency.
        if (Str::lower($tutorial->type) !== Str::lower($type)) {
            abort(404, 'Tutorial not found for the given type.');
        }
    
        // Fetch tutorials of the same type to keep the sidebar consistent.
        $selectedType = $tutorial->type;
        $tutorials = Tutorial::where('type', $selectedType)->get();
        $uniqueTypes = Tutorial::pluck('type')->unique();
    
        // Return the view with the necessary data.
        return view('usertutorial', compact('tutorial', 'tutorials', 'selectedType', 'uniqueTypes'));
    }
    
    public function showTutorialsByTypeTutorial(Request $request, $typeSlug = null)
    {

        $selectedType = $typeSlug ?? 'HTML'; // Default type is 'HTML'
        $tutorials = Tutorial::where('type', $selectedType)->get();
        
        // Fetch unique types from the existing tutorials collection
        $alltutorials = Tutorial::all();
        $uniqueTypes = $alltutorials->pluck('type')->unique();
        // dd($uniqueTypes); // Debugging line

        
        return view('usertutorial', compact('tutorials', 'selectedType', 'uniqueTypes'));
    }


}
