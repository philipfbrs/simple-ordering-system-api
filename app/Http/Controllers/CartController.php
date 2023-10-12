<?php

namespace App\Http\Controllers;

use App\Jobs\PurchaseEmailJob;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        try {
            $input = $request->only('order_by', 'product_id', 'quantity');

            $orderBy = User::where('id', $input['order_by'])->first();

            if (!$orderBy)
                return response((array) 
                    [
                        'message' => 'User does not exist',
                        'status' => "error"
                    ], 404);

            $product = Product::where('id', $input['product_id'])->first();

            if (!$product)
                return response((array) 
                    [
                        'message' => 'User does not exist',
                        'status' => "error"
                    ], 404);

            $hasItem = Cart::where('product_id', $input['product_id'])->where('order_by', $input['order_by'])->where('status', 'Pending')->first();

            if ($hasItem) {
                $updateItem = Cart::where('product_id', $input['product_id'])->where('order_by', $input['order_by'])->where('status', 'Pending')->update(['quantity' => (int) ($hasItem['quantity'] + $input['quantity'])]);
            } else {
                $createItem = Cart::create($input);
            }

            return response((array) 
                [
                    'message' => 'Product: ' . $product['name'] . ' Added to cart successfully',
                    'status' => "success"
                ], 201);

        } catch (Exception $err) {
            return response((array) 
                [
                    'message' => 'Internal Server Error',
                    'status' => "error"
                ], 500);
        }

    }

    public function getCart(Request $request)
    {
        try {
            $input = $request->only('page', 'limit', 'search', 'filter', 'tabStatus');
            $cart = Cart::select('id', 'order_by', 'product_id', 'quantity')->with('product');

            $data = $cart->skip($input['page'] * $input['limit'])->take($input['limit']);
            $totalData = Cart::count();

            $fetch = $data->when($input['tabStatus'] == "archived", function ($query) use ($input, $totalData) {
                $query = $query->onlyTrashed();
            })->when(!empty($input['search'] && $input['tabStatus'] == "all"), function ($query) use ($input, $totalData, $cart) {
                $query = $query->where('order_by', $input['search']);
            });

            $fetch = $fetch->get();

            if (!empty($input['search'])) {
                $totalData = $cart->where('order_by', $input['search'])->count();
            }

            if ($input['tabStatus'] == "archived") {
                $totalData = $cart->onlyTrashed()->count();
            }

            return response((array) [
                'data' => $fetch,
                'total' => $totalData,
            ], 200)
                ->header('Content-Type', 'application/json');
        } catch (Exception $err) {
            return response((array) 
                [
                    'message' => 'Internal Server Error',
                    'status' => "error"
                ], 500);
        }
    }

    public function purchaseOrder(Request $request)
    {
        try {

            $id = $request->route('id');

            $orderBy = User::where('id', $id)->first();

            if (!$orderBy)
                return response((array) 
                    [
                        'message' => 'User does not exist',
                        'status' => "error"
                    ], 404);

            $cart = Cart::select('id', 'order_by', 'product_id', 'quantity')->with('user')->with('product')->where('order_by', $id)->where('status', 'Pending')->get();

            if (count($cart) <= 0)
                return response((array) 
                    [
                        'message' => 'Cart is empty',
                        'status' => "error"
                    ], 400);

            $cart_ids = array_column($cart->toArray(), 'id',null);

            $update = Cart::whereIn('id',$cart_ids)->update(['status' => 'Paid']);

            $totalAmount = 0;

            foreach ($cart as $key => $value) {
                $totalAmount += $value->quantity * $value->product->price;
            }

            $fetchTable = ['data' => $cart, 'total' => $totalAmount];

            dispatch(new PurchaseEmailJob($fetchTable, 'philipfbrs@gmail.com', 'Purchased Order'));

            return response((array) [
                'message' => 'Purchased complete!',
                'status' => 'success',
            ], 200)
                ->header('Content-Type', 'application/json');
        } catch (Exception $err) {
            return response((array) 
                [
                    'message' => $err->getMessage(),
                    'status' => "error"
                ], 500);
        }
    }

}