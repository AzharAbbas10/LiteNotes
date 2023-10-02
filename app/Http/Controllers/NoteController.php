<?php

namespace App\Http\Controllers;

use notify;
use App\Models\Note;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $notes = Note::whereBelongsTo(Auth::user())->latest('updated_at')->paginate(5);
        return view('notes.index') -> with('notes',$notes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('notes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|string|max:120',
            'text'=>'required'
        ]);

        Auth::user()->notes()->create([
            'uuid'=>Str::uuid(),
            'title'=>$request->title,
            'text'=>$request->text
        ]);
        // return "<h1> Data is stored </h1>";
        notify()->success('Note is Added!');
        return to_route('notes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        if( !$note->user->is(Auth::user())){
            return abort(403);
        }
        return view('notes.show')->with('note',$note);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Note $note)
    { 
        if( !$note->user->is(Auth::user())){
            return abort(403);
        }
    return view('notes.edit')->with('note',$note);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        if( !$note->user->is(Auth::user())){
            return abort(403);
        }
        $request->validate([
            'title'=>'required|string|max:120',
            'text'=>'required'
        ]);

        $note->update([
            'title'=> $request->title,
            'text' => $request->text
        ]);
        notify()->success('Note is Updated!');
        return to_route('notes.show',$note);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        if( !$note->user->is(Auth::user())){
            return abort(403);
        }
        $note->delete();
        notify()->success('Note is Moved To Trash!');
        return to_route('notes.index',$note);
    }
    public function uploadimage(Request $request)
    {
     if($request->hasFile('upload')){
        $originName =$request->file('upload')->getClientOriginalName();
        $fileName = pathinfo($originName,PATHINFO_FILENAME);
        $extension = $request->file('upload')->getClientOriginalExtension();
        $fileName = $fileName . '_' . time() . '.' . $extension;
        $request->file('upload')->move(public_path('media'),$fileName);

        $url = asset('media/'.$fileName);
        
        return response()->json(['fileName' => $fileName,'uploaded'=>1,'url'=>$url]);
     }
    }
}
