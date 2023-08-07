@extends('layouts.auth')
@section('content')

<section class="pt-20 p-2 lg:p-20 md:p-10">
    <div class="glass rounded-3xl px-4 py-16 sm:mx-6 lg:mx-8">
        <div class="max-w-2xl mx-auto">


        <div class="text-center">
                <h4 class="text-3xl text-white font-semibold mt-1 mb-12 pb-1">{{ config('app.name') }} | Password Reset</h4>
            </div>


            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-4">
                    <label class="label">
                        <p class="label-text text-white text-xl mb-2">Email</p>
                        <p class="label-text-alt">Required</p>
                    </label>
                    <input placeholder="Enter Email" id="email" type="email" class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-red-600 focus:outline-none" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>


                <div class="text-center pt-1 mb-12 pb-1">
                    <button type="submit" class="inline-block px-6 py-2.5 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-red-700 hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full mb-3 bg-gradient-to-r from-gray-900 via-red-800 to-red-700" type="button" data-mdb-ripple="true" data-mdb-ripple-color="light">
                        {{ __('Send Password Reset Link') }}
                    </button>

                </div>
            </form>



        </div>
    </div>
</section>
@endsection
