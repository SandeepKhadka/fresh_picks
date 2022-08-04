<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    protected $category = null;

    public function __construct(Category $_category)
    {
        $this->category = $_category;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->category = $this->category->with('parent_info')->get();
//        foreach ($this->category as $category_data){
//            if (isset($category_data->parent_info['title']))
//            dd($category_data->parent_info['title']);
//        }
        return view('admin.category_list')
            ->with('category_list', $this->category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->category = $this->category->where('is_parent',1)->pluck('title','id');
        return view('admin.category_form')
            ->with('parent_id', $this->category);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $rules = $this->category->rules();

        $request->validate($rules);
        $data = $request->except(['_token', 'image']);

        if ($request->image) {
            $file_name = uploadImage($request->image, "category", '200x200');
            if ($file_name) {
                $data['image'] = $file_name;
            }
        }

        $data['added_by'] = $request->user()->id;
        $data['slug'] = $this->category->getSlug($data['title']);

        $data['is_parent'] = $request->input('is_parent', 0);
        $this->category->fill($data);
        $status = $this->category->save();
        if ($status) {
            $request->session()->flash('success', 'Category added successfully');
        } else {
            $request->session()->flash('error', 'Sorry! There was problem while adding category');
        }
        return redirect()->route('category.index');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->category = $this->category->find($id);
        if (!$this->category){
            \request()->session()->flash('error', 'Category doesnot exits');
            return redirect()->route('category.index');
        }

        $parent_id = $this->category->where('is_parent',1)->pluck('title','id');

        return view('admin.category_form')
            ->with('parent_id', $parent_id)
            ->with('category_list', $this->category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->category = $this->category->find($id);
        if (!$this->category){
            $request->session()->flash('error','Category doesnot exists');
            return redirect()->route('category.index');
        }
        $rules = $this->category->rules('update');

        $request->validate($rules);

        $data = $request->except(['_token','image']);
        if (isset($request->image)){
            $file_name = uploadImage($request->image,'category','200x200');
            if ($file_name){
                if ($this->category->image != null && file_exists(public_path().'/uploads/category/').$this->category->image){
                    unlink(public_path().'/uploads/category/'.$this->category->image);
                    unlink(public_path().'/uploads/category/Thumb-'.$this->category->image);
                }

                $data['image'] = $file_name;

            }
        }

        $data['slug'] = $this->category->getSlug($data['title']);
        $data['is_parent'] = $request->input('is_parent', 0);
        $data['parent_id'] = $data['is_parent'] == 1 ? null : $data['parent_id'];
//        dd($data);
        $this->category->fill($data);
        $status = $this->category->save();

        if ($status){
            $request->session()->flash('success', 'Category updated successfully');
        }else{
            $request->session()->flash('error', 'Sorry! there was problem in updating category');
        }
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->category = $this->category->find($id);

        if (!$this->category){
            \request()->session()->flash('error', 'Category not found');
            return redirect()->route('category.index');
        }

        $child_cat_id = $this->category->where('is_parent' ,0)->where('parent_id',$id)->pluck('id');
        $image = $this->category->image;

        $del = $this->category->delete();
        if($del){
            $this->category->whereIn('id',$child_cat_id)->update(['is_parent' => 1]);

            if($image != null && file_exists(public_path().'/uploads/category/'.$image)){
                 unlink(public_path().'/uploads/category/'.$image);
                 unlink(public_path().'/uploads/category/Thumb-'.$image);
            }
            \request()->session()->flash('success','Category deleted successfully');
        }else{
            \request()->session()->flash('error','Sorry! There was problem in deleting category');

        }

        return redirect()->route('category.index');


    }
}
