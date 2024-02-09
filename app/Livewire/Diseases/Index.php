<?php

namespace App\Livewire\Diseases;

use App\Models\Disease;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';
    public $query = '';
    public $perPage = 8;
    public $softDelete = false;
    protected $queryString = [
        'query' => ['except' => ''],
        'page' => ['except' => 1],
        'perPage' => ['except' => 8],
        'softDelete' => ['except' => false]
    ];

    final public function render(): \Illuminate\View\View | \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\Foundation\Application | \Illuminate\Http\Response
    {
        if (!auth()->user()->can('view diseases')) {
            abort(403, 'Unauthorized action.');
        }
        return view('livewire.diseases.index', [
            'diseases' => Disease::withTrashed()->where(function ($query) {
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
        if (!auth()->user()->can('delete diseases')) {
            abort(403, 'Unauthorized action.');
        }
        $disease = Disease::findOrFail($id);
        $disease->delete();
        $notification = [
            'alert_type' => 'success',
            'message' => 'Enfermedad eliminada con éxito.',
        ];
        $this->dispatch('notify', $notification);
    }

    final public function restore(int $id): void
    {
        if (!auth()->user()->can('delete diseases')) {
            abort(403, 'Unauthorized action.');
        }
        $disease = Disease::withTrashed()->findOrFail($id);
        $disease->restore();
        $notification = [
            'alert_type' => 'success',
            'message' => 'Enfermedad restaurada con éxito.',
        ];
        $this->dispatch('notify', $notification);
    }

    final public function showSoftDelete(): void
    {
        $this->softDelete = !$this->softDelete;
    }

    final public function updatingPerPage(): void
    {
        $this->resetPage();
    }

    final public function forceDelete(int $id): void
    {
        if (!auth()->user()->can('delete diseases')) {
            abort(403, 'Unauthorized action.');
        }
        $disease = Disease::withTrashed()->findOrFail($id);
        $disease->forceDelete();
        $notification = [
            'alert_type' => 'success',
            'message' => 'Enfermedad eliminada permanentemente con éxito.',
        ];
        $this->dispatch('notify', $notification);
    }
}
