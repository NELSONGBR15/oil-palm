<div>
    <div class="card-title">{{ $titlePage }}</div>
    <form wire:submit.prevent="save">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input wire:model="name" type="text" class="form-control no-hover" id="name" placeholder="Nombre del cargo">
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button type="submit" class="btn btn-white">Guardar</button>
    </form>
</div>
