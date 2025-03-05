<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <!-- Include Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto p-4">
        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Product List</h1>
            <a href="{{ route('products.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                Add New Product
            </a>
        </div>

        <!-- Product Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($products as $product)
                        <tr>
                            <!-- Product Name -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $product->name }}</td>

                            <!-- Product Description -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ Str::limit($product->description, 50) }}</td>

                            <!-- Product Price -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Rs. {{ number_format($product->price, 2) }}</td>

                            <!-- Product Image -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-10 h-10 object-cover rounded-md">
                                @else
                                    <span class="text-sm text-gray-500">No Image</span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('products.show', $product->id) }}" class="text-blue-600 hover:text-blue-900 mr-2">View</a>
                                <a href="{{ route('products.edit', $product->id) }}" class="text-green-600 hover:text-green-900 mr-2">Edit</a>
                                <form action="{{ route('products.delete', $product->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No products found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if ($products->hasPages())
            <div class="mt-6">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</body>
</html>
