<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::latest()->paginate(5);
        $brandTrash = Brand::onlyTrashed()->latest()->paginate(5);
        return view('admin.brand.all', compact('brands', 'brandTrash'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'brand_name' => 'required | min:3',
            'brand_img' => 'required',
        ]);

        $file = $request->file('brand_img');
        $newFile = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
        $file->move('img/', $newFile);

        Brand::create([
            'brand_name' => $request->brand_name,
            'brand_img' => $newFile,
        ]);
        $message = [
            'type' => 'success',
            'message' => 'Brand Added Successfully'
        ];
        return redirect()->route('all.brand')->with($message);
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
        $brands = Brand::latest()->paginate(5);
        $brand2 = Brand::find($id);
        return view('admin.brand.all', compact('brand2', 'brands'));
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
        $file = $request->file('brand_img');
        $newFile = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
        $file->move('img/', $newFile);

        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
            'brand_img' => $newFile,
        ]);
        return redirect()->route('all.brand')->with('success', 'Brand Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Brand::find($id)->delete();
        return redirect()->route('all.brand')->with('success', 'Brand Deleted Successfully');
    }
    public function pdelete($id)
    {
        Brand::onlyTrashed()->find($id)->forceDelete();
        return redirect()->route('all.brand')->with('success', 'Brands Permanently Deleted Successfully');
    }

    public function restore($id)
    {
        Brand::withTrashed()->find($id)->restore();
        return redirect()->route('all.brand')->with('success', 'Brands Successfully Restored');
    }
}
