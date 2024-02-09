<?php

namespace App\Livewire\Positions;

use App\Models\Position;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class EditAdd extends Component
{
    public $titlePage;
    public $id;

    public $name;

    public function render()
    {
        $this->hasAbilities();
        return view('livewire.positions.edit-add');
    }

    private function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:positions,name,' . $this->id,
        ];
    }

    final public function hasAbilities(): void
    {
        if (empty($this->id)) {
            if (!auth()->user()->can('create positions')) {
                abort(403, 'Unauthorized action.');
            }
        } else if (!auth()->user()->can('update positions')) {
            abort(403, 'Unauthorized action.');
        }
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
        if (!empty($this->id)) {
            $this->titlePage = 'Editar Cargo';
            $position = Position::findOrFail($this->id);
            $this->name = $position->name;
        } else {
            $this->titlePage = 'Adicionar Cargo';
        }
    }

    final public function save(): void
    {
        $this->validate($this->rules(), $this->messages());
        if (!empty($this->id)) {
            $position = Position::findOrFail($this->id);
            $message = [
                'alert_type' => 'success',
                'message' => 'Cargo actualizado con éxito.',
            ];
        } else {
            $position = new Position();
            $message = [
                'alert_type' => 'success',
                'message' => 'Cargo creado con éxito.',
            ];
        }
        $position->name = $this->name;
        $position->save();
        $this->redirect(url: route('positions.index'), navigate: true);
    }
}
