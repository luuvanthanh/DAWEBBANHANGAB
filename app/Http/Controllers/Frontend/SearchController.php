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
        if ($request->valueSearch) {
            $products = Product::where('name', 'LIKE', '%' . $request->valueSearch . '%')->get();
        }

        if ($request->category != 'category') {
            $products = Product::where('category_id', $request->category)->get();
        }

        if ($request->brand != 'brand') {
            $products = Product::where('brand_id', $request->brand)->get();
        }

        if ($request->valueSearch && $request->category != 'category') {
            $products = Product::where('name', 'LIKE', '%' . $request->valueSearch . '%')
                ->where('category_id', $request->category)
                ->get();
        }
        if ($request->valueSearch && $request->brand != 'brand') {
            $products = Product::where('name', 'LIKE', '%' . $request->valueSearch . '%')
                ->where('brand_id', $request->brand)
                ->get();
        }
        if ($request->category != 'category' && $request->brand != 'brand') {
            $products = Product::where('category_id', $request->category)
                ->where('brand_id', $request->brand)
                ->get();
        }
        if ($products != null) {
            return view('frontend.search.search-all', compact('products', 'categories', 'brands'));
        }else {
            return redirect()->back()->with('thongbao', 'Không có sản phẩm nào được tìm thấy');
        }
    }
}
