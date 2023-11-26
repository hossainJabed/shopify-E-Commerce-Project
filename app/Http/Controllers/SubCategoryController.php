<?php

namespace App\Http\Controllers;

use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
//        dd($category);
        return view('admin.subcategory.create',compact('category'));
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
                    $subcategory = new SubCategory();
                    $subcategory->category_id = $request->category_id;
                    $subcategory->name = $request->name;
                    $subcategory->description = $request->description;
                    $subcategory->status = $request->status;
                    if ($request->file('image')) {
                        $file = $request->file('image');
                        $filename = date('YmdHi') . $file->getClientOriginalName();
                        $file->move(public_path('uploded/subcategory-file/'), $filename);
                        $subcategory['image'] = $filename;
                    }
//                dd($subcategory);
                    $subcategory->save();
                    $success = array(
                        'message' => 'Category Data is successfully Inserted!',
                        'alert-type' => 'success'
                    );

                }
                catch (Exception $e) {
                    $message = $e->getMessage();
                }
                return redirect()->route('subcategory.show')->with($success);
            }

    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $subcategory = SubCategory::all();
        return view('admin.subcategory.list',['item' => $subcategory]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $subcategory = SubCategory::find($id);
        return view('admin.subcategory.edit',['item' =>$subcategory]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $subcategory = SubCategory::find($id);
            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('uploded/subcategory-file/'), $filename);
                $subcategory['image'] = $filename;
            }
            else {
                $imageUrl = $subcategory->file;
            }
            $subcategory->category_name = $request->category_name;
            $subcategory->name = $request->name;
            $subcategory->description = $request->description;
            $subcategory->status = $request->status;
            $subcategory->update();
            $success = array(
                'message' => 'Category Data is successfully Updated!',
                'alert-type' => 'success'
            );

        }
        catch (Exception $e) {
            $message = $e->getMessage();
        }
        return redirect()->route('subcategory.show')->with($success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        {
            $subcategory = SubCategory::find($id);
            $subcategory->delete();
        }
        $success = array(
            'message' => 'category  Data is Delete successfully!',
            'alert-type' => 'warning'
        );
        return redirect()->route('subcategory.show')->with($success);
    }
}
