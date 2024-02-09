<?php

namespace App\Livewire\Lots;

use App\Models\Lot;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Response;
use Illuminate\View\View;
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

    /**
     * @return View|Factory|Application|Response
     */
    final public function render(): View | Factory | Application | Response
    {
        if (!auth()->user()->can('view lots')) {
            abort(403, 'Unauthorized action.');
        }
        return view('livewire.lots.index', [
            'lots' => Lot::withTrashed()->where(function ($query) {
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
        if (!auth()->user()->can('delete lots')) {
            abort(403, 'Unauthorized action.');
        }
        $position = Lot::findOrFail($id);
        $position->delete();
        $notification = [
            'alert_type' => 'success',
            'message' => 'Finca eliminada con éxito.',
        ];
        $this->dispatch('notify', $notification);
    }

    final public function restore(int $id): void
    {
        if (!auth()->user()->can('delete lots')) {
            abort(403, 'Unauthorized action.');
        }
        $position = Lot::withTrashed()->findOrFail($id);
        $position->restore();
        $notification = [
            'alert_type' => 'success',
            'message' => 'Lote restaurada con éxito.',
        ];
        $this->dispatch('notify', $notification);
    }

    final public function forceDelete(int $id): void
    {
        if (!auth()->user()->can('delete lots')) {
            abort(403, 'Unauthorized action.');
        }
        $position = Lot::withTrashed()->findOrFail($id);
        $position->forceDelete();
        $notification = [
            'alert_type' => 'success',
            'message' => 'Lote eliminada con éxito.',
        ];
        $this->dispatch('notify', $notification);
    }

    final public function showSoftDelete(): void
    {
        $this->softDelete = !$this->softDelete;
    }
}
