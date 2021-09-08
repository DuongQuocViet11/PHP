<?php

namespace App\Http\Controllers;

class ProductController extends Controller
{
    public function index(){
        return view('index');

    }
    public function store(Request $request){
        $request ->validate([
            'product_code'=>'required',
            'product_name'=>'required',
            'product_price'=>'required',
            'product_image'=>'required',
        ]);
        Product::create($request->all());
        return redirect()->route('index')
            ->with('success','Chúc mừng bạn đã lưu thành công <3');
    }



    public function getDashboard()
    {
        $products = Product::all();
        return view('index', compact('products'));
    }
}
