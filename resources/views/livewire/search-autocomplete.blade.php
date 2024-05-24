<div>
    <div
      x-data="{
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
    <div
      x-on:value-selected="updateSelected($event.detail.id, $event.detail.name)">
      <span>
        <form method="GET" action="{{ route('home.search_gigs') }}">
            <div class="relative">
              <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 drk:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
              </div>
              <label for="search" class="mb-2 text-sm font-medium text-gray-900 sr-only drk:text-white">Search</label>
                <input
                    wire:model.debounce.300ms="search"
                    x-on:keydown.arrow-down.stop.prevent="highlightNext()"
                    x-on:keydown.arrow-up.stop.prevent="highlightPrevious()"
                    x-on:keydown.enter.stop.prevent="$dispatch('value-selected', {
                    id: $refs.results.children[highlightedIndex].getAttribute('data-result-id'),
                    name: $refs.results.children[highlightedIndex].getAttribute('data-result-name')
                    })"
                    name="query"
                    autocomplete="off"
                    class="block w-full p-4 pl-10  text-gray-900 border border-[#E2EAED] rounded-[10px] bg-white focus:ring-[#0096D8] focus:border-[#0096D8] placeholder:text-[#6A6A6A] text-base placeholder:text-xs sm:placeholder:text-base" placeholder="Try “Medical Store”"
                >
                <button type="submit" class="text-white absolute top-0 right-0 bottom-0 bg-[#0096D8] hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-tr-[10px] rounded-br-[10px] px-3 sm:px-8 py-2 drk:bg-blue-600 drk:hover:bg-blue-700 drk:focus:ring-blue-800 text-sm sm:text-base">
                   Search
                </button>
            </div>
        </form>


      </span>

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
    </div>
</div>
