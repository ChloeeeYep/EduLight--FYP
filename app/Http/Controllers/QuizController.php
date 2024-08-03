<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quiz; 
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Str;

class QuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $type = $request->query('type');
    
        if ($type) {
            $quizzes = Quiz::where('type', $type)->get();
        } else {
            $quizzes = Quiz::all();
        }
    
        return view('quiz', compact('quizzes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createquiz');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'question' => 'required',
            'correct' => 'required',
            'wrong1' => 'required',
            'wrong2' => 'required',
            'wrong3' => 'nullable',
        ]);


        $input = $request->all();
        Quiz::create($input);
        return redirect('quiz')->with('success','Quiz Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quiz $item)
    {
        return view('showquiz',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quiz $item)
    {
        return view('editquiz',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quiz $item)
    {
        $request->validate([
            'type' => 'required',
            'question' => 'required',
            'correct' => 'required',
            'wrong1' => 'required',
            'wrong2' => 'required',
            'wrong3' => 'nullable',
        ]);

        $input = $request->all();
        $item->update($input);
        return redirect('quiz')->with('success','Quiz Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Quiz $item)
    {
        $input = $request->all();
        $item->delete($input);
        return redirect('quiz')->with('success','Quiz Deleted Successfully!');
    }

    public function search(Request $request)
    {
        $searchQuery = $request->query('query', '');
        
        if($searchQuery) {
            $quizzes = Quiz::where('type', 'LIKE', "%{$searchQuery}%")
                        ->orWhere('question', 'LIKE', "%{$searchQuery}%")
                        ->get();
        } else {
            $quizzes = Quiz::all();
        }

        $types = ['HTML', 'CSS', 'PHP', 'JAVASCRIPT', 'JAVA', 'PYTHON', 'C', 'C++', 'C#', 'R', 
                'SWIFT', 'KOTLIN', 'TYPESCRIPT', 'RUBY', 'GO', 'RUST', 'DART', 'SCALA', 'PERL', 'LUA', 
                'HASKELL', 'ERLANG', 'CLOJURE', 'MATLAB', 'GROOVY', 'POWERSHELL', 'SHELL', 'OBJECTIVE-C', 
                'VISUAL BASIC', 'SQL', 'ASSEMBLY LANGUAGE', 'PASCAL', 'FORTRAN', 'COBOL', 'ELM', 'JULIA', 
                'SCHEME', 'PROLOG', 'SAS', 'APL', 'ADA', 'OCAML', 'ELIXIR', 'VHDL', 'VERILOG'];  

        return view('quiz', compact('quizzes', 'types', 'searchQuery'));
    }


    public function showQuizByType(Request $request, $typeSlug = null)
    {

        $selectedType = $typeSlug ?? 'HTML'; // Default type is 'HTML'
        $quizzes = Quiz::where('type', $selectedType)->get();
        
        // Fetch unique types from the existing quizzes collection
        $allquizzes = Quiz::all();
        $uniqueTypes = $allquizzes->pluck('type')->unique();
        // dd($uniqueTypes); // Debugging line

        
        return view('userquiz', compact('quizzes', 'selectedType', 'uniqueTypes'));
    }

    public function showQuizByTypeBrief(Request $request, $typeSlug = null)
    {

        $selectedType = $typeSlug ?? 'HTML'; // Default type is 'HTML'
        $quizzes = Quiz::where('type', $selectedType)->get();
        
        // Fetch unique types from the existing quizzes collection
        $allquizzes = Quiz::all();
        $uniqueTypes = $allquizzes->pluck('type')->unique();
        // dd($uniqueTypes); // Debugging line

        
        return view('userquizbrief', compact('quizzes', 'selectedType', 'uniqueTypes'));
    }
}
