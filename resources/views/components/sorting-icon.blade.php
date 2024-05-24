<div>
    @if ($sortField !== $field)
        <span></span>
    @elseif ($sortDirection  == 'asc')
        <img src="{{ asset('images/svg/up.png') }}" class="ml-2 w-3" />
    @else
        <img src="{{ asset('images/svg/down.png') }}" class="ml-2 w-3" />
    @endif
</div>
