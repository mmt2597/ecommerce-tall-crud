<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryIndex extends Component
{
    use WithPagination;

    public $isModalOpen = false;

    public $categoryName;
    public $categoryId;

    public function toggleModal($resetForm = false)
    {
        $this->isModalOpen = !$this->isModalOpen;
        if ($resetForm) {
            $this->reset(['category', 'categoryId', 'categoryName']);
        }
    }

    public function createCategory()
    {
        Category::create(['name' => $this->categoryName]);

        $this->reset(['isModalOpen', 'categoryName']);
        session()->flash('flash.banner', 'Category Created Successfully!');
    }

    public function showEditCategoryModal($id)
    {
        $category = Category::find($id);
        $this->categoryName = $category->name;
        $this->categoryId = $id;
        $this->toggleModal();
    }

    public function updateCategory()
    {
        $category = Category::find($this->categoryId);
        $category->update([
            'name' => $this->categoryName,
        ]);

        $this->reset(['isModalOpen', 'categoryName', 'categoryId']);
        session()->flash('flash.banner', 'Category Updated Successfully!');
    }

    public function deleteCategory($id)
    {
        Category::findOrFail($id)->delete();
        $this->reset();
        session()->flash('flash.banner', 'Category Deleted Successfully!');
    }

    public function render()
    {
        $categories = Category::paginate(10);
        return view('livewire.category-index', compact('categories'));
    }
}