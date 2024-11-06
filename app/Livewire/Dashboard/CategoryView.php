<?php

namespace App\Livewire\Dashboard;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Facades\Session;

class CategoryView extends Component
{
    public $categories;
    public $name, $desc, $icon_name;
    public $categoryId = null; // ID of the category being edited or deleted
    public $showModal = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'desc' => 'nullable|string',
        'icon_name' => 'nullable|string|max:255',
    ];

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function render()
    {
        return view('livewire.dashboard.category-view')->layout('layouts.app');
    }

    public function create()
    {
        $this->resetFields();
        $this->showModal = true;
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $this->categoryId = $id;
        $this->name = $category->name;
        $this->desc = $category->desc;
        $this->icon_name = $category->icon_name;
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        if ($this->categoryId) {
            $category = Category::findOrFail($this->categoryId);
            $category->update([
                'name' => $this->name,
                'desc' => $this->desc,
                'icon_name' => $this->icon_name,
            ]);
        } else {
            Category::create([
                'name' => $this->name,
                'desc' => $this->desc,
                'icon_name' => $this->icon_name,
            ]);
        }

        $this->resetFields();
        $this->categories = Category::all(); // Refresh categories list
        $this->showModal = false;
    }

    public function confirmDelete($id)
    {
        $this->categoryId = $id;
        $this->dispatchBrowserEvent('show-delete-confirmation');
    }

    public function delete()
    {
        if ($this->categoryId) {
            Category::findOrFail($this->categoryId)->delete();
            $this->categories = Category::all(); // Refresh categories list
            $this->resetFields();
        }
    }

    private function resetFields()
    {
        $this->categoryId = null;
        $this->name = '';
        $this->desc = '';
        $this->icon_name = '';
    }
}
