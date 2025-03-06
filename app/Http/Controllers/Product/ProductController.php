<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductsCreateRequest;
use App\Http\Requests\Products\ProductsUpdateRequest;
use App\Models\Product;
use App\Repositories\Products\ProductsInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function __construct(
        protected ProductsInterface $productsRepository
    )
    {

    }
    /**
     * Method index
     *
     * @return void
     */
    public function index()
    {
        //6 products per page
        $products = Product::paginate(6);
        return view('products.index', compact('products'));
    }

    /**
     * Method create
     *
     * @return void
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Method store
     *
     * @param ProductsCreateRequest $request [explicite description]
     *
     * @return void
     */
    public function store(ProductsCreateRequest $request)
    {
        //handle image upload
        $imagePath = null;
        if ($request->hasFile('image')){
            $imagePath = $request->file('image')->store('products', 'public');
        }

        //create product
        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);


        return redirect()->route('products.index')->with('success', 'Product created successfully!');
    }

    /**
     * Method show
     *
     * @param Product $product [explicite description]
     *
     * @return void
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Method edit
     *
     * @param Product $product [explicite description]
     *
     * @return void
     */
    public function edit(Product  $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Method update
     *
     * @param ProductsUpdateRequest $request [explicite description]
     * @param Product $product [explicite description]
     *
     * @return void
     */
    public function update(ProductsUpdateRequest $request, Product $product)
    {
        //handle image upload
        $imagePath = $product->image;
        if ($request->hasFile('image')){
            //delete old image
            if($imagePath){
                Storage::disk('public')->delete($imagePath);
            }
            //store new image
            $imagePath = $request->file('image')->store('products', 'public');
        }

        //update product
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Method destroy
     *
     * @param Product $product [explicite description]
     *
     * @return void
     */
    public function destroy(Product $product)
    {
        //delete product image
        if($product->image){
            Storage::disk('public')->delete($product->image);
        }
        //delete product
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
