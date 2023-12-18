<x-layout>
    <main class="container mx-auto py-5">
        <div class="flex justify- mb-5">
            <a href="/products/add" class="py-3 px-5 bg-blue-500 text-white rounded hover:opacity-90 ">Add New Product</a>
        </div>
        <table class="table-auto">
            <thead>
                <tr class="bg-slate-50 font-medium">
                    <td class="py-3 px-3 border border-slate-300">ID</td>
                    <td class="py-3 px-3 border border-slate-300">Product</td>
                    <td class="py-3 px-3 border border-slate-300">Highest</td>
                    <td class="py-3 px-3 border border-slate-300">Lowest</td>
                    <td class="py-3 px-3 border border-slate-300">Current</td>
                    <td class="py-3 px-3 border border-slate-300">Action</td>
                </tr>
            </thead>

            <tbody>
                @foreach ($products as $product)
                <tr>
                    <td class="py-3 px-3 border border-slate-300">{{ $product->id }}</td>
                    <td class="py-3 px-3 border border-slate-300">{{ $product->name }}</td>
                    <td class="py-3 px-3 border border-slate-300 text-red-500">Rs. {{ $product->highestPrice }}</td>
                    <td class="py-3 px-3 border border-slate-300 text-green-700">Rs. {{ $product->lowestPrice }}</td>
                    <td class="py-3 px-3 border border-slate-300 text-blue-900">Rs. {{ $product->currentPrice }}</td>
                    <td class="py-3 px-3 border border-slate-300">
                        <a href="/products/{{ $product->id }}" class="py-2 px-4 bg-blue-500 text-white rounded-sm text-sm hover:opacity-90">View</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</x-layout>
