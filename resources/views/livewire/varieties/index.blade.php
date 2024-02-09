<div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="search">Buscar</label>
                <div class="input-group">
                    <input wire:model="query" type="text" class="form-control no-hover" id="search" placeholder="Buscar variedades">
                    <div class="input-group-append">
                        <button wire:click="search" class="btn btn-light" type="button" data-toggle="tooltip" data-placement="top" title="Buscar" wire:loading.attr="disabled" wire:target="search" wire:loading.class="btn btn-light disabled">
                            <i class="zmdi zmdi-search"></i>
                        </button>
                        <button wire:click="clearSearch" class="btn btn-light" type="button">
                            <i class="zmdi zmdi-close"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-right">
            <div class="form-group">
                <label for="perPage">Mostrar</label>
                <select wire:model.live="perPage" class="form-control no-hover" id="perPage">
                    <option value="8">8</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="card-title">
            <h3 class="card-label">Variedades</h3>
        </div>
        @can('create varieties')
            <a href="{{ route('varieties.create') }}" class="btn btn-primary pb-1" wire:navigate>
                <i class="zmdi zmdi-plus"></i> Nuevo
            </a>
        @endcan
        @can('delete varieties')
            <button wire:click="showSoftDelete" class="btn btn-danger pb-1">
                <i class="zmdi zmdi-delete"></i> Papelera
            </button>
        @endcan
    </div>
    <div class="table-responsive">
        <table class="table table-striped bg-transparent">
            <thead>
            <tr>
                <th class="text-center" scope="col">Nombre</th>
                <th class="text-center" scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @forelse($varieties as $variety)
                <tr>
                    <td class="text-center">{{ $variety->name }}</td>
                    <td class="group-round text-center">
                        @can('update varieties')
                            <a href="{{ route('farms.edit', $variety->id) }}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Editar" wire:navigate>
                                <i class="zmdi zmdi-edit"></i>
                            </a>
                        @endcan
                        @if($variety->trashed())
                            @can('delete varieties')
                                <button wire:click="restore({{ $variety->id }})" class="btn btn-success btn-sm" data-toggle="tooltip" data-placement="top" title="Restaurar">
                                    <i class="zmdi zmdi-refresh"></i>
                                </button>
                                <button wire:click="forceDelete({{ $variety->id }})" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar permanentemente">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                            @endcan
                        @else
                            @can('delete varieties')
                                <button wire:click="delete({{ $variety->id }})" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Eliminar">
                                    <i class="zmdi zmdi-delete"></i>
                                </button>
                            @endcan
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" class="text-center">No hay registros para mostrar.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between mt-4 align-items-center">
        <div class="small text-muted">
            <span>Mostrando {{ $varieties->firstItem() }} a {{ $varieties->lastItem() }} de {{ $varieties->total() }} resultados</span>
        </div>
        <div class="small">
            {{ $varieties->withQueryString()->links() }}
        </div>
    </div>
</div>
