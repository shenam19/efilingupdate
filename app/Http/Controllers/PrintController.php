<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
use PDF;

class PrintController extends Controller
{
    //
    public function __invoke(Message $message)
    {                           
        abort_if( ! $message->hasAccess(), 403);
        
        return view('mail.print',['message'=> $message]);
    }
}
