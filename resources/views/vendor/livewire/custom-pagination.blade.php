<div>
    <p class="small text-muted">
        {{ __('Showing') }} {{ $paginator->firstItem() }} {{ __('to') }} {{ $paginator->lastItem() }} {{ __('of') }} {{ $paginator->total() }} {{ __('results') }}
    </p>
    <div class="d-flex justify-content-between mt-4 align-items-center">
        @if ($paginator->onFirstPage())
            <div class="small text-muted">
                <span>&laquo; {{ __('Previous') }}</span>
            </div>
        @else
            <div>
                <button wire:click="previousPage" class="btn split-btn-primary">
                    &laquo; {{ __('Previous') }}
                </button>
            </div>
        @endif

        @if ($paginator->hasMorePages())
            <div>
                <button wire:click="nextPage" class="btn btn-primary">
                    {{ __('Next') }} &raquo;
                </button>
            </div>
        @else
            <div class="small text-muted">
                <span>{{ __('Next') }} &raquo;</span>
            </div>
        @endif
    </div>
</div>
