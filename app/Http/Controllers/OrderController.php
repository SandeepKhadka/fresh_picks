<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    protected $order = null;

    public function __construct(Order $_order)
    {
        $this->order = $_order;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->order = $this->order->orderBy('id', 'DESC')->get();
        return view('admin.order_list')
            ->with('order_list', $this->order);
    }

    public function orderStatus(Request $request)
    {
        $order = Order::find($request->input('order_id'));
        if ($order) {
            if ($request->input('condition') == 'delivered') {
                foreach ($order->products as $item) {
                    $product = Product::where('id', $item->pivot->product_id)->first();
                    $stock = $product->stock;
                    $stock -= $item->pivot->quantity;
                    $product->update(['stock' => $stock]);
                    Order::where('id', $request->input('order_id'))->update(['payment_status' => 'paid']);
                }
            }

            $status = Order::where('id', $request->input('order_id'))->update(['condition' => $request->input('condition')]);
            if ($status) {
                return back()->with('success', 'Order successfully updated');
            } else {
                return back()->with('error', 'Something went wrong! Please try again!');
            }
        }
        abort(404);
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
        $validator = Validator::make($request->all(), [
            'user_id' => 'required|string|exists:users,id',
            'payment_method' => 'required|string',
            'total_amount' => 'required|string',
            'delivery_address' => 'required|string',
            'products' => 'required|array',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $data = $request->except(['_token', 'products']);

        // Generate unique order ID
        // $data['oid'] = uniqid();
        $data['order_number'] = Str::upper('ORD-' . Str::random(4) . rand(0, 100));

        // Determine payment status based on payment method
        $data['payment_status'] = ($data['payment_method'] == 'cod') ? 'unpaid' : 'paid';

        $data['condition'] = 'processing';
        $data['delivery_charge'] = 100;

        // Create the order
        $order = $this->order->create($data);

        // Store products associated with the order in product_orders table
        foreach ($request->input('products') as $product) {
            ProductOrder::create([
                'order_id' => $order->id,
                'product_id' => $product['product_id'],
                'quantity' => $product['quantity'],
            ]);
            // $this->order->products()->attach($product, ['quantity' => $product['quantity']]);
        }

        return response()->json(['message' => 'Order created successfully', 'order' => $order], 201);
    }

    public function getUserOrders(Request $request, $user_id)
    {
        // Retrieve orders for the specified user along with their associated products
        $orders = Order::with('products')->where('user_id', $user_id)->get();

        // Check if any orders are found
        if ($orders->isEmpty()) {
            return response()->json(['message' => 'No orders found for this user', 'orders' => []], 200);
        }

        // Return the orders with their associated products
        return response()->json(['orders' => $orders], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->order = $this->order->find($id);
        if (!$this->order) {
            //message
            return redirect()->back()->with('error', 'This order is not found');
        }

        $product_order = ProductOrder::where('order_id', $id)->get();
        return view('admin.single_order')
            ->with('order_data', $this->order)
            ->with('product_order', $product_order);
    }

    public function orderDetails($id)
    {
        $this->order = $this->order->find($id);
        if (!$this->order) {
            //message
            return redirect()->back()->with('error', 'This order is not found');
        }
        return view('admin.viewOrders')
            ->with('order_data', $this->order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->order = $this->order->find($id);
        if (!$this->order) {
            return redirect()->back()->with('error', 'This order is not found');
        }

        $del = $this->order->delete();
        if ($del) {
            return redirect()->route('order.index')->with('success', 'Order deleted successfully');
        } else {
            //message
            return redirect()->back()->with('error', 'Sorry! there was problem in deleting order');
        }
    }
}
