<?php

namespace App\Livewire\Dashboard;

use App\Models\PropertyPost;
use Livewire\Component;

class PostView extends Component
{
    public $posts;
    public function render()
    {
        $this->posts = PropertyPost::where('status_id', 1)->get();
        return view('livewire.dashboard.post-view')->layout('layouts.app');
    }
}
