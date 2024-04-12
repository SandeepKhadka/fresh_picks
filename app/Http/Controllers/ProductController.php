<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->product = $this->product->orderBy('id', 'DESC')->get();
        return view('admin.product_list')
            ->with('product_list', $this->product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('is_parent', 1)->get();
        $sub_categories = Category::where('is_parent', 0)->get();
        return view('admin.product_form', ['categories' => $categories, 'sub_categories' => $sub_categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $this->validate($request, [
            'name' => 'string|required',
            'summary' => 'string|nullable',
            'description' => 'string|nullable',
            'quantity' => 'numeric|nullable',
            'price' => 'numeric|required',
            'discount' => 'numeric|nullable',
            'image' => 'required',
            'cat_id' => 'required|exists:categories,id',
            'conditions' => 'nullable',
        ]);


        $data = $request->except('image');

        $file_name = uploadImage($request->image, "product", '125x125');
        if ($file_name) {
            $data['image'] = $file_name;
        }

        $data['added_by'] = $request->user()->id;
        $data['slug'] = $this->product->getSlug($data['name']);
        $data['discount'] = 0;
        // $price = ($request->price - (($request->price * $request->discount) / 100));
        // $data['price'] = $price;
        $this->product->fill($data);
        $status = $this->product->save();
        if ($status) {
            $request->session()->flash('success', 'Product added successfully');
        } else {
            $request->session()->flash('error', 'Sorry! There was problem while adding product');
        }
        return redirect()->route('product.index');
    }

    public function getProducts()
    {
        // Retrieve all products from the database
        $products = Product::all();
    
        // Check if there are any products
        if ($products->isEmpty()) {
            // If there are no products, return a JSON response with a message
            $response = [
                'message' => 'No products found',
                'status' => false
            ];
            return response()->json($response, 404);
        }
    
        // Convert fields to string for each product
        $productsData = [];
        foreach ($products as $product) {
            $productData = $product->toArray(); // Convert product to array
    
            // Convert each field to string except id
            foreach ($productData as $key => $value) {
                if ($key !== 'id') {
                    $productData[$key] = (string) $value;
                }
            }
    
            $productsData[] = $productData;
        }
    
        // If products are found, return a JSON response with the products
        $response = [
            'products' => $productsData,
            'message' => 'Products retrieved successfully',
            'status' => true
        ];
        return response()->json($response, 200);
    }
    
    

    public function getExoticProduct()
    {
        // Retrieve all products from the database
        $products = Product::where('conditions', 'exotic')->where('status', 'active')->get();

        // Check if there are any products
        if ($products->isEmpty()) {
            // If there are no products, return a JSON response with a message
            $response = [
                'message' => 'No products found',
                'status' => false
            ];
            return response()->json($response, 404);
        }

        $productsData = [];
        foreach ($products as $product) {
            $productData = $product->toArray(); // Convert product to array
    
            // Convert each field to string except id
            foreach ($productData as $key => $value) {
                if ($key !== 'id') {
                    $productData[$key] = (string) $value;
                }
            }
    
            $productsData[] = $productData;
        }
    
        // If products are found, return a JSON response with the products
        $response = [
            'products' => $productsData,
            'message' => 'Products retrieved successfully',
            'status' => true
        ];
        return response()->json($response, 200);
    }

    public function getDiscountProduct()
    {
        // Retrieve all products from the database
        $products = Product::where('conditions', 'discount')->where('status', 'active')->get();

        // Check if there are any products
        if ($products->isEmpty()) {
            // If there are no products, return a JSON response with a message
            $response = [
                'message' => 'No products found',
                'status' => false
            ];
            return response()->json($response, 404);
        }

        $productsData = [];
        foreach ($products as $product) {
            $productData = $product->toArray(); // Convert product to array
    
            // Convert each field to string except id
            foreach ($productData as $key => $value) {
                if ($key !== 'id') {
                    $productData[$key] = (string) $value;
                }
            }
    
            $productsData[] = $productData;
        }
    
        // If products are found, return a JSON response with the products
        $response = [
            'products' => $productsData,
            'message' => 'Products retrieved successfully',
            'status' => true
        ];
        return response()->json($response, 200);
    }

    public function getNewProduct()
    {
        // Retrieve all products from the database
        $products = Product::where('conditions', 'new')->where('status', 'active')->get();

        // Check if there are any products
        if ($products->isEmpty()) {
            // If there are no products, return a JSON response with a message
            $response = [
                'message' => 'No products found',
                'status' => false
            ];
            return response()->json($response, 404);
        }

        // If products are found, return a JSON response with the products
        $productsData = [];
        foreach ($products as $product) {
            $productData = $product->toArray(); // Convert product to array
    
            // Convert each field to string except id
            foreach ($productData as $key => $value) {
                if ($key !== 'id') {
                    $productData[$key] = (string) $value;
                }
            }
    
            $productsData[] = $productData;
        }
    
        // If products are found, return a JSON response with the products
        $response = [
            'products' => $productsData,
            'message' => 'Products retrieved successfully',
            'status' => true
        ];
        return response()->json($response, 200);
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
        $this->product = $this->product->find($id);
        if (!$this->product) {
            request()->session()->flash('error', 'Product does not exists');
            return redirect()->route('product.index');
        }
        $categories = Category::where('is_parent', 1)->get();
        $sub_categories = Category::where('is_parent', 0)->get();

        return view('admin.product_form')
            ->with('product_list', $this->product)
            ->with('categories', $categories)
            ->with('sub_categories', $sub_categories);
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
        $this->product = $this->product->find($id);
        // dd($this->product );
        if (!$this->product) {
            $request->session()->flash('error', 'Product not found');
            return redirect()->route('product.index');
        }

        $this->validate($request, [
            'name' => 'string|required',
            'summary' => 'string|required',
            'description' => 'string|nullable',
            'quantity' => 'numeric|nullable',
            'price' => 'numeric|required',
            'discount' => 'numeric|nullable',
            'image' => 'nullable',
            'cat_id' => 'required|exists:categories,id',
            'conditions' => 'nullable',
        ]);

        $data = $request->except('image');

        if (isset($request->image)) {
            $file_name = uploadImage($request->image, "product", '125x125');
            if ($file_name) {
                if ($this->product->image != null && file_exists(public_path() . 'uploads/product/' . $this->product->image)) {
                    unlink(public_path() . 'uploads/product/' . $this->product->image);
                    unlink(public_path() . 'uploads/product/Thumb-' . $this->product->image);
                }

                $data['image'] = $file_name;
            }
        }
        $this->product->fill($data);
        $status = $this->product->save();
        if ($status) {
            $request->session()->flash('success', 'Product updated successfully');
        } else {
            $request->session()->flash('error', 'Sorry! There was problem while updating product');
        }
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->product = $this->product->find($id);

        if (!$this->product) {
            request()->session()->flash('error', 'Product does not exists');
            return redirect()->route('product.index');
        }

        $image = $this->product->image;
        $del = $this->product->delete();

        if ($del) {
            if (!empty($image) && file_exists(public_path() . '/uploads/product/' . $image)) {
                unlink(public_path() . '/uploads/product/' . $image);
                unlink(public_path() . '/uploads/product/Thumb-' . $image);
            }
            request()->session()->flash('success', 'Product deleted successfully');
        } else {
            request()->session()->flash('error', 'Sorry! There was error in deleting product');
        }
        return redirect()->route('product.index');
    }
}
