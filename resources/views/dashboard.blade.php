@extends('layouts.admin')

@section('content')
<div class="mx-auto min-h-screen">

    <div class="p-[1rem] md:p-[5rem] lg:p-[5rem]">
        <a href="{{ url('/admin/create-dare') }}" class="btn btn-wide">Create Dare</a>

        <progress class="progress w-full h-1"></progress>


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

        <div class="flex flex-wrap">
            @foreach ($dares as $dare)
            <div class="w-full hover:bg-green-300 sm:w-[46md] md:w-[100%] lg:w-[23%] flx flex-col m-5 group shadow-lg hover:shadow-md hover:shadow-slate-800 drop-shadow-xl shadow-slate-800 rounded-3xl">
                <div class="card glass rounded-3xl drop-shadow-xl overflow-hidden flex-1 flex flex-col">
                    <div class="p-5 flex-1 flex flex-col align-middle place-items-center ">
                        <div class="card h-96 w-full bg-base-100 shadow-xl image-full">
                            <figure><img src="{{ asset('storage/' . $dare->image) }}" /></figure>
                            <div class="card-body">
                                <div class="stat-value text-white">{{ $dare->title }}</div>
                                <h2 class="card-title">{{ $dare->description }}</h2>
                                <div class="card-actions justify-start mt-5">
                                    <a href="{{ url('/admin/edit-dare/'. $dare->id) }}" class="btn glass capitalize shadow-lg hover:shadow-lg shadow-black hover:shadow-black">Edit Dare</a>
                                    <a href="{{ url('/admin/delete-dare/'. $dare->id) }}" class="btn glass capitalize shadow-lg hover:shadow-lg shadow-black hover:shadow-black">Delete Dare</a>
                                </div>
                                <hr class="mt-5">
                                <h2 class="card-title">Quizess: {{ $dare->quizess->count() }}</h2>
                                <div class="card-actions justify-start mt-5">
                                    <a href="{{ url('/admin/view-quizze/'. $dare->id) }}" class="btn glass capitalize shadow-lg hover:shadow-lg shadow-black hover:shadow-black">View Quizzes</a>

                                    <a href="{{ url('/admin/add-quizze/'. $dare->id) }}" class="btn glass capitalize shadow-lg hover:shadow-lg shadow-black hover:shadow-black">Add Quizzes</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>


    </div>

</div>
@endsection
