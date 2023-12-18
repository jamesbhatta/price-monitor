<x-layout>
    <main class="container mx-auto py-5">
        <div class="mb-3">
            <a href="/" class="text-blue-500 underline">
                << Go Back</a>
        </div>
        <h2 class="text-xl font-medium mb-4">Add Product</h2>

        <form action="/products" method="POST">
            @csrf
            <div class="mb-3">
                <label class="block text-sm font-medium leading-6 text-gray-900 mb-3">Name</label>
                <input type="text" name="name" class="block w-full rounded-md border py-2 px-2 text-gray-900 shadow-sm  sm:text-sm sm:leading-6 placeholder:text-gray-400 focus:outline-0 focus:ring focus:ring-blue-400" value="{{ old('name') }}">
                <x-invalid-feedback field="name" />
            </div>
            <div class="mb-3">
                <label class="block text-sm font-medium leading-6 text-gray-900 mb-3">URL</label>
                <input type="url" name="url" class="block w-full rounded-md border py-2 px-2 text-gray-900 shadow-sm  sm:text-sm sm:leading-6 placeholder:text-gray-400 focus:outline-0 focus:ring focus:ring-blue-400" value="{{ old('url') }}">
                <x-invalid-feedback field="url" />
            </div>

            <div class="mb-3">
                <button class="py-3 px-5 bg-blue-500 text-white rounded hover:opacity-90">Add Product</button>
            </div>

        </form>

    </main>
</x-layout>
