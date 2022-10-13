<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;

use Livewire\WithFileUploads;
use Livewire\WithPagination;
use Iluminate\Support\Facades\Storage;

class CategoriesController extends Component
{

    use WithFileUploads;
    use WithPagination;

    public $name, $search, $image, $selected_id, $pageTitle, $componetName;
    private $pagination = 5;  

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Categorias';
    }

    public function render()
    {
        
        $categories = Category::when($this->search , function($q) {
            $q->where('name', 'like', '%' .$this->search.'%');
        } )->orderBy('id', 'desc')->paginate($this->pagination);

        return view('livewire.category.categories', compact('categories'))
            ->extends('layouts.theme.app')
            ->section('content')
        ;
    }
}
