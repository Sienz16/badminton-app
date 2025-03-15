<nav role="navigation" aria-label="Pagination Navigation" class="flex flex-col items-center justify-between gap-4">
    <div>
        <p class="text-sm text-gray-700 dark:text-gray-300">
            {!! __('Showing') !!}
            <span class="font-medium">{{ $paginator->firstItem() ?: 0 }}</span>
            {!! __('to') !!}
            <span class="font-medium">{{ $paginator->lastItem() ?: 0 }}</span>
            {!! __('of') !!}
            <span class="font-medium">{{ $paginator->total() }}</span>
            {!! __('results') !!}
        </p>
    </div>

    <div>
        <span class="relative z-0 inline-flex -space-x-px rounded-md shadow-sm">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex cursor-default items-center rounded-l-md border border-green-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 dark:border-green-700 dark:bg-green-900/30">
                    <span class="sr-only">Previous</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            @else
                <button wire:click="previousPage" class="relative inline-flex items-center rounded-l-md border border-green-300 bg-white px-2 py-2 text-sm font-medium text-green-700 hover:bg-green-50 dark:border-green-700 dark:bg-green-900/30 dark:text-green-400 dark:hover:bg-green-900/50">
                    <span class="sr-only">Previous</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="relative inline-flex cursor-default items-center border border-green-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 dark:border-green-700 dark:bg-green-900/30">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span class="relative inline-flex cursor-default items-center border border-green-300 bg-green-50 px-4 py-2 text-sm font-medium text-green-700 dark:border-green-700 dark:bg-green-900/50 dark:text-green-400">
                                {{ $page }}
                            </span>
                        @else
                            <button wire:click="gotoPage({{ $page }})" class="relative inline-flex items-center border border-green-300 bg-white px-4 py-2 text-sm font-medium text-green-700 hover:bg-green-50 dark:border-green-700 dark:bg-green-900/30 dark:text-green-400 dark:hover:bg-green-900/50">
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <button wire:click="nextPage" class="relative inline-flex items-center rounded-r-md border border-green-300 bg-white px-2 py-2 text-sm font-medium text-green-700 hover:bg-green-50 dark:border-green-700 dark:bg-green-900/30 dark:text-green-400 dark:hover:bg-green-900/50">
                    <span class="sr-only">Next</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </button>
            @else
                <span class="relative inline-flex cursor-default items-center rounded-r-md border border-green-300 bg-white px-2 py-2 text-sm font-medium text-gray-500 dark:border-green-700 dark:bg-green-900/30">
                    <span class="sr-only">Next</span>
                    <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                    </svg>
                </span>
            @endif
        </span>
    </div>
</nav>
