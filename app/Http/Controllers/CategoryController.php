<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.category.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {

            try {
                $category = new Category();
                $category->name = $request->name;
                $category->description = $request->description;
                $category->status = $request->status;
                if ($request->file('image')) {
                    $file = $request->file('image');
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('uploded/category-file/'), $filename);
                    $category['image'] = $filename;
                }
//                dd($category);
                $category->save();
                $success = array(
                    'message' => 'Category Data is successfully Inserted!',
                    'alert-type' => 'success'
                );

            }
            catch (Exception $e) {
                $message = $e->getMessage();
            }
            return redirect()->route('category.show')->with($success);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $category = Category::all();
        // dd($this->about);
        //dd($this->category->all());
        return view('admin.category.list',['item' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit',['item' =>$category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $category = Category::find($id);
            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('uploded/category-file/'), $filename);
                $category['image'] = $filename;
            }
            else {
                $imageUrl = $category->file;
            }
            $category->name = $request->name;
            $category->description = $request->description;
            $category->status = $request->status;
            $category->update();
            $success = array(
                'message' => 'Category Data is successfully Updated!',
                'alert-type' => 'success'
            );

        }
        catch (Exception $e) {
            $message = $e->getMessage();
        }
        return redirect()->route('category.show')->with($success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        {
            $category = Category::find($id);
            $category->delete();
        }
        $success = array(
            'message' => 'category  Data is Delete successfully!',
            'alert-type' => 'warning'
        );
        return redirect()->route('category.show')->with($success);
    }
}
