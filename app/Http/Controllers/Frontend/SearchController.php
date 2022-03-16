<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function getSearchAll()
    {
        $categories = Category::pluck('name', 'id');
        $brands = Brand::pluck('name', 'id');

        return view('frontend.search.search-all', compact('categories', 'brands'));
    }

    public function searchName(Request $request)
    {
        $valueSearch = $request->valueSearch;
        $products = DB::table('products')->where('name', 'like', '%' . $valueSearch . '%')->get();

        return view('frontend.search.search-name', compact('products'));
    }

    public function searchAllValue(Request $request)
    {
        $products = '';
        $categories = Category::pluck('name', 'id');
        $brands = Brand::pluck('name', 'id');
        $products = Product::orderByDesc('created_at');
        if ($request->valueSearch) {
            echo 1;
            $products->where('name', 'LIKE', '%' . $request->valueSearch . '%');
        }

        if ($request->category != 'category') {
            echo 2;
            $products->where('category_id', $request->category);
        }

        if ($request->brand != 'brand') {
            echo 3;
            $products->where('brand_id', $request->brand);
        }
        
        $results = $products->get();
       
        if ($results != null) {
            return view('frontend.search.search-all', compact('results', 'categories', 'brands'));
        }else {
            return redirect()->back()->with('thongbao', 'Không có sản phẩm nào được tìm thấy');
        }
    }

    public function searchPrice(Request $request)
    {
        $price = $request->price;
        $arPrice = explode(' ' ,$price);
        $products = Product::whereBetween('price', [$arPrice[0], $arPrice[2]])->get();
        return response()->json([
            'products' => $products,
        ]);
    }
}
