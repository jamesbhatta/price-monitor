<x-layout>
    <main class="container mx-auto py-5">
        <div class="mb-3">
            <a href="/" class="text-orange-500 underline">
                << Go Back</a>
        </div>

        <div class="grid grid-cols-12 gap-5">
            <div class="col-span-3">
                <aside class="sticky top-5 bg-neutral-50 py-8 px-5 rounded border border-neutral-200">
                    <div class="max-w-xs mx-auto mb-4">
                        <div class="aspect-square w-full">
                            <img class="h-full w-full object-cover object-center border border-neutral-100 rounded-md shadow-sm" src="{{ $product->imageUrl() }}" alt="{{ $product->name }}">
                        </div>
                    </div>
                    <h2 class="text-xl text-center font-medium leading-snug mb-10">{{ $product->name }}</h2>
                    <div class="text-center">
                        <a href="{{ $product->url }}" class="py-4 px-8 border-2 border-orange-500 text-orange-600 rounded font-medium hover:shadow-lg hover:bg-orange-50" target="_blank">
                            <img class="inline h-8 w-8 bg-transparent me-2" src="https://laz-img-cdn.alicdn.com/imgextra/i1/O1CN01V8uEDV1jdZ9U2wL90_!!6000000004571-73-tps-64-64.ico" alt="">
                            <span class="text-lg">Visit Store</span>
                        </a>
                    </div>
                </aside>
            </div>
            <div class="col-span-8">
                <table class="table-autos">
                    <thead>
                        <tr class="bg-neutral-50 font-medium">
                            <td class="py-3 px-10 border border-slate-300">Time</td>
                            <td class="py-3 px-10 border border-slate-300">Price</td>
                            <td class="py-3 px-10 border border-slate-300">State</td>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($prices as $price)
                        {{-- @php
                        if(isset($previous)) {
                        $state = $price->price == $previous->price
                            ? 'Same'
                            : ($price->price > $previous->price ? 'Increased' : 'Decreased');
                        }
                        @endphp --}}
                        <tr>
                            <td class="py-3 px-10 border border-slate-300"> {{ $price->created_at->diffForHumans() }}</td>
                            <td class="py-3 px-10 border border-slate-300">Rs. {{ $price->price }}</td>
                            <td class="py-3 px-10 border border-slate-300 text-gray-600 @if($price->state == 'Increased') text-red-500 @endif @if($price->state == 'Decreased') text-green-600  @endif">
                                <div class="inline-flex gap-2">
                                    @if($price->state == 'Same')
                                    <span>
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5L7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5"></path>
                                        </svg>
                                    </span>
                                    @endif
                                    @if($price->state == 'Increased')
                                    <span>
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 19.5v-15m0 0l-6.75 6.75M12 4.5l6.75 6.75"></path>
                                        </svg>
                                    </span>
                                    @endif
                                    @if($price->state == 'Decreased')
                                    <span>
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m0 0l6.75-6.75M12 19.5l-6.75-6.75"></path>
                                        </svg>
                                    </span>
                                    @endif
                                    <span> {{ $price->state }}</span>
                                </div>
                            </td>
                        </tr>
                        {{-- @php
                        $previous = $price;
                        @endphp --}}
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</x-layout>
