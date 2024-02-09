<?php

namespace App\Livewire\Lots;

use App\Models\Farm;
use App\Models\Lot;
use App\Models\Variety;
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

    public $name;
    public $yearPlanted;
    public $variety;
    public $farm;

    public mixed $varieties;
    public mixed $farms;
    public mixed $years;

    final public function render(): \Illuminate\View\View
    {
        $this->hasAbilities();
        return view('livewire.lots.edit-add');
    }

    final public function hasAbilities(): void
    {
        if (empty($this->id)) {
            if (!auth()->user()->can('create lots')) {
                abort(403, 'Unauthorized action.');
            }
        } else if (!auth()->user()->can('update lots')) {
            abort(403, 'Unauthorized action.');
        }
    }

    private function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:lots,name,' . $this->id,
            'yearPlanted' => 'required|integer|min:1900|max:'.date('Y'),
            'variety' => 'required|integer|exists:varieties,id',
            'farm' => 'required|integer|exists:farms,id',
        ];
    }

    private function messages(): array
    {
        return [
            'required' => 'El campo :attribute es requerido.',
            'string' => 'El campo :attribute debe ser un texto.',
            'max' => 'El campo :attribute debe tener un máximo de :max caracteres.',
            'unique' => 'El campo :attribute ya existe.',
            'integer' => 'El campo :attribute debe ser un número entero.',
            'min' => 'El campo :attribute debe ser mayor o igual a :min.',
            'max' => 'El campo :attribute debe ser menor o igual a :max.',
            'exists' => 'El campo :attribute no existe.',
        ];
    }

    final public function mount():void
    {
        if (!empty($this->id)) {
            $this->titlePage = 'Editar Lote';
            $lot = Lot::findOrFail($this->id);
            $this->name = $lot->name;
            $this->yearPlanted = $lot->year_planted;
            $this->variety = $lot->variety_id;
            $this->farm = $lot->farm_id;
        } else {
            $this->titlePage = 'Adicionar Lote';
        }
        $this->varieties = Variety::withoutTrashed()->get();
        $this->farms = Farm::withoutTrashed()->get();
        $this->years = range(date('Y'), 1900);
    }

    final public function save(): void
    {
        $this->validate($this->rules(), $this->messages());
        if (!empty($this->id)) {
            $lot = Lot::findOrFail($this->id);
            $message = [
                'alert_type' => 'success',
                'message' => 'Lote actualizado con éxito.',
            ];
        } else {
            $lot = new Lot();
            $message = [
                'alert_type' => 'success',
                'message' => 'Lote creado con éxito.',
            ];
        }
        $lot->name = $this->name;
        $lot->year_of_planting = $this->yearPlanted;
        $lot->variety_id = $this->variety;
        $lot->farm_id = $this->farm;
        $lot->save();
        session()->flash('message', $message);
        $this->redirect(url: route('lots.index'), navigate: true);
    }
}
