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
    public function uploadFile($arrImage, $userId)
    {
        $images=[];
        if (count($arrImage) <= 3) {
            foreach($arrImage as $image)
            {
                $name = time().$image->getClientOriginalName();
                $name_2 = time().$image->getClientOriginalName();
                $name_3 = time().$image->getClientOriginalName();
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
                
                $images[] = $name;
            } 
        }else {
            return redirect()->back()->with('error', 'Vui lòng chọn ít nhất 3 hình ảnh');
        }
        return $images;
    }

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
        $images = $request->file('avatar');
        if($request->hasfile('avatar'))
        {
            $dataImage = $this->uploadFile($images, $userId);
        }
        $files = json_encode($dataImage);
        $data = $request->all(); 
        $userId = Auth::user()->id;
        if (!$data['saleValue']) {
            $data['saleValue'] = 0;
        }
        if (count($images) <= 3) {
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
        }else{
            return redirect()->back()->with('error', 'Vui lòng chọn ít nhất 3 hình ảnh');
        }
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

    public function updateProduct(updateProductRequest $request, $id)
    {
        $userId = Auth::user()->id;
        $array = [];
        $arrayMerge = [];
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
        // set key của mảng lại vị trí ban đầu là 0
        reset($images);
        $count = 0;
        if ($files != null) {
            $count = count($files);
        }

        // cout mảng cũ cộng count của mảng mới
        $count = $count + count($images);   
        if ($request->hasfile('avatar')) {
            if ($count <= 3) {
                $array = $this->uploadFile($files, $userId);
            }else{
                return redirect()->back()->with('error', 'Hình ảnh phải nhỏ hơn 3');
            }
        }
        $arrayMerge = array_merge($images, $array);
        $images = json_encode($arrayMerge);
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

    public function getDetailProduct($id)
    {
        $product = Product::with('brand')->find($id);

        return view('frontend.products.detail', compact('product'));
    }

}
