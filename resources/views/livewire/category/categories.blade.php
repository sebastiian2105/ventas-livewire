<div class="row sales layout-top-spacing">

    <div class="col-sm-12">
        <div class="widget widget-chart-one">
            <div class="widget-heading">
                <h4 class="card-title">
                    <b>{{$componentName}} | {{$pageTitle}}</b>
                </h4>
                <ul class="tabs tab-pills">
                    <li>
                        <a href="javascript:void(0)" class="tabmenu bg-dark" data-toggle="modal"
                            data-target="#theModal">Agregar</a>
                    </li>
                    @can('Category_Create')
                    @endcan
                </ul>
            </div>
            @include('common.searchbox')
            @can('Category_Search')
            @endcan

            <div class="widget-content">


                <div class="table-responsive">
                    <table class="table table-bordered table striped mt-1">
                        <thead class="text-white" style="background: #3B3F5C">
                            <tr>
                                <th class="table-th text-white">Descripción</th>
                                <th class="table-th text-white text-center">Imagen</th>
                                <th class="table-th text-white text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $category)
                            <tr>
                                <td>
                                    <h6>{{$category->name}}</h6>
                                </td>
                                <td class="text-center">
                                    <span>
                                        <img src="{{ asset('storage/categories/' . $category->image) }}"
                                            alt="Imagen Producto" height="70" width="80" class="rounded">
                                    </span>
                                </td>

                                <td class="text-center">
                                    <a href="javascript:void(0)" wire:click="Edit({{$category->id}})"
                                        class="btn btn-dark mtmobile" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    {{-- @can('Category_Update')
                                    @endcan --}}


                                    @if($category->products->count() < 1)
                                    <a
                                        href="javascript:void(0)" onclick="Confirm('{{$category->id}}')"
                                        class="btn btn-dark" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    @endif 

                                    
                                    {{-- @if($category->products->count() < 1 )
                                        @can('Category_Destroy')

                                        @endcan
                                    @endif --}}



                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$categories->links()}}
                </div>

            </div>


        </div>


    </div>

    @include('livewire.category.form')
</div>


<script>
    document.addEventListener('DOMContentLoaded', function(){

		window.livewire.on('show-modal', msg =>{
			$('#theModal').modal('show')
		});
		window.livewire.on('category-added', msg =>{
			$('#theModal').modal('hide')
            noty(msg)
		});
		window.livewire.on('category-updated', msg =>{
			$('#theModal').modal('hide')
            noty(msg)
		});
		window.livewire.on('category-deleted', msg =>{
            noty(msg)
		});
	});



	function Confirm(id)
	{

		swal({
			title: 'Confirmar',
			text: '¿Deseas eliminar el registro?',
			type: 'warning',
			showCancelButton: true,
			cancelButtonText: 'Cerrar',
			cancelButtonColor: '#fff',
			confirmButtonColor: '#3B3F5C',
			confirmButtonText: 'Aceptar'
		}).then(function(result) {
			if(result.value){
				window.livewire.emit('deleteRow', id)
				swal.close()
			}

		})
	}


</script>