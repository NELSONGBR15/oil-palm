<?php

namespace App\Livewire\Farms;

use App\Models\Farm;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $softDelete = false;

    protected $queryString = [
        'query' => ['except' => ''],
        'page' => ['except' => 1],
        'perPage' => ['except' => 8],
        'softDelete' => ['except' => false]
    ];

    public $query = '';

    public $perPage = 8;

    final public function render()
    {
        if (!auth()->user()->can('view farms')) {
            abort(403, 'Unauthorized action.');
        }
        return view('livewire.farms.index', [
            'farms' => Farm::withTrashed()->where(function ($query) {
                if (!$this->softDelete) {
                    $query->whereNull('deleted_at');
                }
                if (!empty($this->query)) {
                    $query->where('name', 'like', "%{$this->query}%");
                }
            })->paginate($this->perPage),
        ]);
    }
    final public function search(): void
    {
        $this->resetPage();
    }

    final public function clearSearch(): void
    {
        $this->query = '';
        $this->resetPage();
    }

    final public function delete(int $id): void
    {
        if (!auth()->user()->can('delete farms')) {
            abort(403, 'Unauthorized action.');
        }
        $position = Farm::findOrFail($id);
        $position->delete();
        $notification = [
            'alert_type' => 'success',
            'message' => 'Finca eliminada con éxito.',
        ];
        $this->dispatch('notify', $notification);
    }

    final public function restore(int $id): void
    {
        if (!auth()->user()->can('delete farms')) {
            abort(403, 'Unauthorized action.');
        }
        $position = Farm::withTrashed()->findOrFail($id);
        $position->restore();
        $notification = [
            'alert_type' => 'success',
            'message' => 'Finca restaurada con éxito.',
        ];
        $this->dispatch('notify', $notification);
    }

    final public function forceDelete(int $id): void
    {
        if (!auth()->user()->can('delete farms')) {
            abort(403, 'Unauthorized action.');
        }
        $position = Farm::withTrashed()->findOrFail($id);
        $position->forceDelete();
        $notification = [
            'alert_type' => 'success',
            'message' => 'Finca eliminada con éxito.',
        ];
        $this->dispatch('notify', $notification);
    }

    final public function showSoftDelete(): void
    {
        $this->softDelete = !$this->softDelete;
    }
}
