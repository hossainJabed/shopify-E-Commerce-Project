<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\OtherImage;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Unit;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $category = Category::all();
        $subcategory = SubCategory::all();
        $unit = Unit::all();
        $brand = Brand::all();
        $otherImage = OtherImage::all();
        return view('admin.product.create',compact('category','subcategory','unit','brand','otherImage'));
    }
    public function getSubcategoryByCategory()
    {

        return response()->json( SubCategory::where('category_id', $_GET['id'])->get());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        {

            try {
                $product = new Product();
                $product->category_id = $request->category_id;
                $product->sub_category_id = $request->sub_category_id;
                $product->brand_id = $request->brand_id;
                $product->unit_id = $request->unit_id;
                $product->name = $request->name;
                $product->code = $request->code;
                $product->model = $request->model;
                $product->stock_amount = $request->stock_amount;
                $product->regular_price = $request->regular_price;
                $product->selling_price = $request->selling_price;
                $product->short_description = $request->short_description;
                $product->long_description = $request->long_description;
                $product->status = $request->status;
                if ($request->file('image')) {
                    $file = $request->file('image');
                    $filename = date('YmdHi') . $file->getClientOriginalName();
                    $file->move(public_path('uploded/Product-file/'), $filename);
                    $product['image'] = $filename;
                }
                $product->save();
                foreach ($request->other_image as $image) {
                    $other_image = new OtherImage();
                    $other_image->product_id = $product->id;
                    $other_image->image = $this->saveImage($image);
                    $other_image->save();

                }
                    $success = array(
                        'message' => 'Product Data is successfully Inserted!',
                        'alert-type' => 'success'
                    );

                }
            catch
                (Exception $e) {
                    $message = $e->getMessage();
                }
            return redirect()->route('product.show')->with($success);
        }
    }
    public function saveImage($image){

        $filename = date('YmdHi') . $image->getClientOriginalName();
        $image_url= $image->move(public_path('uploded/OtherImage-file/'), $filename);
        return $image_url;
 }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $product = Product::all();
        // dd($this->about);
        //dd($this->category->all());
        return view('admin.product.list',['item' => $product]);
    }
    public function view($id)
    {
        $product = Product::all();
        // dd($this->about);
        //dd($this->category->all());
        return view('admin.product.view',['item' => Product::find($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.product.edit',['item' =>$product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $product = Product::find($id);
            if ($request->file('image')) {
                $file = $request->file('image');
                $filename = date('YmdHi') . $file->getClientOriginalName();
                $file->move(public_path('uploded/Product-file/'), $filename);
                $product['image'] = $filename;
            }
            else {
                $imageUrl = $product->file;
            }
            $product->name = $request->name;
            $product->description = $request->description;
            $product->status = $request->status;
            $product->update();
            $success = array(
                'message' => 'Product Data is successfully Updated!',
                'alert-type' => 'success'
            );

        }
        catch (Exception $e) {
            $message = $e->getMessage();
        }
        return redirect()->route('product.show')->with($success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        {
            $product = Product::find($id);
            $product->delete();
        }
        $success = array(
            'message' => 'Product  Data is Delete successfully!',
            'alert-type' => 'warning'
        );
        return redirect()->route('product.show')->with($success);
    }
}
