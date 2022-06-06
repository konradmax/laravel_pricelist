<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    @if($message = Session::get('success'))
        <div class="alert alert-success">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <p>{{ $message }}</p>
            </div>
        </div>
    @endif
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-table-products :filterCategory="$filterCategory" :data="$data" :categories="$categories" :sortBy="$sortBy" :sortDir="$sortDir" />
        </div>
    </div>
</x-app-layout>

