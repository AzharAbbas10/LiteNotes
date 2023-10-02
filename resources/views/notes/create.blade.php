<x-app-layout>
    <x-slot name="header">
        <h2 class="h1 ">
            {{ ('Notes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="h2">New Note</h1>
            <div class="mb-3 mt-3 mb-3 p-6 border-b shadow-sm sm:rounded-lg ">


                <form action="{{ route('notes.store') }}" method="post">
                    @csrf
                    <input class="form-control fs-3 mb-3 p-3" type="text" name="title" field="title"
                         value="{{ old('title') }}" placeholder="Title">
                    @error('title')
                        <p class="mb-2 text-danger">{{ $message }}</p>
                    @enderror
                    <textarea class="form-control fs-4 mb-3 p-3" name="text" rows="10" id="editor"
                        placeholder="Add Note Here...." value="{{ old('text') }}"></textarea>
                    @error('text')
                        <p class="mb-2 text-danger">{{ $message }}</p>
                    @enderror
                    <button class="btn btn-success btn-lg rounded">Save Note</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ),{
                ckfinder:{
                    uploadUrl: '{{ route('notes.upload',['_token'=>csrf_token()])}}'
                }
            } )
            .catch( error => {
                console.error( error );
            } );
    </script>
</x-app-layout>
