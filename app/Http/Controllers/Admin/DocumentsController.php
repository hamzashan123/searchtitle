<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Documents;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class DocumentsController extends Controller
{
    public function index()
    {
        $documents = Documents::all();
        return view('admin.documents.index', compact('documents'));
    }

    public function userDocumentlist()
    {
        $documents = Documents::all();
        return view('admin.documents.documentlist', compact('documents'));
    }

    public function create()
    {
        return view('admin.documents.create');
    }

    public function store(Request $request)
    {
        //dd($request);
        $uploadedFile = $request->file('name');
        $filename = time() . $uploadedFile->getClientOriginalName();
        Storage::disk('local')->put('/public/documents/'. $filename, File::get($uploadedFile));
        $document = Documents::create([
            'name' => $filename,
            'type' => 'pdf'
        ]);
        
        return redirect()->route('admin.documents.index');

    }

  
    public function destroy(Documents $document)
    {
     

        $document->delete();

        return back();

    }
}
