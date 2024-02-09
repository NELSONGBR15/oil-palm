<?php

namespace App\Livewire\Registers;

use App\Models\Disease;
use App\Models\Lot;
use App\Models\Register;
use App\Models\User;
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
    public $line;
    public $date;
    public $palm;
    public $disease;
    public $lot;
    public $user;

    public mixed $users;
    public mixed $diseases;
    public mixed $lots;


    final public function render(): \Illuminate\View\View
    {
        $this->hasAbilities();
        return view('livewire.registers.edit-add');
    }

    final public function hasAbilities(): void
    {
        if (empty($this->id)) {
            if (!auth()->user()->can('create registers')) {
                abort(403, 'Unauthorized action.');
            }
        } else if (!auth()->user()->can('update registers')) {
            abort(403, 'Unauthorized action.');
        }
    }

    private function rules(): array
    {
        return [
            'line' => 'required|string|max:255',
            'date' => 'required|date',
            'palm' => 'required|string|max:255',
            'disease' => 'required|integer',
            'lot' => 'required|integer',
            'user' => 'required|integer',
        ];
    }

    private function messages(): array
    {
        return [
            'required' => 'El campo :attribute es requerido.',
            'string' => 'El campo :attribute debe ser un texto.',
            'max' => 'El campo :attribute debe tener un máximo de :max caracteres.',
            'date' => 'El campo :attribute debe ser una fecha.',
            'integer' => 'El campo :attribute debe ser un número entero.',
        ];
    }

    final public function mount(): void
    {
        if (!empty($this->id)) {
            $this->titlePage = 'Editar Registro';
            $register = Register::findOrFail($this->id);
            $this->line = $register->line;
            $this->date = $register->date;
            $this->palm = $register->palm;
            $this->disease = $register->disease_id;
            $this->lot = $register->lot_id;
            $this->user = $register->user_id;
        } else {
            $this->titlePage = 'Adicionar Registro';
        }
        $this->users = User::withoutTrashed()->get();
        $this->diseases = Disease::withoutTrashed()->get();
        $this->lots = Lot::withoutTrashed()->get();
    }

    final public function save(): void
    {
        $this->validate($this->rules(), $this->messages());
        if (!empty($this->id)) {
            $register = Register::findOrFail($this->id);
            $message = [
                'alert_type' => 'success',
                'message' => 'Registro actualizado con éxito.',
            ];
        } else {
            $register = new Register();
            $message = [
                'alert_type' => 'success',
                'message' => 'Registro creado con éxito.',
            ];
        }
        $register->line = $this->line;
        $register->date = $this->date;
        $register->palm = $this->palm;
        $register->disease_id = $this->disease;
        $register->lot_id = $this->lot;
        $register->user_id = $this->user;
        $register->save();
        $this->dispatch('notify', $message);
        $this->redirect(url: route('registers.index'), navigate: true);
    }
}
