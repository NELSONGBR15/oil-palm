<div>
    <div class="card-title">{{ $titlePage }}</div>
    <form wire:submit.prevent="save">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input wire:model="name" type="text" class="form-control no-hover" id="name" placeholder="Nombre del lote">
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label for="year_planted">Año sembrado</label>
            <select name="year_planted" id="year_planted" class="form-control select2 no-hover" wire:model="yearPlanted" placeholder="Seleccione un año de siembra">
                <option value>Seleccione un año de siembra</option>
                @foreach($years as $item)
                    <option value="{{ $item }}">{{ $item }}</option>
                @endforeach
            </select>
            @error('yearPlanted') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label for="variety_id">Variedad</label>
            <select name="variety_id" id="variety_id" class="form-control select2 no-hover" wire:model="variety" data-placeholder="Seleccione una variedad">
                <option value>Seleccione una variedad</option>
                @foreach($varieties as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('variety') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label for="farm_id">Finca</label>
            <select name="farm_id" id="farm_id" class="form-control select2 no-hover" wire:model="farm" data-placeholder="Seleccione una finca">
                <option value>Seleccione una finca</option>
                @foreach($farms as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('farm') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button type="submit" class="btn btn-white">Guardar</button>
    </form>
</div>
