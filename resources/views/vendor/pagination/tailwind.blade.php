@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
        <div class="flex justify-between flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                    <span class="first_arrow arr"><img src="{{asset('assets/img/First.svg')}}" /></span>
                </span>
            @else
                <a href="{{ $paginator->url(1) }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                    <span class="first_arrow arr"><img src="{{asset('assets/img/First.svg')}}" /></span>
                </a>
            @endif
        </div>

                <div class="" >
            <div>
                <p class="text-sm text-gray-700 leading-5 dark:text-gray-400" style="display: none">
                    {!! __('Showing') !!}
                    @if ($paginator->firstItem())
                        <span class="font-medium">{{ $paginator->firstItem() }}</span>
                        {!! __('to') !!}
                        <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    @else
                        {{ $paginator->count() }}
                    @endif
                    {!! __('of') !!}
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    {!! __('results') !!}
                </p>
            </div>

            <div>
                <span class="" style="display: flex">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-l-md leading-5 dark:bg-gray-800 dark:border-gray-600" aria-hidden="true">
                                <span class="prev_arrow arr"><img src="{{asset('assets/img/Prev.svg')}}" /></span>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-l-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="{{ __('pagination.previous') }}">
                            <span class="prev_arrow arr"><img src="{{asset('assets/img/Prev.svg')}}" /></span>
                        </a>
                    @endif

                    {{-- Pagination Elements --}} 
                    @foreach ($elements as $k => $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="arr">
                                    <a href="
                                    @if($k == 1 && count($elements) > 3)
                                        {{$paginator->url( ceil(($paginator->currentPage()  +  1)  / 2))}}
                                    @elseif($k == 3 && count($elements) > 3)
                                        {{$paginator->url( ceil(($paginator->currentPage()  +  $paginator->lastPage())  / 2))}}
                                    @elseif($k == 3 && count($elements) == 3)
                                        {{$paginator->url( ceil(($paginator->lastPage()  +  1)  / 2))}}
                                    @endif
                                    " >
                                    {{ $element }} 
                                    </a>
                                </span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="arr current">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:text-gray-300 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        <span class="arr">{{ $page }}</span>
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-r-md leading-5 hover:text-gray-400 focus:z-10 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:active:bg-gray-700 dark:focus:border-blue-800" aria-label="{{ __('pagination.next') }}">
                            <span class="next_arrow arr"><img src="{{asset('assets/img/Next.svg')}}" /></span>
                        </a>
                    @else
                        <span aria-disabled="true" aria-label="{{ __('pagination.next') }}" >
                            <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default rounded-r-md leading-5 dark:bg-gray-800 dark:border-gray-600" aria-hidden="true">
                                <span class="next_arrow arr"><img src="{{asset('assets/img/Next.svg')}}" /></span>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>






        <div>
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->url($paginator->lastPage()) }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border border-gray-300 leading-5 rounded-md hover:text-gray-500 focus:outline-none focus:ring ring-gray-300 focus:border-blue-300 active:bg-gray-100 active:text-gray-700 transition ease-in-out duration-150 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-300 dark:focus:border-blue-700 dark:active:bg-gray-700 dark:active:text-gray-300">
                   <span class="last_arrow arr"><img src="{{asset('assets/img/Last.svg')}}" /></span>
                </a>
            @else
                <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                    <span class="last_arrow arr"><img src="{{asset('assets/img/Last.svg')}}" /></span>
                </span>
            @endif
        </div>

        
    </nav>



      
        @push('styles')
            <style>
                svg {
                    width: 15px;
                }   

                .arr {
                    border: 1px solid  #F1F1F1; 
                    border-radius: 8px;
                    height: 32px;
                    width: 32px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    text-decoration: none;
                    margin-left: 10px;
                    

                }
                
                nav {
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    padding: 20px 0 70px;

                    a {
                        color: #333;
                        text-decoration: none;
                        font-size: 13px;
                    }


                    .first_arrow,.prev_arrow, .next_arrow, .last_arrow {
                        font-size: 19px;
                    }

                }

                .current {
                    background-color: #062D26;
                    color: #fff;
                }
    
            </style>
        @endpush








@endif
