<?php

namespace App\Livewire\Varieties;

use App\Models\Variety;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\View\View;
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

    /**
     * @return View|Factory|Application|Response
     */
    final public function render(): View | Factory | Application | Response
    {
        $this->hasAbilities();
        return view('livewire.varieties.edit-add');
    }

    final public function hasAbilities(): void
    {
        if (empty($this->id)) {
            if (!auth()->user()->can('create varieties')) {
                abort(403, 'Unauthorized action.');
            }
        } else if (!auth()->user()->can('update varieties')) {
            abort(403, 'Unauthorized action.');
        }
    }

    /**
     * @return string[]
     */
    private function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:varieties,name,' . $this->id,
        ];
    }

    /**
     * @return string[]
     */
    private function messages(): array
    {
        return [
            'required' => 'El campo :attribute es requerido.',
            'string' => 'El campo :attribute debe ser un texto.',
            'max' => 'El campo :attribute debe tener un máximo de :max caracteres.',
            'unique' => 'El campo :attribute ya existe.',
        ];
    }

    /**
     * @return void
     */
    final public function mount(): void
    {
        if (!empty($this->id)) {
            $this->titlePage = 'Editar variedad';
            $farm = Variety::findOrFail($this->id);
            $this->name = $farm->name;
        } else {
            $this->titlePage = 'Adicionar variedad';
        }
    }

    /**
     * @return void
     */
    final public function save(): void
    {
        $this->validate($this->rules(), $this->messages());
        if (!empty($this->id)) {
            $farm = Variety::findOrFail($this->id);
            $message = [
                'alert_type' => 'success',
                'message' => 'Variedad actualizada con éxito.',
            ];
        } else {
            $farm = new Variety();
            $message = [
                'alert_type' => 'success',
                'message' => 'Variedad creada con éxito.',
            ];
        }
        $farm->name = $this->name;
        $farm->save();
        session()->flash('message', $message);
        $this->redirect(url: route('varieties.index'), navigate: true);
    }
}
