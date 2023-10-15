<?php

namespace App\Livewire\Category;

use Livewire\Component;
use App\Models\Category;

class CatgoryComponent extends Component
{
    protected $listeners = ['category-create' => 'openModal', 'category-deleted' => 'showDeleteModal'];

    public $name;
    public $showModal = false;
    public $showDeleteModal = false;

    public $categoryId;

    public $page = 1;
    public $perPage = 10;
    public $sortColumn = 'created_at';
    public $sortDirection = 'asc';
    public $search = '';
    public $sortBy;
    public $sortAsc = true;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    protected $messages = [
        'name.required' => 'The name field is required.',
        'name.max' => 'The name may not be greater than 255 characters.',
    ];

    public function openModal()
    {
        // dd('open modal');
        $this->showModal = true;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createCategory()
    {
        $this->validate([
            'name' => 'required|min:5'
        ]);

        auth()->user()->categories()->create([
            'name' => $this->name
        ]);

        $this->showModal = false;
        $this->reset();
    }

    public function showEditModal($id)
    {
        $category = auth()->user()->categories()->findOrFail($id);
        $this->name = $category->name;
        $this->showModal = true;
    }

    public function update($id)
    {
        $category = auth()->user()->categories()->findOrFail($id);
        $category->update([
            'name' => $this->name
        ]);

        $this->showModal = false;
        $this->reset();
    }

    public function showDeleteModal($id)
    {
        $this->categoryId = $id;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $category = auth()->user()->categories()->findOrFail($this->categoryId);
        $category->delete();

        $this->showDeleteModal = false;
        $this->reset();
    }


    public function render()
    {
        $categories = Category::orderBy($this->sortColumn, $this->sortDirection)
            ->where('name', 'like', '%' . $this->search . '%')
            ->paginate($this->perPage, ['*'], 'page', $this->page);
        return view('livewire.category.catgory-component', [
            'categories' => $categories
        ]);
    }
}
