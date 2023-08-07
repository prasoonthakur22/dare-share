<?php

namespace App\Http\Controllers;

use App\Models\Creator;
use App\Models\CreatorDetail;
use App\Models\Dare;
use App\Models\Quizze;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;

class CreatorController extends Controller
{
    public function index($dare_id, Request $request)
    {
        $isExist = Creator::where([['dare_id', '=',  $dare_id], ['creator_ip', '=', $request->ip()]])->first();
        $dare = Dare::orderBy('id', 'DESC')->where(['id' => $dare_id])->first();

        if ($isExist) {
            $isSubmitted = CreatorDetail::where([['dare_id', '=',  $dare_id], ['creator_id', '=',  $isExist->id]])->first();
            if ($isSubmitted) {
                $share_url = URL::to('responder/' . $isExist->share_url);
                return view('creatorDetails.view', compact(['isExist', 'share_url', 'dare_id']));
            }

            return view('creatorDetails.index', compact(['isExist', 'dare']));
        }
        return view('creators.index', compact(['dare']));
    }

    public function store($dare_id, Request $request)
    {
        $isExist = Creator::where([['dare_id', '=',  $dare_id], ['creator_ip', '=', $request->ip()]])->first();

        $input = $request->all();
        $input['dare_id'] = $dare_id;
        $input['creator_ip'] = $request->ip();
        if (!$isExist) {
            $input['creator_id'] = Creator::create($input)->id;
        }

        $dare = Dare::orderBy('id', 'DESC')->where(['id' => $dare_id])->first();
        $isExist = Creator::where([['dare_id', '=',  $dare_id], ['creator_ip', '=', $request->ip()]])->first();

        $isSubmitted = CreatorDetail::where([['dare_id', '=',  $dare_id], ['creator_id', '=', $isExist->id]])->first();

        if ($isSubmitted) {
            $share_url = URL::to('responder/' . $isExist->share_url);
            return view('creatorDetails.view', compact(['isExist', 'share_url', 'dare_id']));
        }

        return redirect()->route('store.index', [$dare_id]);
        // return $this->sendResponse(null, 'data created');
        // return view('creatorDetails.index', compact(['isExist', 'dare']));
    }
}
