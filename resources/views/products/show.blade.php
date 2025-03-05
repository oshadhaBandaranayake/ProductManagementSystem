<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <!-- Include Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-sm p-6">
            <!-- Page Header -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-semibold text-gray-800">Product Details</h1>
                <a href="{{ route('products.index') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Back to List
                </a>
            </div>

            <!-- Product Details -->
            <div class="space-y-4">
                <!-- Product Name -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Name</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $product->name }}</p>
                </div>

                <!-- Product Description -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <p class="mt-1 text-gray-900">{{ $product->description }}</p>
                </div>

                <!-- Product Price -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Price</label>
                    <p class="mt-1 text-gray-900">Rs. {{ number_format($product->price, 2) }}</p>
                </div>

                <!-- Product Image -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">Image</label>
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="mt-2 w-48 h-48 object-cover rounded-md">
                    @else
                        <p class="mt-2 text-sm text-gray-500">No image available.</p>
                    @endif
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="mt-6 flex space-x-4">
                <a href="{{ route('products.edit', $product->id) }}" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                    Edit Product
                </a>
                <form action="{{ route('products.delete', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                        Delete Product
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
