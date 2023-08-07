<?php

namespace App\Http\Controllers;

use App\Models\Dare;
use App\Http\Requests\StoreDareRequest;
use App\Http\Requests\UpdateDareRequest;
use Illuminate\Support\Facades\Auth;

class DareController extends Controller
{
    public function create()
    {
        return view('dares.create');
    }

    public function store(StoreDareRequest $request)
    {
        $input = $request->all();
        if ($request->file('dare_image')) {
            $imageName = time() . '_' . $request->file('dare_image')->getClientOriginalName();
            $imageName = preg_replace('#[ -]+#', '-', $imageName);
            $input['image'] = $request->file('dare_image')->storeAs('',  "$imageName", 'public');
        }

        if ($request->has('dare_title')) {
            $input['title'] = $input['dare_title'];
        } else {
            $input['title'] = NULL;
        }

        if ($request->has('dare_description')) {
            $input['description'] = $input['dare_description'];
        } else {
            $input['description'] = NULL;
        }
        $data = Dare::create($input);
        return redirect('/admin/dashboard')->with('success', 'Dare Created Successfully');
    }

    public function edit($dare_id)
    {
        $dare = Dare::orderBy('id', 'DESC')->where(['id' => $dare_id])->first();
        return view('dares.edit', compact('dare'));
    }

    public function delete($dare_id)
    {
        $dare = Dare::orderBy('id', 'DESC')->where(['id' => $dare_id])->delete();
        return redirect('/admin/dashboard')->with('success', 'Dare Deleted Successfully');
    }

    public function update($dare_id, UpdateDareRequest $request)
    {
        $input = $request->all();
        if ($request->file('dare_image')) {
            $imageName = time() . '_' . $request->file('dare_image')->getClientOriginalName();
            $imageName = preg_replace('#[ -]+#', '-', $imageName);
            $input['image'] = $request->file('dare_image')->storeAs('',  "$imageName", 'public');
        }

        if ($request->has('dare_title')) {
            $input['title'] = $input['dare_title'];
        } else {
            $input['title'] = NULL;
        }

        if ($request->has('dare_description')) {
            $input['description'] = $input['dare_description'];
        } else {
            $input['description'] = NULL;
        }
        $dare = Dare::where('id', '=', $dare_id)->first();
        $data =  $dare->update($input);
        return redirect('/admin/dashboard')->with('success', 'Dare Updated Successfully');
    }
}
