@extends('layouts.auth')
@section('content')

<section class="pt-20 p-2 lg:p-20 md:p-10">
    <div class="glass rounded-3xl px-4 py-16 sm:mx-6 lg:mx-8">
        <div class="max-w-2xl mx-auto">

            <div class="text-center">
                <h4 class="text-3xl text-white font-semibold mt-1 mb-12 pb-1">{{ config('app.name') }} | Registeration</h4>
            </div>


            <!-- <div class="text-center">
                <h4 class="text-xl text-white font-semibold mt-12 mb-2 pb-1 italic">Register with Gmail</h4>
            </div>
            <div class="flex justify-center mb-5">
                <div class="avatar ">
                    <div class="w-24 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                        <a href="{{ url('auth/google') }}">
                            <img src="{{ asset('images/gicon.png') }}" />
                        </a>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <h4 class="text-xl text-white mt-12 mb-2 pb-1 ">or</h4>
            </div> -->

            <div class="text-center">
                <h4 class="text-xl text-white font-semibold mt-12 mb-2 pb-1 italic">Register with Credentials</h4>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="my-8">
                    <label class="label">
                        <p class="label-text text-white text-xl mb-2">Name</p>
                        <p class="label-text-alt">Required</p>
                    </label>

                    <input placeholder="Enter Name" id="name" type="text" class="form-control input-md  block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-red-600 focus:outline-none" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="text-white italic" role="alert">
                        <span>{{ $message }}</span>
                    </span>
                    @enderror
                </div>



                <div class="my-8">
                    <label class="label">
                        <p class="label-text text-white text-xl mb-2">Email</p>
                        <p class="label-text-alt">Required</p>
                    </label>

                    <input placeholder="Enter Email" id="email" type="email" class="form-control input-md block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-red-600 focus:outline-none" name="email" value="{{ old('email') }}" required autocomplete="email">
                    @error('email')
                    <span class="text-white italic" role="alert">
                        <span>{{ $message }}</span>
                    </span>
                    @enderror
                </div>

                <div class="my-8">
                    <label class="label">
                        <p class="label-text text-white text-xl mb-2">Password</p>
                        <p class="label-text-alt">Required</p>
                    </label>

                    <input placeholder="Enter Password" id="password" type="password" class="form-control input-md block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-red-600 focus:outline-none" name="password" required autocomplete="new-password">
                    @error('password')
                    <span class="text-white italic" role="alert">
                        <span>{{ $message }}</span>
                    </span>
                    @enderror
                </div>

                <div class="my-8">
                    <label class="label">
                        <p class="label-text text-white text-xl mb-2">Confirm Password</p>
                        <p class="label-text-alt">Required</p>
                    </label>

                    <input placeholder="Confirm Password" id="password-confirm" type="password" class="form-control input-md block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-red-600 focus:outline-none" name="password_confirmation" required autocomplete="new-password">
                </div>


                <div class="text-center pt-1 mb-12 mt-10 pb-1">
                    <button type="submit" class="inline-block px-6 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-400 hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full mb-3 bg-gradient-to-r from-gray-900 via-green-400 to-green-700" type="button" data-mdb-ripple="true" data-mdb-ripple-color="light">
                        {{ __('Register') }}
                    </button>
                </div>


                <div class="flex items-center justify-between pb-6">
                    <p class="mb-0 mr-2 text-white">Already have an account?</p>
                    <a style="color:white !important" href="{{ route('login') }}" class="text-white inline-block px-6 py-2 border-2 border-green-600  font-medium text-xs leading-tight uppercase rounded hover:bg-black hover:bg-opacity-5 focus:outline-none focus:ring-0 transition duration-150 ease-in-out" data-mdb-ripple="true" data-mdb-ripple-color="light">
                        Login
                    </a>
                </div>
            </form>



        </div>
    </div>
</section>

@endsection
