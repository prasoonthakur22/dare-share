@extends('layouts.admin')
@section('content')
<div class="mx-auto min-h-screen">

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
                    <h4 class="text-3xl text-slate-900 font-semibold mt-1 mb-12 pb-1">Create Quizze for</h4>
                </div>
                <div class="text-center">
                    <h4 class="text-2xl text-slate-900 font-semibold mt-1 mb-12 pb-1">Dare: <span class="font-bold"> {{ $dare->title }} </span></h4>
                </div>

                <!-- Quizze Start -->
                <form id="quizeeForm" method="POST" action="{{ route('store.quizze') }}" enctype="multipart/form-data">
                    @csrf
                    <strong class="text-2xl" id="message"></strong>
                    <input id="dare_id" type="text" class="hidden" name="dare_id" value="{{ $dare->id }}" required autocomplete="dare_id" autofocus>
                    <div class="rounded-xl px-10 py-10 group shadow-lg hover:shadow-md hover:shadow-slate-800 drop-shadow-xl shadow-slate-800">
                        <div class="my-8">
                            <label class="label">
                                <p class="label-text text-slate-900 text-xl mb-2">Question</p>
                                <p class="label-text-alt">Required</p>
                            </label>
                            <input placeholder="Enter Question" name="question" id="question" type="text" class="form-control input-md  block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-red-600 focus:outline-none" value="{{ old('question') }}" required autocomplete="question" autofocus>
                            @error('question')
                            <span class="text-slate-900 italic" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                            @enderror
                        </div>


                        <div class="my-8">
                            <label class="label">
                                <p class="label-text text-slate-900 text-xl mb-2">Ask Question</p>
                                <p class="label-text-alt">Required</p>
                            </label>
                            <input placeholder="Enter Ask Question" name="ask_question" id="ask_question" type="text" class="form-control input-md  block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-red-600 focus:outline-none" value="{{ old('question') }}" required autocomplete="question" autofocus>
                            @error('question')
                            <span class="text-slate-900 italic" role="alert">
                                <span>{{ $message }}</span>
                            </span>
                            @enderror
                        </div>





                        <div class="text-center pt-1 mb-2 mt-10 pb-1">
                            <button type="submit" class="inline-block px-6 py-2.5 text-slate-900 font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-400 hover:shadow-lg focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full mb-3 bg-gradient-to-r from-gray-900 via-green-400 to-green-700" type="button" data-mdb-ripple="true" data-mdb-ripple-color="light">
                                {{ __('Create Quizee') }}
                            </button>
                        </div>
                    </div>
                </form>
                <!-- Quizze End -->

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
                                <th class="text-white font-bold">Add</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($quizzes as $quizze)
                            <tr>
                                <th class="text-slate-300 font-normal break-all">{{ $quizze->question }}</th>
                                <th class="text-slate-300 font-normal break-all">{{ $quizze->ask_question }}</th>
                                <td class="text-slate-300 font-normal">{{ $quizze->choices->count() }}</td>
                                <td class="text-slate-300 font-normal">
                                    <a href="{{ url('/admin/edit-quizze/'. $quizze->id) }}" class="btn glass capitalize shadow-lg hover:shadow-lg shadow-black hover:shadow-black">Edit Quizze</a>
                                </td>
                                <td class="text-slate-300 font-normal">
                                    <a href="{{ url('/admin/delete-quizze/'. $quizze->id) }}" class="btn glass capitalize shadow-lg hover:shadow-lg shadow-black hover:shadow-black">Delete Quizze</a>
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

<script src="{{ URL::asset('/js/fileUpload.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#quizeeForm').on('submit', function(e) {
            e.preventDefault()
            if (true) {
                let question = $('#question').val()
                let ask_question = $('#ask_question').val()
                let dare_id = $('#dare_id').val()
                if (!question) {
                    $('#message').html('Please enter question')
                    $('#message').addClass('block')
                    $('#message').removeClass('hidden')
                    setTimeout(function() {
                        $('#message').addClass('hidden')
                        $('#message').removeClass('block')
                    }, 3000)
                    return null
                } else {
                    $('#choicesForm').addClass('hidden')
                    $('#choicesForm').removeClass('block')
                }

                $.ajax({
                    type: 'POST',
                    url: "{{ url('/admin/store-quizze') }}",
                    data: {
                        _token: '{{ csrf_token() }}',
                        question: question,
                        ask_question: ask_question,
                        dare_id: dare_id,
                    },
                    dataType: 'json',
                    encode: true,
                    beforeSend: function() {},
                    success: function(result) {},
                    error: function(data) {
                        $('#message').html('Some error')
                    },
                    complete: function() {},
                }).done(function(result) {
                    if (result.success == true) {
                        location.reload()
                        $('#message').html(result.message)
                    } else {
                        $('#message').html(result.message)
                    }
                })
            }
        })
    })
</script>
@endsection
