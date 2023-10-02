<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ request()->routeIs('notes.show') ? __('Notes') : __('Trash') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex">
                @if (!$note->trashed() )
                  <p class="mx-auto">
                    <strong>Updated At : </strong>{{ $note->updated_at->diffForHumans() }}
                  </p>
                  <p class="mx-auto">
                    <strong>Created At : </strong> {{ $note->created_at->diffForHumans() }}
                  </p>
                  <a href="{{ route('notes.edit', $note) }}" class="mx-auto btn btn-primary"> Edit Note</a>
                    <form action="{{ route('notes.destroy',$note) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="mx-5 bg-danger btn btn-danger" onclick="return confirm('Are You Sure You Want To Move This Note To Trash?')">Move Note To Trash</button>
                  </form>   
                @else
                    <p >
                    <strong>Deleted At : </strong>{{ $note->deleted_at->diffForHumans() }}
                    </p>
                    <form action="{{ route('trashed.update',$note) }}" method="post">
                    @method('put')
                    @csrf
                    <button type="submit" class="mx-5 bg-success btn btn-success" >Restore Note</button>
                    </form>

                   <form action="{{ route('trashed.destroy',$note) }}" method="post">
                    @method('delete')
                    @csrf
                    <button type="submit" class="mx-5 bg-danger btn btn-danger" onclick="return confirm('Are You Sure You Want To Delete This Note Permanently?')">Delete Note Permanently</button>
                   </form>
                @endif
            </div>
            <div class="mt-3 mb-3 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg ">

                <h2 class="navbar-brand mb-0 h1">
                    {{ $note->title }}
                </h2>
                <p class="m-2 para">{!! $note->text !!}
                </p>
                
            </div>
        </div>
    </div>
</x-app-layout>
