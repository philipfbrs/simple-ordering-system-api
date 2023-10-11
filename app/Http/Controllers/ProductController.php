<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Exception;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    // CREATE PRODUCT
    //
    public function createProduct(Request $request)
    {
        try {
            $input = $request->only('name', 'price');

            $create = Product::create($input);
            return response((array) 
                [
                    'message' => 'Product: ' . $input['name'] . ' Created Successfully',
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

    //
    // UPDATE PRODUCT
    //

    public function updateProduct(Request $request)
    {
        try {

            $input = $request->only('name', 'price');

            $id = $request->route('id');

            $isDataExist = Product::where('id', $id)->first();

            if (!$isDataExist)
                return response((array) 
                    [
                        'message' => 'Product does not exist',
                        'status' => "error"
                    ], 404);

            $update = Product::where('id', $id)->update($input);
            return response((array) 
                [
                    'message' => 'Product: ' . $id . ' Updated Successfully',
                    'status' => "success"
                ], 200);
        } catch (Exception $err) {
            return response((array) 
                [
                    'message' => 'Internal Server Error',
                    'status' => "error"
                ], 500);
        }
    }

    //
    // DELETE PRODUCT
    //

    public function deleteProduct(Request $request)
    {
        try {
            $id = $request->route('id');

            $isDataExist = Product::where('id', $id)->first();

            if (!$isDataExist)
                return response((array) 
                    [
                        'message' => 'Product does not exist',
                        'status' => "error"
                    ], 404);

            $delete = $isDataExist->delete();
            return response((array) 
                [
                    'message' => 'Product: ' . $id . ' Deleted Successfully',
                    'status' => "success"
                ], 200);

        } catch (Exception $err) {
            return response((array) 
                [
                    'message' => 'Internal Server Error',
                    'status' => "error"
                ], 500);
        }
    }

    //
    // GET PRODUCT
    //

    public function getProduct(Request $request)
    {
        try {
            $input = $request->only('page', 'limit', 'search', 'filter', 'tabStatus');
            $product = Product::select('id', 'name', 'price', 'created_at');
            $data = $product->skip($input['page'] * $input['limit'])->take($input['limit']);
            $totalData = Product::count();

            $fetch = $data->when($input['tabStatus'] == "archived", function ($query) use ($input, $totalData) {
                $query = $query->onlyTrashed();
            })->when(!empty($input['search'] && $input['tabStatus'] == "all"), function ($query) use ($input, $totalData, $product) {
                $query = $query->where('id', 'LIKE', '%' . $input['search'] . '%')->orWhere('name', 'LIKE', '%' . $input['search'] . '%');
            });

            $fetch = $fetch->get();

            if (!empty($input['search'])) {
                $totalData = $product->where('id', 'LIKE', '%' . $input['search'] . '%')->orWhere('name', 'LIKE', '%' . $input['search'] . '%')->count();
            }

            if ($input['tabStatus'] == "archived") {
                $totalData = $product->onlyTrashed()->count();
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

}