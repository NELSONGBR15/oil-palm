<div>
    <div class="card-title">{{ $titlePage }}</div>
    <form wire:submit.prevent="save">
        <div class="form-group">
            <label for="name">Nombre</label>
            <input wire:model="name" type="text" class="form-control no-hover" id="name" placeholder="Nombre del usuario">
            @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input wire:model="email" type="email" class="form-control no-hover" id="email" placeholder="Correo electrónico">
            @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input wire:model="password" type="password" class="form-control no-hover" id="password" placeholder="Contraseña">
            @error('password') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmar contraseña</label>
            <input wire:model="password_confirmation" type="password" class="form-control no-hover" id="password_confirmation" placeholder="Confirmar contraseña">
            @error('password_confirmation') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label for="date_of_birth">Fecha de nacimiento</label>
            <input wire:model="dateOfBirth" type="date" class="form-control no-hover" id="date_of_birth" placeholder="Fecha de nacimiento">
            @error('dateOfBirth') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label for="position">Cargo</label>
            <select name="position" id="position" class="form-control select2 no-hover" wire:model="position" placeholder="Seleccione un cargo">
                <option value>Seleccione un cargo</option>
                @foreach($positions as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('position') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label for="gender">Sexo</label>
            <select name="gender" id="gender" class="form-control select2 no-hover" wire:model="gender" placeholder="Seleccione un genero">
                <option value>Seleccione un genero</option>
                @foreach($genders as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('gender') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <div class="form-group">
            <label for="role">Rol</label>
            <select name="role" id="role" class="form-control select2 no-hover" wire:model="role" placeholder="Seleccione un rol">
                <option value>Seleccione un Rol</option>
                @foreach($roles as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
            @error('role') <small class="text-danger">{{ $message }}</small> @enderror
        </div>
        <button type="submit" class="btn btn-white">Guardar</button>
    </form>
</div>
