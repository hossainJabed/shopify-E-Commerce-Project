<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.unit.create');
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
                $unit = new Unit();
                $unit->name = $request->name;
                $unit->code = $request->code;
                $unit->description = $request->description;
                $unit->status = $request->status;
//                dd($unit);
                $unit->save();
                $success = array(
                    'message' => 'Unit Data is successfully Inserted!',
                    'alert-type' => 'success'
                );

            }
            catch (Exception $e) {
                $message = $e->getMessage();
            }
            return redirect()->route('unit.show')->with($success);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $unit = Unit::all();
        // dd($this->about);
        //dd($this->category->all());
        return view('admin.unit.list',['item' => $unit]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $unit = Unit::find($id);
        return view('admin.unit.edit',['item' =>$unit]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $unit = Unit::find($id);
            $unit->name = $request->name;
            $unit->code = $request->code;
            $unit->description = $request->description;
            $unit->status = $request->status;
            $unit->update();
            $success = array(
                'message' => 'Unit Data is successfully Updated!',
                'alert-type' => 'success'
            );

        }
        catch (Exception $e) {
            $message = $e->getMessage();
        }
        return redirect()->route('unit.show')->with($success);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        {
            $unit = Unit::find($id);
            $unit->delete();
        }
        $success = array(
            'message' => 'Unit  Data is Delete successfully!',
            'alert-type' => 'warning'
        );
        return redirect()->route('unit.show')->with($success);
    }
}
