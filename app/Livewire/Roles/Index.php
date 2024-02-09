<?php

namespace App\Livewire\Roles;

use App\Models\Role;
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

    final public function render(): \Illuminate\View\View
    {
        if (!auth()->user()->can('view roles')) {
            abort(403, 'Unauthorized action.');
        }
        return view('livewire.roles.index', [
            'roles' => Role::withTrashed()->where(function ($query) {
                if (!$this->softDelete) {
                    $query->whereNull('deleted_at');
                }
                if (!empty($this->query)) {
                    $query->where('name', 'like', "%{$this->query}%")
                        ->orWhere('guard_name', 'like', "%{$this->query}%");
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
        if (!auth()->user()->can('delete roles')) {
            abort(403, 'Unauthorized action.');
        }
        $position = Role::findOrFail($id);
        $position->delete();
        $notification = [
            'alert_type' => 'success',
            'message' => 'Rol eliminado con éxito.',
        ];
        $this->dispatch('notify', $notification);
    }

    final public function restore(int $id): void
    {
        if (!auth()->user()->can('delete roles')) {
            abort(403, 'Unauthorized action.');
        }
        $position = Role::withTrashed()->findOrFail($id);
        $position->restore();
        $notification = [
            'alert_type' => 'success',
            'message' => 'Rol restaurado con éxito.',
        ];
        $this->dispatch('notify', $notification);
    }

    final public function forceDelete(int $id): void
    {
        if (!auth()->user()->can('delete roles')) {
            abort(403, 'Unauthorized action.');
        }
        $position = Role::withTrashed()->findOrFail($id);
        $position->forceDelete();
        $notification = [
            'alert_type' => 'success',
            'message' => 'Rol eliminado con éxito.',
        ];
        $this->dispatch('notify', $notification);
    }

    final public function showSoftDelete(): void
    {
        $this->softDelete = !$this->softDelete;
    }
}
