<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Documents;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Mail\EmailToUser;
use Mail;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DocumentsController extends Controller
{
    public function index()
    {
        $documents = DB::table('documents')->join('users','users.id','=','documents.user_id')->select('documents.*','users.email')->get();
        return view('admin.documents.index', compact('documents'));
    }

    public function getDocuments()
    {
        $documents = Documents::all();
        return view('admin.documents.index', compact('documents'));
    }
    public function userDocumentlist()
    {
        $documents = DB::table('documents')->where('user_id',Auth::user()->id)->join('users','users.id','=','documents.user_id')->select('documents.*','users.email')->get();
        return view('admin.documents.documentlist', compact('documents'));
    }

    public function sendDocumentEmail(int $documentid)
    {
        $document = Documents::where('id', $documentid)->first();
        $data = [
            'documenturl' => asset('/storage/documents/' . $document->name),
            'message' => 'message for document!'
        ];
        Mail::to('admin@searchtitle.com')->send(new EmailToUser($data));
        return redirect()->back()->with('success', 'Email Send Successfully!');
    }
    public function create()
    {
        $users = User::whereDoesntHave('roles', function ($q) {
            $q->where('title', 'Admin');
        })->get();
        
        return view('admin.documents.create',compact('users'));
    }

    public function store(Request $request)
    {
        //dd(count($request->users));
        $uploadedFile = $request->file('name');
        $filename = time() . $uploadedFile->getClientOriginalName();
        Storage::disk('local')->put('/public/documents/' . $filename, File::get($uploadedFile));
        if(count($request->users) > 0){
            foreach($request->users as $user){
                $document = Documents::create([
                    'name' => $filename,
                    'type' => 'pdf',
                    'user_id' => $user,
                    'category' => $request->category
                ]);
            }
            
        }
       

        return redirect()->route('admin.documents.index');
    }


    public function destroy(Documents $document)
    {


        $document->delete();

        return back();
    }
}
