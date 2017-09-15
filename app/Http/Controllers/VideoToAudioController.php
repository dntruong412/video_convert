<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VideoToAudioController extends Controller
{

    public function index() {
    	return view('welcome');
    }

    public function convert(Request $request) {
        $ytb = new \App\Helpers\Youtube($request->input('video_id'));
        $yProcess = new \App\Helpers\YProcess($ytb);
        
        return response()->download($yProcess->convert())->deleteFileAfterSend(true);
    }

}
