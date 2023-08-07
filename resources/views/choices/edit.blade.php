@extends('layouts.admin')
@section('content')
<div class="mx-auto min-h-screen bg-slate-200" style="background-image: url('/images/home-bg.png')">

    <div class="p-[1rem] md:p-[5rem] lg:p-[5rem]">

        <div class="bg-transparent  px-4 py-12 sm:mx-6 lg:mx-8">
            <div class="max-w-4xl mx-auto">

                @if ($message = Session::get('success'))
                <div class="alert alert-success shadow-lg">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ $message }}</span>
                    </div>
                </div>
                @endif

                @if (count($errors) > 0)
                <div class="alert alert-error shadow-lg">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li><span>{{ $error }}</span></li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <div class="text-center">
                    <h4 class="text-3xl text-slate-900 font-semibold mt-1 mb-12 pb-1">Update Choice for Question: <span class="font-bold">{{ $quizze->question }}</span> </h4>
                </div>
                <div class="text-center">
                    <h4 class="text-2xl text-slate-900 font-semibold mt-1 mb-12 pb-1">Dare: {{ $dare->title }}</h4>
                </div>


                <!-- Choices Start -->
                <form id="choicesForm" method="POST" action="{{ route('update.choice', ['choice_id' => $choice->id] ) }}" enctype="multipart/form-data">
                    @csrf
                    <strong class="text-2xl" id="message"></strong>
                    <input id="choice_id" type="text" class="hidden" name="choice_id" value="{{ $choice->id }}" required autocomplete="choice_id" autofocus>
                    <input id="quizze_id" type="text" class="hidden" name="quizze_id" value="{{ $quizze->id }}" required autocomplete="quizze_id" autofocus>

                    <div class="rounded-xl px-10 py-10 group shadow-lg hover:shadow-md hover:shadow-slate-800 drop-shadow-xl shadow-slate-800">
                        <div class="my-8">
                            <label class="label">
                                <p class="label-text text-slate-900 text-xl mb-2">Answer</p>
                                <p class="label-text-alt">Nullable</p>
                            </label>
                            <input placeholder="Enter answer" name="answer" id="answer" type="text" class="form-control input-md  block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-red-600 focus:outline-none" value="{{ $choice->answer }}" required autocomplete="answer" autofocus>
                            @error('question')
                            <span class="text-slate-900 italic" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                            @enderror
                        </div>

                        <div class="my-8">

                            <p class="label-text text-slate-900 text-xl mb-2">Old Answer Image</p>
                            <div class="bg-transparent object-cover flow-root max-w-sm card rounded-lg drop-shadow-3xl overflow-hidden items-center ">
                                <div class="float-left object-cover">
                                    <figure><img class="object-cover" src="{{ asset('storage/' . $choice->answer_image) }}" /></figure>
                                </div>
                            </div>

                            <label class="label">
                                <p class="label-text text-slate-900 text-xl mb-2">New Answer Image</p>
                                <p class="label-text-alt">Optional</p>
                            </label>
                            <!-- FileInfo  -->
                            <div id="fileInfoBox" class="bg-transparent object-cover flow-root hide max-w-sm card rounded-lg drop-shadow-3xl overflow-hidden items-center ">
                                <div class="float-left object-cover">
                                    <figure><img class="object-cover" id="previewImg" src="" /></figure>
                                </div>
                            </div>
                            <!-- FileInfo End -->

                            <!-- Form  -->
                            <div class="upload-button" draggable="true" id="myFileList">
                                <label class="bg-white hover:bg-green-200 border-dotted border-2 border-black items-center flex justify-center  h-32 transition rounded-md cursor-pointer">
                                    <span class="flex justify-center items-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white-900" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        <span class="font-medium text-white-600">
                                            Drop file to Attach, or
                                            <span class="">browse</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <input class="file-upload" name="answer_image" type="file" id="fileup" accept="image/*" multiple="" hidden>
                            <!-- Form End -->

                            <div class="text-center pt-1 mb-12 mt-10 pb-1">
                                <button type="submit" class="inline-block px-6 py-2.5 text-slate-900 font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-400 hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full mb-3 bg-gradient-to-r from-gray-900 via-green-400 to-green-700" type="button" data-mdb-ripple="true" data-mdb-ripple-color="light">
                                    {{ __('Update') }}
                                </button>
                            </div>

                        </div>
                    </div>
                </form>
                <!-- Choices End -->
            </div>
        </div>
        <!-- Table  -->
        <div class="bg-transparent  px-4 py-12 sm:mx-6 lg:mx-8">
            <div class="mx-auto">
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <thead>
                            <tr>
                                <th class="text-white font-bold">Answer</th>
                                <th class="text-white font-bold">Answer Image</th>
                                <th class="text-white font-bold">Edit</th>
                                <th class="text-white font-bold">Delete</th>
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
                                <td class="text-slate-300 font-normal">
                                    <a href="{{ url('/admin/edit-choice/'. $choice->id) }}" class="btn glass capitalize shadow-lg hover:shadow-lg shadow-black hover:shadow-black">Edit choice</a>
                                </td>

                                <td class="text-slate-300 font-normal">
                                    <a href="{{ url('/admin/delete-choice/'. $choice->id) }}" class="btn glass capitalize shadow-lg hover:shadow-lg shadow-black hover:shadow-black">Delete choice</a>
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
<script src="{{ URL::asset('/js/fileUpload.js') }}"></script>
@endsection
