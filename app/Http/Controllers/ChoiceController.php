<?php

namespace App\Http\Controllers;

use App\Models\Choice;
use App\Http\Requests\StoreChoiceRequest;
use App\Http\Requests\UpdateChoiceRequest;
use App\Models\Dare;
use App\Models\Quizze;

class ChoiceController extends Controller
{
    public function addChoice($quizze_id)
    {
        $quizze = Quizze::with('choices')->orderBy('id', 'DESC')->where(['id' => $quizze_id])->first();
        $dare = Dare::orderBy('id', 'DESC')->where(['id' => $quizze->dare_id])->first();
        return view('choices.create', compact(['quizze', 'dare']));
    }

    public function viewChoice($quizze_id)
    {
        $quizze = Quizze::with('choices')->orderBy('id', 'DESC')->where(['id' => $quizze_id])->first();
        $dare = Dare::orderBy('id', 'DESC')->where(['id' => $quizze->dare_id])->first();
        return view('choices.view', compact(['quizze', 'dare']));
    }

    public function storeChoice(StoreChoiceRequest $request)
    {
        $input = $request->all();
        if ($request->file('answer_image')) {
            $imageName = time() . '_' . $request->file('answer_image')->getClientOriginalName();
            $imageName = preg_replace('#[ -]+#', '-', $imageName);
            $input['answer_image'] = $request->file('answer_image')->storeAs('',  "$imageName", 'public');
        }
        if ($request->has('answer')) {
            $input['answer'] = $input['answer'];
        } else {
            $input['answer'] = NULL;
        }
        $data = Choice::create($input);
        return back()->with('success', 'Choice Created Successfully');
    }

    public function editChoice($choice_id)
    {
        $choice = Choice::where('id', '=', $choice_id)->first();
        $quizze = Quizze::with('choices')->orderBy('id', 'DESC')->where(['id' => $choice->quizze_id])->first();
        $dare = Dare::orderBy('id', 'DESC')->where(['id' => $quizze->dare_id])->first();
        return view('choices.edit', compact(['quizze', 'dare', 'choice']));
    }

    public function updateChoice($choice_id, UpdateChoiceRequest $request)
    {
        $input = $request->all();
        if ($request->file('answer_image')) {
            $imageName = time() . '_' . $request->file('answer_image')->getClientOriginalName();
            $imageName = preg_replace('#[ -]+#', '-', $imageName);
            $input['answer_image'] = $request->file('answer_image')->storeAs('',  "$imageName", 'public');
        }
        if ($request->has('answer')) {
            $input['answer'] = $input['answer'];
        } else {
            $input['answer'] = NULL;
        }
        $choice = Choice::where('id', '=', $choice_id)->first();
        $choice->update($input);
        return back()->with('success', 'Choice Updated Successfully');
    }

    public function deleteChoice($choice_id)
    {
        $choice = Choice::where('id', '=', $choice_id)->delete();
        return back()->with('success', 'Choice Deleted Successfully');
    }
}
