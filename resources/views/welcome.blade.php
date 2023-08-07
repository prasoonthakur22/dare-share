@extends('layouts.app')

@section('content')
<div class="min-h-[90vh]">
    <div class="p-[1rem] md:p-[5rem] lg:p-[5rem]">

        <div class=" text-center mt-16 mb-5">
            <span class="box-decoration-clone rounded-3xl bg-gradient-to-r from-indigo-600 to-pink-500 text-white px-3 py-2">
                Welcome<br>
                <hr>
                Dear!
            </span>

        </div>

        <!-- bg-yellow-300 sm:bg-green-300 md:bg-indigo-500
            lg:bg-red-400 xl:bg-sky-600 2xl:bg-black -->


        <div class="mx-auto mb-10">
            <div class="
            p-5
            grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-4 2xl:grid-cols-4
            gap-8 sm:gap-8 md:gap-16 lg:gap-16 xl:gap-16 2xl:gap-16">

                @foreach ($dares as $dare)
                <a class="rounded-3xl" href="{{ url('creator/'. $dare->id) }}">
                    <div class="group shadow-lg hover:shadow-md hover:shadow-slate-800 drop-shadow-xl shadow-slate-800 flex justify-center cursor-pointer hover:cursor-pointer rounded-3xl">
                        <div class="w-full rounded-3xl">
                            <div class="align-middle place-items-center">
                                <div class="card w-full bg-white shadow-xl">
                                    <div class="card-body">
                                        @if($dare->image)
                                        <figure><img class="mask mask-circle max-h-40 sm:max-h-40 md:max-h-40 lg:max-h-40 xl:max-h-40 2xl:max-h-40" src="{{ asset('storage/' . $dare->image) }}" alt="{{ $dare->title }}" /></figure>
                                        @else
                                        <figure><img class="mask mask-circle max-h-40 sm:max-h-40 md:max-h-40 lg:max-h-40 xl:max-h-40 2xl:max-h-40" src="https://placeimg.com/400/225/arch" alt="{{ $dare->title }}" /></figure>
                                        @endif

                                        <h2 class="card-title break-all font-bold sm:text-xl md:text-xl lg:text-2xl xl:text-2xl 2xl:text-2xl">{{ $dare->title }}</h2>
                                        <p class="break-all">{{ $dare->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach

            </div>
        </div>



    </div>

</div>
@endsection
