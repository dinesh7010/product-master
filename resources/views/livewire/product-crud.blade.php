<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-semibold mb-4">Product List</h2>

    <div class="p-4">
        <button wire:click="create" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">+ Add Product</button>

        @if (session()->has('message'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('message') }}
            </div>
        @endif

        <!-- Table -->
        <table class="min-w-full bg-white rounded shadow">
            <thead>
                <tr>
                    <th class="py-2 px-4 border">Name</th>
                    <th class="py-2 px-4 border">Code</th>
                    <th class="py-2 px-4 border">Type</th>
                    <th class="py-2 px-4 border">Category</th>
                    <th class="py-2 px-4 border">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td class="py-2 px-4 border">{{ $product->product_name }}</td>
                        <td class="py-2 px-4 border">{{ $product->unique_code }}</td>
                        <td class="py-2 px-4 border">{{ $product->product_type }}</td>
                        <td class="py-2 px-4 border">{{ $product->category }}</td>
                        <td class="py-2 px-4 border space-x-2">
                            <button wire:click="edit({{ $product->id }})" class="bg-yellow-500 text-white px-2 py-1 rounded">Edit</button>
                            <button wire:click="delete({{ $product->id }})" class="bg-red-500 text-white px-2 py-1 rounded">Delete</button>
                            <button wire:click="showQrCode({{ $product->id }})" class="bg-indigo-500 text-white px-2 py-1 rounded">QR</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Modal -->
        @if($isOpen)
            <div class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded shadow w-1/3">
                    <h2 class="text-xl font-bold mb-4">{{ $productId ? 'Edit Product' : 'Add Product' }}</h2>

                    <input type="text" wire:model="product_name" placeholder="Product Name" class="w-full mb-2 border px-3 py-2 rounded">
                    <input type="text" wire:model="unique_code" placeholder="Unique Code" class="w-full mb-2 border px-3 py-2 rounded">
                    <input type="text" wire:model="product_type" placeholder="Product Type" class="w-full mb-2 border px-3 py-2 rounded">
                    <input type="text" wire:model="category" placeholder="Category" class="w-full mb-2 border px-3 py-2 rounded">

                    <div class="flex justify-end space-x-2">
                        <button wire:click="store" class="bg-green-600 text-white px-4 py-2 rounded">Save</button>
                        <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    </div>
                </div>
            </div>
        @endif

        @if ($showQrModal && $qrProduct)
            <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                <div class="bg-white p-6 rounded shadow w-96 relative">
                    <button wire:click="$set('showQrModal', false)" class="absolute top-2 right-2 text-gray-600">✖</button>
                    <h2 class="text-lg font-bold mb-4">QR Code</h2>

                    <div class="flex justify-center mb-2">
                        {!! QrCode::size(200)->generate("Name: {$qrProduct->product_name}\nCode: {$qrProduct->unique_code}\nCategory: {$qrProduct->category}") !!}
                    </div>

                    <p class="text-center text-sm text-gray-500">Scan this code to view product details.</p>
                </div>
            </div>
        @endif

</div>

</div>
