{{-- <div class="w-auto flex items-center justify-self-center py-8 mx-auto">
    {{ $posts->links('vendor.pagination.tailwind') }}
    <a href="#"
        class="h-10 w-10 bg-purple-800 hover:bg-purple-600 font-semibold text-white text-sm flex items-center justify-center">1</a>
    <a href="#"
        class="h-10 w-10 font-semibold text-gray-200 hover:bg-purple-600 hover:text-white text-sm flex items-center justify-center">2</a>
    <a href="#"
        class="h-10 w-10 font-semibold text-gray-200 hover:text-white text-sm flex items-center justify-center ml-3">Next
        <i class="fas fa-arrow-right ml-2"></i></a>
</div> --}}

@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-purple-600 border border-gray-800 cursor-default leading-5">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-purple-600 border border-gray-800 leading-5 hover:text-white focus:outline-none focus:ring ring-purple-300 focus:border-gray-500 active:bg-purple-800 active:text-white transition ease-in-out duration-150">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-white bg-purple-600 border border-gray-800 leading-5 hover:text-white focus:outline-none focus:ring ring-purple-300 focus:border-gray-500 active:bg-purple-800 active:text-white transition ease-in-out duration-150">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-white bg-purple-600 border border-gray-800 cursor-default leading-5">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-white leading-5">
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('-') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-medium mr-2">{{ $paginator->total() }}</span>
                </p>
            </div>

            <div>
                <span class="relative z-0 inline-flex shadow-sm">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-white bg-purple-600 border border-gray-800 leading-5 hover:text-white focus:z-10 focus:outline-none focus:ring ring-purple-300 focus:border-gray-100 active:bg-purple-800 active:text-white transition ease-in-out duration-150" aria-label="{{ __('pagination.previous') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-purple-600 border border-gray-800 cursor-default leading-5">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-purple-800 border border-gray-800 cursor-default leading-5">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-purple-600 border border-gray-800 leading-5 hover:text-white focus:z-10 focus:outline-none focus:ring ring-purple-300 focus:border-gray-500 active:bg-purple-800 active:text-white transition ease-in-out duration-150" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-white bg-purple-600 border border-gray-800 leading-5 hover:text-white focus:z-10 focus:outline-none focus:ring ring-purple-300 focus:border-gray-500 active:bg-purple-800 active:text-white transition ease-in-out duration-150" aria-label="{{ __('pagination.next') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </a>
                    @else
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif