<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Product</title>
    <!-- Include Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex items-center justify-center p-4">
        <div class="w-full max-w-md bg-white rounded-lg shadow-sm p-6">
            <!-- Form Header -->
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Create New Product</h2>

            <!-- Form Body -->
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Product Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        placeholder="e.g., Apple Watch"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required
                    />
                </div>

                <!-- Product Description -->
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="2"
                        placeholder="e.g., A smartwatch with advanced features"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    ></textarea>
                </div>

                <!-- Product Price -->
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1">Price</label>
                    <input
                        type="number"
                        id="price"
                        name="price"
                        step="0.01"
                        placeholder="e.g., 299.99"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        required
                    />
                </div>

                <!-- Product Image -->
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">Product Image</label>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 focus:outline-none"
                        required
                    />
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        Create Product
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
