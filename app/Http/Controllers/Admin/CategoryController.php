<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $categories = Category::paginate(10);
        return view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name'=>'required',

        ]);

        $category = Category::create($request->all());
        $notification = array(
            'message' => 'Category created successfully!',
            'alert-type' => 'success'
        );
        return  redirect()->route('categories.index')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category= Category::findOrFail($id);

        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $category = Category::findOrFail($id);
        $request->validate([
            'name'=>'required',

        ]);
        $category->update($request->all());
        $notification = array(
            'message' => 'Category updated successfully!',
            'alert-type' => 'info'
        );
        return  redirect()->route('categories.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

      //  Category::destroy($id);


        $category =  Category::find($id);
        if (!$category)
        {
         return responseJson(0,'No data');
        }

        if(count($category->restaursnts)){
            $notification = array(
                'message' => 'do not remove this category',
                'alert-type' => 'info'
            );
//            return redirect()->route('categories.index')->with($notification);
//            session()->flash('fail','you can not delete this');
//            return back();
            return responseJson(0,'Can\'t!');

        }else{

            $category->delete();

//            return redirect()->route('categories.index')->with($notification);
            return responseJson(1,'Record deleted successfully!',$id);

        }


    }
}
