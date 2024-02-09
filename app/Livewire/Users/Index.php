<?php

namespace App\Livewire\Users;

use App\Models\User;
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

    final public function render(): \Illuminate\View\View | \Illuminate\Contracts\View\Factory | \Illuminate\Contracts\Foundation\Application | \Illuminate\Http\Response
    {
        if (!auth()->user()->can('view users')) {
            abort(403, 'Unauthorized action.');
        }
        return view('livewire.users.index', [
            'users' => User::withTrashed()->where(function ($query) {
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
        if (!auth()->user()->can('delete users')) {
            abort(403, 'Unauthorized action.');
        }
        $position = User::findOrFail($id);
        if ($position->id === auth()->user()->id) {
            $notification = [
                'alert_type' => 'error',
                'message' => 'No puedes eliminar tu propio usuario.',
            ];
            $this->dispatch('notify', $notification);
            return;
        }
        $position->delete();
        $notification = [
            'alert_type' => 'success',
            'message' => 'Usuario eliminada con éxito.',
        ];
        $this->dispatch('notify', $notification);
    }

    final public function restore(int $id): void
    {
        if (!auth()->user()->can('delete users')) {
            abort(403, 'Unauthorized action.');
        }
        $position = User::withTrashed()->findOrFail($id);
        $position->restore();
        $notification = [
            'alert_type' => 'success',
            'message' => 'Usuario restaurada con éxito.',
        ];
        $this->dispatch('notify', $notification);
    }

    final public function forceDelete(int $id): void
    {
        if (!auth()->user()->can('delete users')) {
            abort(403, 'Unauthorized action.');
        }
        $position = User::withTrashed()->findOrFail($id);
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
