<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ProductCrud extends Component
{
    public $products, $product_name, $unique_code, $product_type, $category, $productId;
    public $updateMode = false;

    public $showQr = false;
    public $selectedProduct;
    public $isOpen = 0;

    public $showQrModal = false;
    public $qrProduct;

    public function showQrCode($id)
    {
        $this->qrProduct = Product::find($id);
        $this->showQrModal = true;
    }


    public function showQr($id)
    {
        $this->selectedProduct = Product::find($id);
        $this->showQr = true;
    }

    public function closeQr()
    {
        $this->showQr = false;
        $this->selectedProduct = null;
    }
    public function mount()
    {
        $this->products = Product::all();
    }

    public function render()
    {
        return view('livewire.product-crud');
    }
    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }
    public function openModal()
    {
        $this->isOpen = true;
    }
    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function resetInputFields()
    {
        $this->product_name = '';
        $this->unique_code = '';
        $this->product_type = '';
        $this->category = '';
        $this->productId = '';
    }

    public function store()
    {
        $this->validate([
            'product_name' => 'required',
            'unique_code' => 'required|unique:products,unique_code,' . $this->productId,
            'product_type' => 'required',
            'category' => 'required',
        ]);

        Product::updateOrCreate(['id' => $this->productId], [
            'product_name' => $this->product_name,
            'unique_code' => $this->unique_code,
            'product_type' => $this->product_type,
            'category' => $this->category,
        ]);
        $this->products = Product::all();
        session()->flash('message', $this->productId ? 'Product Updated.' : 'Product Created.');

        $this->closeModal();
        $this->resetInputFields();
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->productId = $id;
        $this->product_name = $product->product_name;
        $this->unique_code = $product->unique_code;
        $this->product_type = $product->product_type;
        $this->category = $product->category;
        $this->openModal();
    }

    public function delete($id)
    {
        Product::find($id)->delete();
        $this->products = Product::all();
        session()->flash('message', 'Product deleted successfully.');

    }
}
