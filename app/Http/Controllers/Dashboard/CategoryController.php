<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function __construct(){

        $this->middleware(['permission:read_categories'])->only('index');

        $this->middleware(['permission:create_categories'])->only('create');
        $this->middleware(['permission:update_categories'])->only('edit');
        $this->middleware(['permission:delete_categories'])->only('destroy');
    }
    public function index(Request $request)
    {

if($request->input('search')){
    $categories = Category::whereTranslationLike('name','%'.$request->input('search').'%')->latest()->paginate(3);

}else{


        $categories = Category::latest()->paginate(3);
}
        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ar.*'=>'required|unique:category_translations,name',
            'en.*'=>'required|unique:category_translations,name',
            ]);
        Category::create($request->all());
        session()->flash('success',__('site.updated_successfully'));
                return redirect()->route('dashboard.categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

  
    public function edit(Category $category)

    {
        return view('dashboard.categories.edit',compact('category'));
    }

 
    public function update(Request $request, Category $category)
    {
        $request->validate([
            
            'ar.*'=>['required',Rule::unique('category_translations','name')->ignore($category->id,'category_id')],
            'en.*'=>['required',Rule::unique('category_translations','name')->ignore($category->id,'category_id')],
            ]);
            $category->update($request->all());
            session()->flash('success',__('site.updated_successfully'));
            return redirect()->route('dashboard.categories.index');
                
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    { 
        $category->delete();
        session()->flash('success',__('site.deleted_successfully'));
        return redirect()->route('dashboard.categories.index');
        
    }
}
