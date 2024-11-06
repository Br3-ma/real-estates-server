<?php

namespace App\Livewire\Dashboard;

use App\Models\Category;
use Livewire\Component;

class CategoryView extends Component
{
    public $categories;

    public function render()
    {
        $this->categories = Category::get();
        return view('livewire.dashboard.category-view')->layout('layouts.app');
    }
}
