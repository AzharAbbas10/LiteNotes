<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ request()->routeIs('notes.index') ? __('Notes') : __('Trashed') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (request()->routeIs('notes.index'))
              <a href="{{ route('notes.create')}}" class="btn btn-primary"> + New Note</a>
                
            @endif
            

            @forelse ($notes as $note)
                <div class="mt-3 mb-3 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg ">
                    <h2 class="navbar-brand mb-0 h1">
                       <a 
                       @if (request()->routeIs('notes.index'))
                       href="{{ route('notes.show', $note) }}"
                       @else 
                       href="{{ route('trashed.show', $note) }}"
                       @endif
                       > {{ $note ->title }}</a>
                    </h2>
                    <p class="m-2">
                        {!! Str::limit($note ->text , 200) !!}
                    </p> 
                    <span class="block mt-4">
                        {{ $note ->updated_at->diffForHumans()}}
                    </span>
                </div>
            @empty
            @if (request()->routeIs('notes.index'))
            <p class="mt-3 font-weight-bold">You Have No Notes Yet</p>
            @else
            <p class="mt-3 font-weight-bold">You Have No Notes In Trash Yet</p>
            @endif

            @endforelse
            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>
