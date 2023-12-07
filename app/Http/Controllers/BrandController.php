<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.brand.create');
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
                $brand = new Brand();
                $brand->name = $request->name;
                $brand->description = $request->description;
                $brand->status = $request->status;
                if ($request->file('image')) {
                    $file = $request->file('image');
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('uploded/Brand-file/'), $filename);
                    $brand['image'] = $filename;
                }
//                dd($brand);
                $brand->save();
                $success = array(
                    'message' => 'Brand Data is successfully Inserted!',
                    'alert-type' => 'success'
                );

            }
            catch (Exception $e) {
                $message = $e->getMessage();
            }
            return redirect()->route('brand.show')->with($success);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $brand = Brand::all();
        // dd($this->about);
        //dd($this->category->all());
        return view('admin.brand.list',['item' => $brand]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit',['item' =>$brand]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $brand = Brand::find($id);
            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('uploded/Brand-file/'), $filename);
                $brand['image'] = $filename;
            }
            else {
                $imageUrl = $brand->file;
            }
            $brand->name = $request->name;
            $brand->description = $request->description;
            $brand->status = $request->status;
            $brand->update();
            $success = array(
                'message' => 'Brand Data is successfully Updated!',
                'alert-type' => 'success'
            );

        }
        catch (Exception $e) {
            $message = $e->getMessage();
        }
        return redirect()->route('brand.show')->with($success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        {
            $brand = Brand::find($id);
            $brand->delete();
        }
        $success = array(
            'message' => 'Brand  Data is Delete successfully!',
            'alert-type' => 'warning'
        );
        return redirect()->route('brand.show')->with($success);
    }
}
