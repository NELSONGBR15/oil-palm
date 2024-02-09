<?php

namespace App\Livewire\Roles;

use App\Models\Permission;
use App\Models\Role;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class EditAdd extends Component
{
    /**
     * @var
     */
    public $titlePage;
    /**
     * @var
     */
    public $id;

    /**
     * @var
     */
    public $name;

    public $permissionsSelected = [];

    public mixed $permissions;

    final public function render(): \Illuminate\View\View
    {
        $this->hasAbilities();
        return view('livewire.roles.edit-add');
    }

    final public function hasAbilities(): void
    {
        if (empty($this->id)) {
            if (!auth()->user()->can('create roles')) {
                abort(403, 'Unauthorized action.');
            }
        } else if (!auth()->user()->can('update roles')) {
            abort(403, 'Unauthorized action.');
        }
    }

    private function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:roles,name,' . $this->id,
        ];
    }

    private function messages(): array
    {
        return [
            'required' => 'El campo :attribute es requerido.',
            'string' => 'El campo :attribute debe ser un texto.',
            'max' => 'El campo :attribute debe tener un máximo de :max caracteres.',
            'unique' => 'El campo :attribute ya existe.',
        ];
    }

    final public function mount(): void
    {
        $this->permissions = Permission::all();
        if (!empty($this->id)) {
            $this->titlePage = 'Editar Rol';
            $role = Role::findOrFail($this->id);
            $this->name = $role->name;
            $this->permissionsSelected = $role->permissions->pluck('id')->toArray();
        } else {
            $this->titlePage = 'Adicionar Rol';
        }
    }

    final public function save(): void
    {
        $this->validate($this->rules(), $this->messages());
        if(!empty($this->id)) {
            $role = Role::findOrFail($this->id);
            $message = [
                'alert_type' => 'success',
                'message' => 'Rol actualizado con éxito.',
            ];
        } else {
            $role = new Role();
            $message = [
                'alert_type' => 'success',
                'message' => 'Rol creado con éxito.',
            ];
        }
        $role->name = $this->name;
        $role->guard_name = 'web';
        $role->save();
        $this->permissionsSelected = array_map('intval', $this->permissionsSelected);
        $role->syncPermissions($this->permissionsSelected);
        session()->flash('message', $message);
        $this->redirect(url: route('roles.index'), navigate: true);
    }
}
