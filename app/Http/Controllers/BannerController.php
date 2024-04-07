<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Banner;
use phpDocumentor\Reflection\File;

class BannerController extends Controller
{

    protected $banner = null;

    public function __construct(Banner $_banner)
    {
        $this->banner = $_banner;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->banner = $this->banner->orderBy('id', 'DESC')->get();
        return view('admin.banner_list')
            ->with('banner_list', $this->banner);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = $this->banner->rules();

        $request->validate($rules);
        $data = $request->except('image');

        $file_name = uploadImage($request->image, "banner", '1200x760');
        if ($file_name){
            $data['image'] = $file_name;
        }

        $data['added_by'] = $request->user()->id;
        $this->banner->fill($data);
        $status = $this->banner->save();
        if ($status){
            $request->session()->flash('success', 'Banner added successfully');
        }else{
            $request->session()->flash('error', 'Sorry! There was problem while adding banner');
        }
        return redirect()->route('banner.index');
    }

    public function getAllBanner()
{
    try {
        $banners = $this->banner->orderBy('id', 'DESC')->where('status', 'active')->get();

        if ($banners->isEmpty()) {
            return response()->json(['error' => 'No banners found'], 404);
        }

        return response()->json(['banners' => $banners], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to retrieve banners.'], 500);
    }
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
        $this->banner = $this->banner->find($id);
        if (!$this->banner){
            request()->session()->flash('error', 'Banner does not exists');
            return redirect()->route('banner.index');
        }

        return view('admin.banner_form')
            ->with('banner_data', $this->banner);

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
        $this->banner = $this->banner->find($id);
        if (!$this->banner){
            $request->session()->flash('error', 'Banner not found');
            return redirect()->route('banner.index');
        }

        $rules = $this->banner->rules('update');

        $request->validate($rules);
        $data = $request->except('image');

        if(isset($request->image)) {
            $file_name = uploadImage($request->image, "banner", '1200x760');
            if ($file_name) {
                if ($this->banner->image != null && file_exists(public_path() . 'uploads/banner/' . $this->banner->image)) {
                    unlink(public_path() . 'uploads/banner/' . $this->banner->image);
                    unlink(public_path() . 'uploads/banner/Thumb-' . $this->banner->image);
                }

                $data['image'] = $file_name;
            }
        }
        $this->banner->fill($data);
        $status = $this->banner->save();
        if ($status){
            $request->session()->flash('success', 'Banner updated successfully');
        }else{
            $request->session()->flash('error', 'Sorry! There was problem while updating banner');
        }
        return redirect()->route('banner.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->banner = $this->banner->find($id);

        if (!$this->banner){
            request()->session()->flash('error', 'Banner does not exists');
            return redirect()->route('banner.index');
        }

        $image = $this->banner->image;
        $del = $this->banner->delete();

        if($del){
            if (!empty($image) && file_exists(public_path().'/uploads/banner/'.$image)){
                unlink(public_path().'/uploads/banner/'.$image);
                unlink(public_path().'/uploads/banner/Thumb-'.$image);
            }
            request()->session()->flash('success', 'Banner deleted successfully');
        }else{
            request()->session()->flash('error', 'Sorry! There was error in deleting banner');
        }
        return redirect()->route('banner.index');
    }
}
