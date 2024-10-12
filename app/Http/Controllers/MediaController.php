<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\OrganizationHierarchy;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {   
        return view('media.index');
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'file' => 'mimes:png,jpg,jpeg,pdf,doc,docx,xlsx,xls'
        ]);

        $media = $user->addMediaFromRequest('file')
                ->sanitizingFileName(function($fileName) {
                    return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                 })
                ->toMediaCollection(auth()->user()->organization->getRoot()->name_short);

        return response()->json(['success' => true, 'payload' => $media->id]);
    }

    public function destroy($id)
    {
        $user   = Auth::user();
        $media  = $user->getMedia($user->organization->getRoot()->name_short)->find($id);
        if($media)
        {
            if($media->messages->count())
            {
                return redirect('media')->with('warning','Media shared with another organization cannot be deleted.');
            }
            else{
                $media->delete();
            }

            return redirect('media')->with('success','Media deleted!');
        }
        else
        {
            abort(403);
        }
    }

    public function show($uuid)
    {   
        $media = Media::where('uuid',$uuid)->firstOrFail();
        
        if($media->hasAccess())
        {
            $ext = getExtension($media->file_name);
           
            if($ext ==='DOC' || $ext ==='DOCX' || $ext ==='XLSX')
            {
                return Storage::download(get_url($media), $media->file_name);
            }
            else{
                return response()->file(
                    Storage::path(get_url($media))
                );
            }
           
        }
        else{
            abort(403);
        }
    }
}
