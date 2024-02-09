<?php

namespace App\Livewire\Diseases;

use App\Models\Disease;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class EditAdd extends Component
{
    public string $titlePage;
    public $id;
    public string $name;

    final public function render(): \Illuminate\View\View
    {
        $this->hasAbilities();
        return view('livewire.diseases.edit-add');
    }

    final public function hasAbilities(): void
    {
        if (empty($this->id)) {
            if (!auth()->user()->can('create diseases')) {
                abort(403, 'Unauthorized action.');
            }
        } else if (!auth()->user()->can('update diseases')) {
            abort(403, 'Unauthorized action.');
        }
    }

    final public function mount(): void
    {
        if (!empty($this->id)) {
            $this->titlePage = 'Editar Enfermedad';
            $disease = Disease::findOrFail($this->id);
            $this->name = $disease->name;
        } else {
            $this->titlePage = 'Adicionar Enfermedad';
        }
    }

    private function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:diseases,name,' . $this->id,
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

    final public function save(): void
    {
        $this->validate($this->rules(), $this->messages());
        if(!empty($this->id)) {
            $disease = Disease::findOrFail($this->id);
            $message = [
                'alert_type' => 'success',
                'message' => 'Enfermedad actualizada con éxito.',
            ];
        } else {
            $disease = new Disease();
            $message = [
                'alert_type' => 'success',
                'message' => 'Enfermedad creada con éxito.',
            ];
        }
        $disease->name = $this->name;
        $disease->save();
        session()->flash('message', $message);
        $this->redirect(url: route('diseases.index'), navigate: true);
    }
}
