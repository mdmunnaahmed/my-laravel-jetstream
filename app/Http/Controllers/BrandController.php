<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\MultiPic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Image;

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
        return view('admin.brand.all', compact('brands'));
    }


    public function brandTrash()
    {
        $trash = Brand::onlyTrashed()->latest()->paginate(5);
        return view('admin.brand.trash', compact('trash'));
    }

    public function multipic()
    {
        $multipic = MultiPic::all();
        return view('admin.multipic.all', compact('multipic'));
    }

    public function multipicStore(Request $request)
    {
        $request->validate([
            'img' => 'required',
        ]);

        $files = $request->file('img');
        $images = array();

        if ($files) {
            foreach ($files as $file) {
                $name = date('mdYHis') . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move('img/', $name);
                $newFile = $images[] = $name;
                MultiPic::create([
                    'img' => $newFile,
                ]);
            }
        }
        dd($newFile);
        $form = new MultiPic();
        $form->img = json_encode($newFile);


        $form->save();
        // foreach ($files as $file) {
        //     $newFile = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
        //     Image::make($file)->resize(300, 200)->save('img/' . $newFile);

        //     MultiPic::create([
        //         'img' => $newFile,
        //     ]);
        // }
        $message = [
            'type' => 'success',
            'message' => 'Multipics Uploaded Successfully'
        ];
        return redirect()->route('multipic')->with($message);
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
        Image::make($file)->resize(300, 200)->blur(15)->save('img/' . $newFile);

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
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
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
        if ($request->file('brand_img')) {
            $file = $request->file('brand_img');
            $newFile = hexdec(uniqid()) . '.' . $file->getClientOriginalExtension();
            $file->move('img/', $newFile);

            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_img' => $newFile,
            ]);
        }
        Brand::find($id)->update([
            'brand_name' => $request->brand_name,
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
    public function multipicDestroy($id)
    {
        $var = MultiPic::find($id)->delete();
        return redirect()->route('multipic')->with('success', 'Pics Deleted Successfully');
    }


    public function pdelete($id)
    {
        $deleteItem = Brand::onlyTrashed()->find($id);
        if (file_exists('img/' . $deleteItem->brand_img)) {
            unlink('img/' . $deleteItem->brand_img);
        }
        $deleteItem->forceDelete();
        return redirect()->route('all.brand')->with('success', 'Brands Permanently Deleted Successfully');
    }

    public function restore($id)
    {
        Brand::withTrashed()->find($id)->restore();
        return redirect()->route('all.brand')->with('success', 'Brands Successfully Restored');
    }
}
