<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Instructor; 
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Str;

class InstructorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $instructors = Instructor::all();
        return view ('instructor')->with('instructors',$instructors);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createinstructor');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'about' => 'required',
        ]);

        $input = $request->all();


        if($image = $request->file('image')) {
            $destinationPath = 'images/';
            $instructorImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath,$instructorImage);
            $input['image'] = $instructorImage;
        }
        // Log::info($input);

        Instructor::create($input);
        return redirect('instructor')->with('success','Instructor Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Instructor $item)
    {
        return view('showinstructor',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Instructor $item)
    {
        return view('editinstructor',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Instructor $item)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
            'about' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $input = $request->all();

        if($image = $request->file('image')) {
            $destinationPath = 'images/';
            $instructorImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath,$instructorImage);
            $input['image'] = $instructorImage;
        }else{
            unset($input['image']);
        }

        $item->update($input);
        return redirect('instructor')->with('success','Instructor Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Instructor $item)
    {
        $input = $request->all();
        $item->delete($input);
        return redirect('instructor')->with('success','Instructor Deleted Successfully!');
    }

    public function search(Request $request)
    {
        $searchQuery = $request->query('query', '');
        
        if($searchQuery) {
            $instructors= Instructor::where('name', 'LIKE', "%{$searchQuery}%")
                            ->orWhere('title', 'LIKE', '%' . $searchQuery . '%')
                                ->get();
        } else {
            $instructors = Instructor::all();
        }

        return view('instructor', compact('instructors', 'searchQuery'));
    }
}
