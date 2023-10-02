<x-app-layout>
    <x-slot name="header">
        <h2 class="h1 ">
            {{ __('Edit Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h1 class="h2">Edit Note</h1>
            <div class="mb-3 mt-3 mb-3 p-6 border-b shadow-sm sm:rounded-lg ">


                <form action="{{ route('notes.update',$note) }}" method="post">
                    @method('put')
                    @csrf
                    <input class="form-control fs-3 mb-3 p-3" type="text" name="title" field="title"
                        value="{{ old('title',$note->title) }}" placeholder="Title">
                    @error('title')
                        <p class="mb-2 text-danger">{{ $message }}</p>
                    @enderror
                    <textarea class="form-control fs-4 mb-3 p-3" id="editor" name="text" rows="10"
                        placeholder="Add Note Here...." value="{{ old('text',$note) }}"></textarea>
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
