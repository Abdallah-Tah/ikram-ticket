<?php

namespace App\Livewire\Forms\Categroy;

use App\Models\Category;
use Livewire\Attributes\Rule;
use Livewire\Form;

class FormCategory extends Form
{
    #[Rule('required|min:5')]
    public $name = '';

   public $showModal = false;

   public ?Category $category = null;

    public function setCategroy(Category $category)
    {
        $this->category = $category;
        $this->name = $category->name;
        $this->showModal = true;
    }

    public function create()
    {
        $this->validate();

        $this->category = Category::create([
            'name' => $this->name,
            'user_id' => auth()->id()
        ]);

        $this->showModal = false;
        $this->reset();
    }

    public function render()
    {
        return view('livewire.forms.categroy.form-category');
    }
}
