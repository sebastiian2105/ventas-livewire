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
    private $pagination = 4;  

    public function mount(){
        $this->pageTitle = 'Listado';
        $this->componentName = 'Categorias';
    }

    public function paginationView()
    {
        return 'vendor.livewire.bootstrap';
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

    public function Edit($id)
    {
        $record = Category::find($id, ['id', 'name', 'image']);
        $this->name = $record->name;
        $this->selected_id = $record->id;
        $this->image = null;

        $this->emit('show-modal', 'Editar');        
    }

    public function Store()
    {
        $rules = [
            'name' => 'required|unique:categories|min:3',
        ];

        $messages = [
            'name.required' => 'Nombre de categoria es requerido',
            'name.unique' => 'Ya existe el nombre de la categoria',
            'name.min' => 'El nombre de la categoria debe tener minimo 3 caracteres',
        ];

        $this->validate($rules, $messages);

        $category = Category::create([
            'name' => $this->name
        ]);

        $customFileName = '';
        if($this->image)
        {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/categories', $customFileName);
            $category->image = $customFileName;
            $category->save();
        }

        $this->resetUI();
        $this->emit('category-added', 'Categoria Registrada');

    }

    public function Update()
    {

        $rules = [
            'name' => "required|min:3|unique:categories,name,{$this->selected_id}",
        ];

        $messages = [
            'name.required' => 'Nombre de categoria es requerido',
            'name.unique' => 'Ya existe el nombre de la categoria',
            'name.min' => 'El nombre de la categoria debe tener minimo 3 caracteres',
        ];

        $this->validate($rules, $messages);

        $category = Category::find($this->selected_id);
        $category->update([
            'name' => $this->name
        ]);

        if($this->image)
        {
            $customFileName = uniqid() . '_.' . $this->image->extension();
            $this->image->storeAs('public/categories', $customFileName);
            $imageName = $category->image;

            $category->image = $customFileName;
            $category->save();

            if($imageName != null)
            {
                if(file_exists('storage/categories' . $imageName)){
                    unlink('storage/categories' . $imageName);
                }
            }
        }

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

}
