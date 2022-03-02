<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\storeRequestProduct;
use App\Http\Requests\product\updateProductRequest;
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
        $userId = Auth::user()->id;
        $dataImage = [];
        if($request->hasfile('avatar'))
        {

            foreach($request->file('avatar') as $image)
            {
                if (count($request->file('avatar')) <= 3) {
                    $name = $image->getClientOriginalName();
                    $name_2 = "84".$image->getClientOriginalName();
                    $name_3 = "85".$image->getClientOriginalName();
                    // kiểm tra folder đã tạo hay chưa nếu chưa thì tạo mới
                    if (!is_dir(public_path('upload/product/'.$userId.''))) {
                        mkdir(public_path('upload/product/'.$userId.''));
                    }
                    //truy cập đến đường dẫn
                    $path = public_path('upload/product/'.$userId.'/' . $name);
                    $path2 = public_path('upload/product/'.$userId.'/' . $name_2);
                    $path3 = public_path('upload/product/'.$userId.'/' . $name_3);

                    // set image vào đường dẫn khi set thì set size
                    Image::make($image->getRealPath())->resize(85, 84)->save($path);
                    Image::make($image->getRealPath())->resize(329, 380)->save($path2);
                    Image::make($image->getRealPath())->save($path3);
                    
                    $dataImage[] = $name;
                }else {
                    return redirect()->back()->with('error', 'Vui lòng chọn ít nhất 3 hình ảnh');
                }
                
            }
        }
        $files = json_encode($dataImage);
        $data = $request->all(); 
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

    public function getProduct($id)
    {
        $product = Product::find($id);
        $categories = Category::pluck('name', 'id');
        $brands = Brand::pluck('name', 'id');

        return view('frontend.products.edit', compact('product', 'categories', 'brands'));
    }
// unset
    public function updateProduct(updateProductRequest $request, $id)
    {
        $userId = Auth::user()->id;
        $product = Product::find($id);
        // Get image in database
        $images = json_decode($product->image, true);
        // Get image when use check
        $checkImages = $request->check;
        // Get image when request
        $files = $request->file('avatar');
        $data = $request->all();
        if ($checkImages != null) {
            foreach ($images as $key => $imgData) {
                if(in_array($imgData, $checkImages)){
                    unset($images[$key]);
                }
             }
        }
        $count = 0;
        if ($files != null) {
            $count = count($files);
        }
        $count = $count + count($images);   
        if ($request->hasfile('avatar')) {
            if ($count <= 3) {
                foreach ($files as $key => $fileItem) {
                    $name = $fileItem->getClientOriginalName();
                    $name_2 = "84".$fileItem->getClientOriginalName();
                    $name_3 = "85".$fileItem->getClientOriginalName();
                    // kiểm tra folder đã tạo hay chưa nếu chưa thì tạo mới
                    if (!is_dir(public_path('upload/product/'.$userId.''))) {
                        mkdir(public_path('upload/product/'.$userId.''));
                    }
                    //truy cập đến đường dẫn
                    $path = public_path('upload/product/'.$userId.'/' . $name);
                    $path2 = public_path('upload/product/'.$userId.'/' . $name_2);
                    $path3 = public_path('upload/product/'.$userId.'/' . $name_3);
    
                    // set image vào đường dẫn khi set thì set size
                    Image::make($fileItem->getRealPath())->resize(85, 84)->save($path);
                    Image::make($fileItem->getRealPath())->resize(329, 380)->save($path2);
                    Image::make($fileItem->getRealPath())->save($path3);
    
                    $images[] = $name;
                }
            }else{
                return redirect()->back()->with('error', 'Vui lòng chọn ít nhất 3 hình ảnh');
            }
        }
        $images = json_encode($images);
        // dd($images);
        if ($product) {
            $product->update([
                $product->name = $data['name'],
                $product->price = $data['price'],
                $product->image = $images,
                $product->status = $data['sale'],
                $product->sale = $data['saleValue'],
                $product->user_id = $userId,
                $product->category_id = $data['category_id'],
                $product->brand_id = $data['brand_id'],
            ]);
            return redirect()->route('listProduct')->with('success', 'Update product success');
        }else {
            return redirect()->back()->with('error', 'Update product fail');
        }
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();

        return redirect()->route('listProduct')->with('success', 'Delete product success');
    }
}
