<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News; 
use Illuminate\Support\Facades\Log; 
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::all();
        return view ('news')->with('news',$news);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('createnews');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
            'introduction' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
            'title' => 'required',
            'description' => 'required',
            'title1' => 'nullable',
            'description1' => 'nullable',
        ]);

        $input = $request->all();


        if($image = $request->file('image')) {
            $destinationPath = 'images/';
            $newsImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath,$newsImage);
            $input['image'] = $newsImage;
        }
        // Log::info($input);

        News::create($input);
        return redirect('news')->with('success','News Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $item)
    {
        return view('shownews',compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $item)
    {
        return view('editnews',compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $item)
    {
        $request->validate([
            'category' => 'required',
            'introduction' => 'required',
            'title' => 'required',
            'description' => 'required',
            'title1' => 'nullable',
            'description1' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        $input = $request->all();

        if($image = $request->file('image')) {
            $destinationPath = 'images/';
            $newsImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath,$newsImage);
            $input['image'] = $newsImage;
        }else{
            unset($input['image']);
        }

        $item->update($input);
        return redirect('news')->with('success','News Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, News $item)
    {
        $input = $request->all();
        $item->delete($input);
        return redirect('news')->with('success','News Deleted Successfully!');
    }

    public function search(Request $request)
    {
        $searchQuery = $request->query('query', '');
        
        if($searchQuery) {
            $news= News::where('title', 'LIKE', "%{$searchQuery}%")
                            ->orWhere('category', 'LIKE', '%' . $searchQuery . '%')
                                ->get();
        } else {
            $news = News::all();
        }

        return view('news', compact('news', 'searchQuery'));
    }

    public function showNewsDetail(News $item)
    {
        $news4 = News::where('id', '!=', $item->id) // Exclude current news item
                ->inRandomOrder() // Order by random
                ->take(4) // Take only 4
                ->get(); // Get the results

        return view('usernewsdetail',compact('item','news4'));
    }

    public function showNews(Request $request) {     
        $news = News::orderBy('created_at', 'desc')->get();
        
        return view('usernews', compact('news'));
    }

    public function newsfilter(Request $request)
    {
        $sortOrder = $request->query('sort', 'latest'); // Default sort order is latest to oldest
    
        if ($sortOrder == 'latest') {
            $news = News::orderBy('created_at', 'desc')->get(); // Sort by created_at descending
        } else if ($sortOrder == 'oldest') {
            $news = News::orderBy('created_at', 'asc')->get(); // Sort by created_at ascending
        } else {
            $news = News::all(); // Fallback to fetch all news without sorting
        }

        return view('usernews', compact('news'));
    }

}
