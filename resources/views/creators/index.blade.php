@extends('layouts.app')
@section('content')

<div class="mx-auto min-h-[90vh]">

    <div class="p-[1rem] md:p-[5rem] lg:p-[5rem]">

        <div class="bg-transparent  px-4 py-12 sm:mx-6 lg:mx-8">

            <div class="max-w-4xl glass mx-auto rounded-3xl group shadow-lg hover:shadow-md hover:shadow-slate-800 drop-shadow-xl shadow-slate-800 p-10">

                <div class="text-center">
                    <h4 class="text-3xl text-slate-900 font-semibold mt-1 pb-1"><span class="font-bold">{{ $dare->description }}</span> </h4>
                </div>
                <div class="text-center">
                    <h4 class="text-lg sm:text-xl md:text-xl lg:text-xl xl:text-xl 2xl:text-xl text-slate-900 font-semibold mt-1 pb-1">Dare: {{ $dare->title }}</h4>
                </div>

                <form method="POST" action="{{ route('store.creator', ['dare_id' => $dare->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="rounded-xl py-10">

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
                                <p class="label-text text-slate-900 text-lg sm:text-xl md:text-xl lg:text-xl xl:text-xl 2xl:text-xl mb-2">Name</p>
                                <p class="label-text-alt">Required</p>
                            </label>

                            <input placeholder="Enter your name" id="name" type="text" class="rounded-3xl form-control input-md  block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-red-600 focus:outline-none" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="text-slate-900 italic" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                            @enderror
                        </div>


                        <div class="text-center pt-1 mb-12 mt-10 pb-1">
                            <button type="submit" class="text-lg sm:text-xl md:text-xl lg:text-xl xl:text-xl 2xl:text-xl rounded-3xl group shadow-lg hover:shadow-md hover:shadow-slate-800 drop-shadow-xl shadow-slate-800 inline-block px-6 py-2.5 text-slate-900 font-medium leading-tight uppercase hover:bg-green-400 focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full mb-3 bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500" type="button" data-mdb-ripple="true" data-mdb-ripple-color="light">
                                {{ __('Start') }}
                            </button>
                        </div>
                    </div>
                </form>
                <!-- Form End -->
            </div>

        </div>

    </div>

</div>

@endsection
