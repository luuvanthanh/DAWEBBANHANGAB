<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\storeRequestProduct;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class ProductController extends Controller
{
    public function getListProductOfMember()
    {
        $products = Product::paginate(config('app.paginate_product'));

        return view('frontend.products.list', compact('products'));
    }

    public function getCreate()
    {
        $categories = Category::pluck('name', 'id');
        $brands = Brand::pluck('name', 'id');

        return view('frontend.products.add', compact('categories', 'brands'));
    }

    public function postProduct(storeRequestProduct $request)
    {
        $files = [];
        if($request->hasfile('avatar'))
        {
            foreach($request->file('avatar') as $image)
            {

                $name = time().rand(1,50).'.'.$image->getClientOriginalName();
                // $name_2 = "2".$image->getClientOriginalName();
                // $name_3 = "3".$image->getClientOriginalName();

                $image->move('upload/product/', $name);
                // $image->move('upload/product/', $name_2);
                // $image->move('upload/product/', $name_3);
                
                // $path = public_path('upload/product/' . $name);
                // $path2 = public_path('upload/product/' . $name_2);
                // $path3 = public_path('upload/product/' . $name_3);

                // Image::make($image->getRealPath())->resize(85, 84)->save($path);
                // Image::make($image->getRealPath())->resize(329, 380)->save($path2);
                // Image::make($image->getRealPath())->save($path3);
                
                $files[] = $name;
            }
        }
        $files = json_encode($files);
        $data = $request->all(); 
        $file = $request->avatar;
        $userId = Auth::user()->id;
        if (!$data['saleValue']) {
            $data['saleValue'] = 0;
        }
        $product = Product::create([
            'name' => $data['name'],
            'price' => $data['price'],
            'image' => $files,
            'status' => $data['sale'],
            'sale' => $data['saleValue'],
            'user_id' => $userId,
            'brand_id' => $data['brand_id'],
            'category_id' => $data['category_id'],
        ]);

        if ($product) {

            return redirect()->route('listProduct')->with('success', 'Add product success');
        } else {

            return redirect()->route('listProduct')->with('error', 'Add product fail');
        }
    }
}
