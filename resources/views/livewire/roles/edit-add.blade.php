<div>
    <div class="card-title">{{ $titlePage }}</div>
    <form wire:submit.prevent="save">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input wire:model="name" type="text" class="form-control no-hover" id="name" placeholder="Nombre del rol">
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group" wire:ignore>
            <label for="permissions">Permisos</label>
            @forelse($permissions->groupBy('table_name') as $key => $permission)
                <div class="parent form-check">
                    <label>{{ $key }}</label>
                </div>
            <div>
                <ul class="child">
                    @foreach($permission as $item)
                        <li class="form-check">
                            <input wire:model="permissionsSelected" type="checkbox" class="form-check-input" id="permission_{{ $item->id }}" value="{{ $item->id }}">
                            <label class="form-check"> {{ __($item->name) }}</label>
                        </li>
                    @endforeach
                </ul>
            </div>
            @empty
                <div class="alert alert-warning">
                    <span>No hay permisos</span>
                </div>
            @endforelse
        </div>
        <button type="submit" class="btn btn-white">Guardar</button>
    </form>
</div>
