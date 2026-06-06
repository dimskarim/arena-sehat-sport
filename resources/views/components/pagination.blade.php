@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex flex-wrap items-center gap-1">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="px-2.5 py-1.5 text-sm font-medium text-[#8f6f6c] bg-[#e4beba]/20 rounded-lg cursor-not-allowed">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="px-2.5 py-1.5 text-sm font-medium text-[#af101a] bg-white border border-[#e4beba] rounded-lg hover:bg-[#fdcbd0] transition-colors focus:outline-none focus:ring-2 focus:ring-[#af101a]/20 shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="px-3 py-1.5 text-sm font-medium text-[#8f6f6c] cursor-default">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3.5 py-1.5 text-sm font-bold text-white bg-[#af101a] rounded-lg shadow-md cursor-default" aria-current="page">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $url }}" class="px-3.5 py-1.5 text-sm font-medium text-[#5b403d] bg-white border border-[#e4beba] rounded-lg hover:bg-[#f6f3f2] transition-colors focus:outline-none focus:ring-2 focus:ring-[#af101a]/20 shadow-sm">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="px-2.5 py-1.5 text-sm font-medium text-[#af101a] bg-white border border-[#e4beba] rounded-lg hover:bg-[#fdcbd0] transition-colors focus:outline-none focus:ring-2 focus:ring-[#af101a]/20 shadow-sm">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        @else
            <span class="px-2.5 py-1.5 text-sm font-medium text-[#8f6f6c] bg-[#e4beba]/20 rounded-lg cursor-not-allowed">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                </svg>
            </span>
        @endif
    </nav>
@endif
