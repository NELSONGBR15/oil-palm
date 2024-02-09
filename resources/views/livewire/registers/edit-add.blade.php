<div>
    <div class="card-title">{{ $titlePage }}</div>
    <form wire:submit.prevent="save">
        <div class="form-group">
            <label for="line">Linea</label>
            <input wire:model="line" type="text" class="form-control no-hover" id="line" placeholder="Linea">
            @error('line') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label for="palm">Palma</label>
            <input wire:model="palm" type="text" class="form-control no-hover" id="palm" placeholder="Palma">
            @error('palm') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label for="date">Fecha</label>
            <input wire:model="date" type="date" class="form-control no-hover" id="date" placeholder="Fecha">
            @error('date') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label for="disease">Enfermedad</label>
            <select wire:model="disease" class="form-control no-hover" id="disease">
                <option value>Seleccione una enfermedad</option>
                @foreach($diseases as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('disease') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label for="lot">Lotes</label>
            <select wire:model="lot" class="form-control no-hover" id="lot">
                <option value>Seleccione un lote</option>
                @foreach($lots as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('lot') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label for="user">Usuario</label>
            <select wire:model="user" class="form-control no-hover" id="user">
                <option value>Seleccione un usuario</option>
                @foreach($users as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('user') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button type="submit" class="btn btn-white">Guardar</button>
    </form>
</div>
