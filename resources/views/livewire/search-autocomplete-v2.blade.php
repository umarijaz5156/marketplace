
<div    x-data="{
    open: @entangle('showDropdown'),
    search: @entangle('search'),
    selected: @entangle('selected'),
    highlightedIndex: 0,
    highlightPrevious() {
      if (this.highlightedIndex > 0) {
        this.highlightedIndex = this.highlightedIndex - 1;
        this.scrollIntoView();
      }
    },
    highlightNext() {
      if (this.highlightedIndex < this.$refs.results.children.length - 1) {
        this.highlightedIndex = this.highlightedIndex + 1;
        this.scrollIntoView();
      }
    },
    scrollIntoView() {
      this.$refs.results.children[this.highlightedIndex].scrollIntoView({
        block: 'nearest',
        behavior: 'smooth'
      });
    },
    updateSelected(id, name) {
      this.selected = id;
      this.search = name;
      this.open = false;
      this.highlightedIndex = 0;
    },
}">
    <div class="mt-20 relative"  x-on:value-selected="updateSelected($event.detail.id, $event.detail.name)">
        <form  method="GET" action="{{ route('home.search_gigs') }}">
            <input wire:model.debounce.300ms="search"
            x-on:keydown.arrow-down.stop.prevent="highlightNext()"
            x-on:keydown.arrow-up.stop.prevent="highlightPrevious()"
            x-on:keydown.enter.stop.prevent="$dispatch('value-selected', {
            id: $refs.results.children[highlightedIndex].getAttribute('data-result-id'),
            name: $refs.results.children[highlightedIndex].getAttribute('data-result-name')
            })"
            name="query"
            autocomplete="off"
                class="bg-transparent border border-white text-white rounded-lg focus:ring-white focus:border-white block w-full p-2.5 placeholder:text-white"
                placeholder="Company or category"  />
            <div class="absolute right-1 top-1/2 -translate-y-1/2">
                <button
                    class="align-middle select-none font-medium text-center transition-all disabled:opacity-50 disabled:shadow-none disabled:pointer-events-none w-12 h-9 rounded-md bg-white text-black shadow-md shadow-white/10 hover:shadow-lg hover:shadow-white/20 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none flex justify-center items-center"
                    type="submit" data-ripple-dark="true">
                    <i class="fa-regular fa-magnifying-glass"></i>
                </button>
            </div>
        </form>

    </div>
    <div
    class="bg-white"
    x-show="open"
    x-on:click.away="open = false">
      <ul x-ref="results">
        @forelse($results as $index => $result)
          <li
            class="hover:bg-gray-200 cursor-pointer px-2"
            wire:key="{{ $index }}"
            x-on:click.stop="$dispatch('value-selected', {
              id: {{ $result->id }},
              name: '{{ $result->title }}'
            })"
            :class="{
              'bg-indigo-400': {{ $index }} === highlightedIndex,
              'text-white': {{ $index }} === highlightedIndex
            }"
            data-result-id="{{ $result->id }}"
            data-result-name="{{ $result->title }}">
              <span>
                {{ $result->title }}
              </span>
          </li>
        @empty
          <li>No results found</li>
        @endforelse
      </ul>
    </div>
</div>
