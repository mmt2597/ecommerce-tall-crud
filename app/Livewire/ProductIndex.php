<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class ProductIndex extends Component
{
    use WithPagination;

    public $isModalOpen = false;
    public $products;

    public function mount()
    {
        $this->products = Product::get();
    }

    public function render()
    {
        return view('livewire.product-index');
    }
}
