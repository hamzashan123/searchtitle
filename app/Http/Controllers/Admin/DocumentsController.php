<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Documents;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Mail\EmailToUser;
use Mail;

class DocumentsController extends Controller
{
    public function index()
    {
        $documents = Documents::all();
        return view('admin.documents.index', compact('documents'));
    }

    public function getDocuments(){
        $documents = Documents::all();
        return view('admin.documents.index', compact('documents'));
    }
    public function userDocumentlist()
    {
        $documents = Documents::all();
        return view('admin.documents.documentlist', compact('documents'));
    }

    public function sendDocumentEmail(int $documentid){
        $document = Documents::where('id',$documentid)->first();
        $data = [
            'documenturl' => asset('/storage/documents/'.$document->name),
            'message' => 'message for document!'
        ];
        Mail::to('hamzashan123@gmail.com')->send(new EmailToUser($data));
        return redirect()->back()->with('success','Email Send Successfully!');
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
        Storage::disk('local')->put('/public/documents/' . $filename, File::get($uploadedFile));
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
