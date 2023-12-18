<?php

namespace App\Http\Controllers;

use App\Jobs\FetchPrice;
use App\Models\Price;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('prices')->latest('id')->get();

        $products->map(function ($product) {
            $product['highestPrice'] = $product->prices->max('price');
            $product['lowestPrice'] = $product->prices->min('price');
            $product['currentPrice'] = $product->prices->last()?->price;
            return $product;
        });

        return view('products', [
            'products' => $products
        ]);
    }

    public function show(Product $product)
    {
        $product->load(['prices' => fn ($q) => $q->latest()]);

        $prices = $product->prices->map(function (Price $price) use ($product) {
            $previousPrice = $product->prices->after($price)?->price;
            if ($previousPrice) {
                $price['state'] = $previousPrice == $price->price ? 'Same' : ($previousPrice > $price->price ? 'Decreased' : 'Increased');
            } else {
                $price['state'] = '';
            }

            return $price;
        });

        return view('show', [
            'product' => $product,
            'prices' => $prices
        ]);
    }

    public function create()
    {
        return view('add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'url' => ['required', 'url']
        ]);

        try {
            DB::beginTransaction();
            $product = Product::query()->updateOrCreate([
                'name' => $request->name,
                'url' => $request->url
            ]);

            FetchPrice::dispatchSync($product);
            DB::commit();
            return redirect()->to('/');
        } catch (\Throwable $th) {
            DB::rollBack();
            report($th);
            throw ValidationException::withMessages(['name' => "Error: {$th->getMessage()}"]);
        }
    }
}
