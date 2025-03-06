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
        protected ProductsInterface $productsInterface
    ) {}
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
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // Prepare product data array
        $requestData = $request->all();
        $requestData['image'] = $imagePath;

        // Create product using repository pattern
        $this->productsInterface->create($requestData);

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
        if ($request->hasFile('image')) {
            //delete old image
            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
            //store new image
            $imagePath = $request->file('image')->store('products', 'public');
        }

        //get validate data from the request
        $requestData = $request->all();

        //add image path to request array if there is an image
        if ($imagePath) {
            $requestData['image'] = $imagePath;
        }

        $this->productsInterface->update($product->id, $requestData);
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
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        //delete product
        $this->productsInterface->deleteById($product->id);
        return redirect()->route('products.index')->with('success', 'Product deleted successfully!');
    }
}
