<?php

namespace App\Livewire\Users;

use App\Models\Gender;
use App\Models\Position;
use App\Models\Role;
use \App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Nette\Utils\Random;

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

    public $email;
    public $password;
    public $password_confirmation;
    public $position;
    public $gender;
    public $role;
    public $dateOfBirth;

    public $genders;
    public $positions;
    public $roles;

    final public function render(): \Illuminate\View\View | \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\Foundation\Application | \Illuminate\Http\Response
    {
        $this->hasAbilities();
        return view('livewire.users.edit-add');
    }

    final public function hasAbilities(): void
    {
        if (empty($this->id)) {
            if (!auth()->user()->can('create users')) {
                abort(403, 'Unauthorized action.');
            }
        } else if (!auth()->user()->can('update users')) {
            abort(403, 'Unauthorized action.');
        }
    }

    private function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $this->id,
            'password' => 'string|min:8|confirmed|'. (!empty($this->id) ? 'nullable' : 'required'),
            'position' => 'required|integer',
            'gender' => 'required|integer',
            'dateOfBirth' => 'required|date',
            'role' => 'required|integer',
        ];
    }

    private function messages(): array
    {
        return [
            'required' => 'El campo :attribute es requerido.',
            'string' => 'El campo :attribute debe ser un texto.',
            'max' => 'El campo :attribute debe tener un máximo de :max caracteres.',
            'unique' => 'El campo :attribute ya existe.',
            'email' => 'El campo :attribute debe ser un correo electrónico.',
            'confirmed' => 'El campo :attribute no coincide.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'date' => 'El campo :attribute debe ser una fecha.',
        ];
    }

    final public function mount(): void
    {
        if (!empty($this->id)) {
            $this->titlePage = 'Editar Usuario';
            $user = User::findOrFail($this->id);
            $this->name = $user->name;
            $this->email = $user->email;
            $this->position = $user->position_id;
            $this->gender = $user->gender_id;
            $this->dateOfBirth = $user->date_of_birth;
            $this->role = $user->role_id;
        } else {
            $this->titlePage = 'Adicionar Usuario';
        }
        $this->genders = Gender::all();
        $this->positions = Position::withoutTrashed()->get();
        $this->roles = Role::withoutTrashed()->get();
    }

    final public function save(): void
    {
        $this->validate($this->rules(), $this->messages());
        if (!empty($this->id)) {
            $user = User::findOrFail($this->id);
            $message = [
                'alert_type' => 'success',
                'message' => 'Usuario actualizado con éxito.',
            ];
        } else {
            $user = new User();
            $message = [
                'alert_type' => 'success',
                'message' => 'Usuario creado con éxito.',
            ];
        }
        $user->name = $this->name;
        $user->email = $this->email;
        if (!empty($this->password)) {
            $user->password = bcrypt($this->password);
        }
        $user->position_id = $this->position;
        $user->gender_id = $this->gender;
        $user->date_of_birth = $this->dateOfBirth;
        $user->role_id = $this->role;
        $user->save();
        $user->syncRoles((int)$this->role);
        if (empty($this->id)) {
            $user->sendPasswordResetNotification(Random::generate(60));
        }
        $this->dispatch('notify', $message);
        $this->redirect(url: route('users.index'), navigate: true);
    }
}
