<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Mechanics;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product = Product::all();

        return response($product);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'name' => 'required | unique:product| max:119',
            'image' => 'required',
            'brand_id' => 'required',
            'category_id' => 'required',
            'quantity' => 'required',
            'price' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->messages()
            ], 400);
        } else {
            $product = new Product();
            $product->name = $request->name;
            $product->image = $request->image;
            $product->brand_id = $request->brand_id;
            $product->category_id = $request->category_id;
            $product->quantity = $request->quantity;
            $product->price = $request->price;
            $product->save();
            return response()->json([
                'status' => 200,
                'message' => 'Product (' . $product->name . ') Created Successfully'
            ], 200);
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
        // $product = Product::findOrFail($id);
        $product = Product::find($id);
        if ($product) {
            return response($product);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'product id ' . $id . ' not found'
            ], 404);
        }
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
        $product = Product::find($id);
        if ($product) {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:product,name,' . $id,
                'image' => 'required',
                'brand_id' => 'required',
                'category_id' => 'required',
                'quantity' => 'required',
                'price' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status' => 400,
                    'message' => $validator->messages(),
                ], 400);
            } else {

                $product->name = $request->name;
                $product->image = $request->image;
                $product->brand_id = $request->brand_id;
                $product->category_id = $request->category_id;
                $product->quantity = $request->quantity;
                $product->price = $request->price;
                $product->update();
                return response()->json([
                    'status' => 200,
                    'message' => $product->name . ' updated',
                ], 200);
            }
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Product Id ' . $id . ' not found'
            ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return response()->json([
                'message' => 'Id (' . $id . ') and name (' . $product->name . ') deleted'
            ]);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Product ' .$id. ' not found'
            ], 404);
        }
    }

    public function relation(Request $request){
        // $data = Product::with('brand')->get();
        // print_r($data->toArray());

        $data = Mechanics::with('carOwnerData')->get();
        echo'<pre/>';
        print_r($data->toArray());

    }
}
