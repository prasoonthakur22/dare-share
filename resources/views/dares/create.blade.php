@extends('layouts.admin')
@section('content')

<div class="mx-auto min-h-screen ">

    <div class="p-[1rem] md:p-[5rem] lg:p-[5rem]">

        <div class="bg-transparent  px-4 py-12 sm:mx-6 lg:mx-8">
            <div class="max-w-4xl mx-auto">

                <div class="text-center">
                    <h4 class="text-3xl text-slate-900 font-semibold mt-1 mb-12 pb-1">Create Dare</h4>
                </div>

                <form method="POST" action="{{ route('store.dare') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="rounded-xl px-10 py-10 group shadow-lg hover:shadow-md hover:shadow-slate-800 drop-shadow-xl shadow-slate-800">

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

                        <div class="my-8">
                            <label class="label">
                                <p class="label-text text-slate-900 text-xl mb-2">Dare Title</p>
                                <p class="label-text-alt">Required</p>
                            </label>

                            <input placeholder="Enter dare title" id="dare_title" type="text" class="form-control input-md  block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-red-600 focus:outline-none" name="dare_title" value="{{ old('dare_title') }}" required autocomplete="dare_title" autofocus>
                            @error('dare_title')
                            <span class="text-slate-900 italic" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                            @enderror
                        </div>

                        <div class="my-8">
                            <label class="label">
                                <p class="label-text text-slate-900 text-xl mb-2">Dare Description</p>
                                <p class="label-text-alt">Optional</p>
                            </label>

                            <input placeholder="Enter dare description" id="dare_description" type="text" class="form-control input-md block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-red-600 focus:outline-none" name="dare_description" value="{{ old('dare_description') }}" autocomplete="dare_description">
                            @error('dare_description')
                            <span class="text-slate-900 italic" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                            @enderror
                        </div>

                        <div class="my-8">
                            <label class="label">
                                <p class="label-text text-slate-900 text-xl mb-2">Dare Image</p>
                                <p class="label-text-alt">Optional</p>
                            </label>
                            <!-- FileInfo  -->
                            <div id="fileInfoBox" class="hide bg-transparent object-cover flow-root max-w-sm card rounded-lg drop-shadow-3xl overflow-hidden items-center ">
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
                                            <span class="">Browse</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <input class="file-upload" name="dare_image" type="file" id="fileup" accept="image/*" multiple="" hidden>
                        </div>

                        <div class="text-center pt-1 mb-12 mt-10 pb-1">
                            <button type="submit" class="inline-block px-6 py-2.5 text-slate-900 font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-400 hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full mb-3 bg-gradient-to-r from-gray-900 via-green-400 to-green-700" type="button" data-mdb-ripple="true" data-mdb-ripple-color="light">
                                {{ __('Create') }}
                            </button>
                        </div>
                    </div>
                </form>
                <!-- Form End -->

            </div>
        </div>

    </div>

</div>

<script src="{{ URL::asset('/js/fileUpload.js') }}"></script>
@endsection
