@extends('layouts.admin')
@section('content')
<div class="mx-auto min-h-screen">

    <div class="p-[1rem] md:p-[5rem] lg:p-[5rem]">

        <div class="bg-transparent  px-4 py-12 sm:mx-6 lg:mx-8">
            <div class="max-w-4xl mx-auto">
                <div class="text-center">
                    <h4 class="text-3xl text-slate-900 font-semibold mt-1 mb-12 pb-1">Quizzes for</h4>
                </div>
                <div class="text-center">
                    <h4 class="text-2xl text-slate-900 font-semibold mt-1 mb-12 pb-1">Dare: <span class="font-bold"> {{ $dare->title }} </span></h4>
                </div>
            </div>
        </div>



        <!-- Table  -->

        <div class="bg-transparent  px-4 py-12 sm:mx-6 lg:mx-8">
            <div class="mx-auto">

                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th class="text-white font-bold">Quizee</th>
                                <th class="text-white font-bold">Ask Quizee</th>
                                <th class="text-white font-bold">Count Answers</th>
                                <th class="text-white font-bold">Edit</th>
                                <th class="text-white font-bold">Delete</th>
                                <th class="text-white font-bold">View</th>
                                <th class="text-white font-bold">Add</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quizzes as $quizze)
                            <tr>
                                <th class="text-slate-300 font-normal">{{ $quizze->question }}</th>
                                <th class="text-slate-300 font-normal">{{ $quizze->ask_question }}</th>
                                <td class="text-slate-300 font-normal">{{ $quizze->choices->count() }}</td>
                                <td class="text-slate-300 font-normal">
                                    <a href="{{ url('/admin/edit-quizze/'. $quizze->id) }}" class="btn glass capitalize shadow-lg hover:shadow-lg shadow-black hover:shadow-black">Edit Quizze</a>
                                </td>

                                <td class="text-slate-300 font-normal">
                                    <a href="{{ url('/admin/delete-quizze/'. $quizze->id) }}" class="btn glass capitalize shadow-lg hover:shadow-lg shadow-black hover:shadow-black">Delete Quizze</a>
                                </td>

                                <td class="text-slate-300 font-normal">
                                    <a href="{{ url('/admin/view-choice/'. $quizze->id) }}" class="btn glass capitalize shadow-lg hover:shadow-lg shadow-black hover:shadow-black">View Answers</a>
                                </td>
                                <td class="text-slate-300 font-normal">
                                    <a href="{{ url('/admin/add-choice/'. $quizze->id) }}" class="btn glass capitalize shadow-lg hover:shadow-lg shadow-black hover:shadow-black">Add Answers</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
