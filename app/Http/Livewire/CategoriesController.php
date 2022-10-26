<?php

namespace App\Http\Livewire;

use App\Helpers\GlobalApp;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $name, $search, $image, $selected_id = 0, $pageTitle, $componentName;
    private $pagination = 5;

    public function mount()
    {
        $this->pageTitle = 'Listado';
        $this->componentName = 'Categorías';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
    }

    public function render()
    {
        $categories = Category::when($this->search, function($q) {
            $q->where('name', 'like', '%' . $this->search . '%');
        })->orderBy('id', 'desc')->paginate($this->pagination);

        return view('livewire.category.categories', compact('categories'))
                ->extends('layouts.theme.app')
                ->section('content');
    }

    public function Edit(Category $category)
    {
        $this->name = $category->name;
        $this->selected_id = $category->id;
        $this->image = null;

        $this->emit('show-modal', 'Editar');
    }

    public function Store()
    {
        $rules = $this->getRulesAndMessages('store');
        $this->validate($rules['rules'], $rules['messages']);
        $data['name'] = $this->name;

        if($this->image) {
            $customFileName = GlobalApp::saveFile($this->image, 'categories');
            $data['image'] = $customFileName;
        }

        Category::create($data);

        $this->resetUI();
        $this->emit('category-added', 'Categoria Registrada');
    }

    public function Update()
    {
        $rules = $this->getRulesAndMessages('update');
        $this->validate($rules['rules'], $rules['messages']);
        $data['name'] = $this->name;

        $category = Category::find($this->selected_id);

        if($this->image) {
            $customFileName = GlobalApp::saveFile($this->image, 'categories');
            $data['image'] = $customFileName;

            if ($category->image != null && file_exists('storage/categories/' . $category->image)) {
                unlink('storage/categories/'. $category->image);
            }
        }

        $category->update($data);

        $this->resetUI();
        $this->emit('category-updated', 'Categoria Actualizada');
    }

    public function resetUI()
    {
        $this->name = '';
        $this->image = null;
        $this->search = '';
        $this->selected_id = 0;
    }

    protected function getRulesAndMessages($type = null)
    {
        $rules = [
            'name' => 'required|min:3|unique:categories',
        ];

        $type === 'update' && $rules['name'] .= ",name,{$this->selected_id}";

        $messages = [
            'name.required' => 'El nombre de la categoria es requerido',
            'name.unique' => 'El nombre de la categoria ya existe',
            'name.min' => 'El nombre de la categoria debe tener minimo 3 caracteres',
        ];

        return [
            'rules' => $rules,
            'messages' => $messages
        ];
    }
}