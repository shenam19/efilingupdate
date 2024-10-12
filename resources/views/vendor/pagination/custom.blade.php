<style>
.pagination{
    display: flex;
    padding-left: 0;
    list-style: none;
    border-radius: 0.25rem
 }

.pagination .page-link {
    color: black
}
</style>
@if($paginator->count())
<ul class="pagination d-flex justify-content-end flex-wrap pagination-flat pagination-success">
    
    <li class="d-flex align-items-center mr-2">
        {{ $paginator->perPage() * ($paginator->currentPage()-1) + 1 }} - 
        {{ $paginator->hasMorePages() ? $paginator->currentPage()*$paginator->perPage() : $paginator->total()}} 
        of {{$paginator->total()}}
    </li>

    <div class="btn-group"> 
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a class="page-link btn btn-default disabled" disabled aria-disabled="true">
                <i class="fa fa-angle-left"></i>
            </a>
        @else
            <button class="page-link btn btn-default" wire:click="previousPage">
                <i class="fa fa-angle-left"></i>
            </button>
        @endif
       {{-- Previous Page Link --}}
        @if ($paginator->hasMorePages())
            <button class="page-link btn btn-default " wire:click="nextPage">
                <i class="fa fa-angle-right"></i>
            </button>
        @else
            <a class="page-link btn btn-default disabled" disabled>
                <i class="fa fa-angle-right"></i>
            </a>
        @endif
    </div>
</ul>
@endif