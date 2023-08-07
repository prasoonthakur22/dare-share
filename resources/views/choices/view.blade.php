@extends('layouts.admin')
@section('content')
<div class="mx-auto min-h-screen bg-slate-200" style="background-image: url('/images/home-bg.png')">

    <div class="p-[1rem] md:p-[5rem] lg:p-[5rem]">

        <div class="bg-transparent  px-4 py-12 sm:mx-6 lg:mx-8">
            <div class="max-w-4xl mx-auto">
                <div class="text-center">
                    <h4 class="text-3xl text-slate-900 font-semibold mt-1 mb-12 pb-1">View Choices for Question: <span class="font-bold">{{ $quizze->question }} </span> </h4>
                </div>
                <div class="text-center">
                    <h4 class="text-2xl text-slate-900 font-semibold mt-1 mb-12 pb-1">Dare: <span class="font-bold"> {{ $dare->title }} </span></h4>
                </div>
            </div>
        </div>
        <!-- Table  -->
        <div class="bg-transparent  px-4 py-12 sm:mx-6 lg:mx-8">
            <div class="max-w-4xl mx-auto">
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th class="text-white font-bold">Answer</th>
                                <th class="text-white font-bold">Answer Image</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quizze->choices as $choice)
                            <tr>
                                <th class="text-slate-300 font-normal">{{ $choice->answer }}</th>
                                <td class="text-slate-300 font-normal">
                                    <div class="flex items-center space-x-3">
                                        <div class="avatar">
                                            <div class="mask mask-squircle w-32 h-32">
                                                <img src="{{ asset('storage/' . $choice->answer_image) }}" alt="" />
                                            </div>
                                        </div>
                                    </div>
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

<!-- Start Quizee Save  -->
<script src="{{ URL::asset('/js/fileUpload.js') }}"></script>
@endsection
