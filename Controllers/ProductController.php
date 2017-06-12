<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use Illuminate\Support\Facades\Input;
use File;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    	$products = Product::where('status', "Active")->get();
    	return view('product.index', compact('products'));
    }

    public function create()
    {
    	return view("product.create");
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
            'title' => 'required|unique:products',
            'category_id' => 'required',
            'url' => 'required|unique:products',
        ]);
    	//return $request->all();
        //print_r($request->file('front_image'));


        $product = new Product;
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->status = "Active";
        $product->url = $request->url;
        $product->save();



    	$pimg = ProductImage::where('product_id', $request->id)->delete();

    	//$picture = '';
        $frontFiles = $request->file('front_image');
        $frontLength = count($frontFiles);
        $backFiles = $request->file('back_image');
        $backLength = count($backFiles);

        if(($frontLength == 0) && ($backLength == 0)) {
            flash()->success('Successfully Inserted');
            return redirect('/product');
        }
        //if(($frontLength != 0) && ($backLength != 0)) {
            if ($frontLength >= $backLength) {
                
                foreach($frontFiles as $key => $file){
                    $destinationPath = 'uploads';
                    $extension = $frontFiles[$key]->getClientOriginalExtension();
                    $front = rand(11111, 99999) . '.' . $extension;
                    $frontFiles[$key]->move($destinationPath, $front);

                    if(isset($backFiles[$key]) != null) {
                        $destinationPath = 'uploads';
                        $extension = $backFiles[$key]->getClientOriginalExtension();
                        $back = rand(11111, 99999) . '.' . $extension;
                        $backFiles[$key]->move($destinationPath, $back);

                        $productImage = new productImage;
                        $productImage->product_id = $product->id;
                        $productImage->front_image = $front;
                        $productImage->back_image = $back;
                        $productImage->save();
                    } else {
                        $productImage = new productImage;
                        $productImage->product_id = $product->id;
                        $productImage->front_image = $front;
                        $productImage->back_image = '';
                        $productImage->save();
                    }
                    
                }
            }

            if ($frontLength < $backLength) {
                
                foreach($backFiles as $key => $file){
                    $destinationPath = 'uploads';
                    $extension = $backFiles[$key]->getClientOriginalExtension();
                    $back = rand(11111, 99999) . '.' . $extension;
                    $backFiles[$key]->move($destinationPath, $back);

                    if(isset($frontFiles[$key]) != null) {
                        $destinationPath = 'uploads';
                        $extension = $frontFiles[$key]->getClientOriginalExtension();
                        $front = rand(11111, 99999) . '.' . $extension;
                        $frontFiles[$key]->move($destinationPath, $front);

                        $productImage = new productImage;
                        $productImage->product_id = $product->id;
                        $productImage->front_image = $front;
                        $productImage->back_image = $back;
                        $productImage->save();
                    } else {
                        $productImage = new productImage;
                        $productImage->product_id = $product->id;
                        $productImage->front_image = '';
                        $productImage->back_image = $back;
                        $productImage->save();
                    }
                    
                }
            }
       // }
    	flash()->success('Successfully Inserted');
    	return redirect('/product');
    }

    public function test(Request $request)
    {
        $products = Product::where('url', $request->url)->first();
        if(isset($products)){
            $test = 'url already exist';
            echo '<p style="color: red">'.$test.'</p>';
        }
    }

    public function titleUnique(Request $request)
    {
        $products = Product::where('title', $request->title)->first();
        if(isset($products)){
            $test = 'title already exist';
            echo '<p style="color: red">'.$test.'</p>';
        }
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->status = "Inactive";
        $product->deleted_at = date("Y-m-d H:i:s");
        $product->save();
        flash()->error('Successfully deleted');
        return redirect('/product');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $productImages = ProductImage::where('product_id', $product->id)->get();
        $categories = Category::get();

        return view("product.edit", compact("product", "productImages", 'categories'));
    }

    public function update(Request $request)
    {
        //return $id;
        $p = Product::find($request->id);
        $this->validate($request, [
            'title' => 'required|unique:products,title,'.$p->id,
            'category_id' => 'required',
            'url' => 'required|unique:products,url,'.$p->id,
        ]);
        //dd($a);
        //return $request->id;
        $product = Product::find($request->id);
        $product->title = $request->title;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->status = "Active";
        $product->url = $request->url;
        $product->save();

        $deleteImg = ProductImage::where('product_id', $request->id)->delete();
        //exit();

        $oldFrontImg = $request->old_front_image;
        $oldBackImg = $request->old_back_image;
        //$frontFiles = $request->file('front_image');
        $oldFrontLength = count($oldFrontImg);
        //$backFiles = $request->file('back_image');
        $oldBackLength = count($oldBackImg);

        if ($oldFrontLength >= $oldBackLength && $oldFrontLength != 0) {
                
                foreach($oldFrontImg as $key => $file){
                    

                    if(isset($oldFrontImg[$key]) != null) {
                        
                        $productImage = new productImage;
                        $productImage->product_id = $product->id;
                        $productImage->front_image = $oldFrontImg[$key];
                        $productImage->back_image = $oldBackImg[$key];
                        $productImage->save();
                    } else {
                        $productImage = new productImage;
                        $productImage->product_id = $product->id;
                        $productImage->front_image = $oldFrontImg[$key];;
                        $productImage->back_image = '';
                        $productImage->save();
                    }
                    
                }
            }

            if ($oldFrontLength < $oldBackLength && $oldFrontLength != 0) {
                
                foreach($oldBackLength as $key => $file){
                    

                    if(isset($oldBackLength[$key]) != null) {
                        
                        $productImage = new productImage;
                        $productImage->product_id = $product->id;
                        $productImage->front_image = $oldFrontImg[$key];
                        $productImage->back_image = $oldBackImg[$key];
                        $productImage->save();
                    } else {
                        $productImage = new productImage;
                        $productImage->product_id = $product->id;
                        $productImage->front_image = '';
                        $productImage->back_image = $oldBackImg[$key];
                        $productImage->save();
                    }
                    
                }
            }




        

        

        $frontFiles = $request->file('front_image');
        $frontLength = count($frontFiles);
        $backFiles = $request->file('back_image');
        $backLength = count($backFiles);

        if(($frontLength == 0) && ($backLength == 0)) {
            flash()->success('Successfully Inserted');
            return redirect('/product');
        }
        //if(($frontLength != 0) && ($backLength != 0)) {
            if ($frontLength >= $backLength) {
                
                foreach($frontFiles as $key => $file){
                    $destinationPath = 'uploads';
                    $extension = $frontFiles[$key]->getClientOriginalExtension();
                    $front = rand(11111, 99999) . '.' . $extension;
                    $frontFiles[$key]->move($destinationPath, $front);

                    if(isset($backFiles[$key]) != null) {
                        $destinationPath = 'uploads';
                        $extension = $backFiles[$key]->getClientOriginalExtension();
                        $back = rand(11111, 99999) . '.' . $extension;
                        $backFiles[$key]->move($destinationPath, $back);

                        $productImage = new productImage;
                        $productImage->product_id = $product->id;
                        $productImage->front_image = $front;
                        $productImage->back_image = $back;
                        $productImage->save();
                    } else {
                        $productImage = new productImage;
                        $productImage->product_id = $product->id;
                        $productImage->front_image = $front;
                        $productImage->back_image = '';
                        $productImage->save();
                    }
                    
                }
            }

            if ($frontLength < $backLength) {
                
                foreach($backFiles as $key => $file){
                    $destinationPath = 'uploads';
                    $extension = $backFiles[$key]->getClientOriginalExtension();
                    $back = rand(11111, 99999) . '.' . $extension;
                    $backFiles[$key]->move($destinationPath, $back);

                    if(isset($frontFiles[$key]) != null) {
                        $destinationPath = 'uploads';
                        $extension = $frontFiles[$key]->getClientOriginalExtension();
                        $front = rand(11111, 99999) . '.' . $extension;
                        $frontFiles[$key]->move($destinationPath, $front);

                        $productImage = new productImage;
                        $productImage->product_id = $product->id;
                        $productImage->front_image = $front;
                        $productImage->back_image = $back;
                        $productImage->save();
                    } else {
                        $productImage = new productImage;
                        $productImage->product_id = $product->id;
                        $productImage->front_image = '';
                        $productImage->back_image = $back;
                        $productImage->save();
                    }
                    
                }
            }
       // }
        flash()->success('Successfully Inserted');
        return redirect('/product');
    }
}
