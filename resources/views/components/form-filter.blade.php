<form action="{{ route('products.filter') }}" method="POST">
    @csrf
    @method('POST')
    <select name="filter[category_id]">{{ $filterCategory  }}
        <option value="all" @if ($filterCategory==='all') selected="selected" @endif>All</option>
        @foreach($categories as $category)
            <option value="{{ $category->category_id }}" @if ($filterCategory===$category->category_id) selected="selected" @endif>{{ $category->name }}</option>
        @endforeach
    </select>
    <input type="hidden" name="filter[sort_by]" value="{{ $sortBy }}"/>
    <input type="hidden" name="filter[sort_dir]" value="{{ $sortDir }}"/>

    <x-button>Filter</x-button>
</form>
