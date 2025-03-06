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

        {{-- success alert --}}
        <x-success-alert />

        <!-- Page Header -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Product List</h1>
            <div class="flex justify-between space-x-5">
                <a href="{{ route('products.create') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    Add New Product
                </a>
                <div class="relative inline-block text-left">
                    <!-- Profile Icon -->
                    <button type="button" class="inline-flex items-center px-2 py-2 bg-gray-800 text-white rounded-full hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                        <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                        </svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div class="absolute right-0 z-10 hidden mt-1 origin-top-right rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" id="user-menu-dropdown">
                        <div class="bg-white rounded-md shadow-xs">
                            <div class="py-1">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="block px-5 py-2 text-md text-gray-700 hover:bg-gray-100">Logout</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Image
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse ($products as $product)
                        <tr>
                            <!-- Product Name -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $product->name }}</td>

                            <!-- Product Description -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                {{ Str::limit($product->description, 50) }}</td>

                            <!-- Product Price -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">Rs.
                                {{ number_format($product->price, 2) }}</td>

                            <!-- Product Image -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                        class="w-10 h-10 object-cover rounded-md">
                                @else
                                    <span class="text-sm text-gray-500">No Image</span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                <a href="{{ route('products.show', $product->id) }}"
                                    class="text-blue-600 hover:text-blue-900 mr-2">View</a>
                                <a href="{{ route('products.edit', $product->id) }}"
                                    class="text-green-600 hover:text-green-900 mr-2">Edit</a>
                                <form action="{{ route('products.delete', $product->id) }}" method="POST"
                                    class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">No products found.
                            </td>
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


    <script>
        // JavaScript to toggle the dropdown visibility
        const profileButton = document.querySelector('button[type="button"]');
        const dropdown = document.getElementById('user-menu-dropdown');

        profileButton.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
        });

        // Close dropdown if clicked outside
        window.addEventListener('click', (event) => {
            if (!profileButton.contains(event.target) && !dropdown.contains(event.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

</body>

</html>
