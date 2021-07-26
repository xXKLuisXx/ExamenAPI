<?php

namespace App\Http\Controllers;

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
        //
        return Product::all()->sortBy('precio')->values()->toJson();
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
        //
        $decodedRequest = json_decode(json_encode($request->all(), FALSE));
        $data = $request->all();

        $rules = [                                                          //Define the correct type of Data
            'nombre' => 'required|string',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'clasificacion' => 'required|string',
            'precio' => 'required|numeric',
        ];

        $validator = Validator::make($data, $rules);                        //Define a Validator for the Data
        $product = new Product();
        if($validator->passes()){ 
            $product->nombre = $decodedRequest->nombre;
            $product->marca = $decodedRequest->marca;
            $product->modelo = $decodedRequest->modelo;
            $product->clasificacion = $decodedRequest->clasificacion;
            $product->precio = $decodedRequest->precio;
            $product->save();
        }else {
            return response($validator->errors(), 400)->json();
        }

        return response()->json($product, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        return $product->toJson();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
        $decodedRequest = json_decode(json_encode($request->all(), FALSE));
        $data = $request->all();

        $rules = [                                                          //Define the correct type of Data
            'nombre' => 'required|string',
            'marca' => 'required|string',
            'modelo' => 'required|string',
            'clasificacion' => 'required|string',
            'precio' => 'required|numeric',
        ];

        $validator = Validator::make($data, $rules);                        //Define a Validator for the Data

        if($validator->passes()){ 
            $product->nombre = $decodedRequest->nombre;
            $product->marca = $decodedRequest->marca;
            $product->modelo = $decodedRequest->modelo;
            $product->clasificacion = $decodedRequest->clasificacion;
            $product->precio = $decodedRequest->precio;
            $product->save();
        }else {
            return response($validator->errors(), 400);
        }

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
        $temp = $product;
        $product->delete();

        return response()->json($temp, 200);
    }
}
