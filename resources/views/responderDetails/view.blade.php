@extends('layouts.app')
@section('content')

<div class="mx-auto min-h-[90vh]">

    <div class="p-[1rem] md:p-[5rem] lg:p-[5rem]">

        <div class="bg-transparent px-4 py-12 sm:mx-6 lg:mx-8">

            <div class="max-w-4xl glass mx-auto rounded-3xl group shadow-lg hover:shadow-md hover:shadow-slate-800 drop-shadow-xl shadow-slate-800 p-10">

                <div class="text-center">
                    <h4 class="text-3xl text-slate-900 font-semibold mt-1 pb-1"><span class="font-bold">Dare: {{ $dare->title }}</span> </h4>
                    <h4 class="text-xl text-slate-900 font-semibold mt-1 pb-1"><span class="font-bold">{{ $dare->description }}</span> </h4>
                </div>
                <hr class="my-12">
                <div class="text-center">
                    <h4 class="text-lg sm:text-xl md:text-xl lg:text-xl xl:text-xl 2xl:text-xl text-slate-900 mt-1 pb-1">
                        Hi <span class="font-semibold">{{ $responder->name }} !</span>
                        <br>
                        You Answered: <span class="font-semibold">{{ $responderDetail->anwered_counts }}</span> out of 10 Quizze
                        <br>
                        in the Dare Created By <span class="font-semibold">{{ $creator->name }}</span>
                    </h4>
                </div>

                <div class="py-10 mb-7">
                    <!-- Table  -->

                    <div class="bg-transparent rounded-3xl px-4 py-12 sm:mx-6 lg:mx-8">
                        <div class="max-w-4xl mx-auto">
                            <div class="overflow-x-auto">
                                <table class="table w-full">
                                    <thead>
                                        <tr>
                                            <th class="text-white font-bold">Responder</th>
                                            <th class="text-white font-bold">Answers</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($allResponders as $responder)
                                        <tr>
                                            <th class="text-slate-300 font-normal"> {{ $responder->name }}</th>
                                            <td class="text-slate-300 font-normal">
                                                @if($responder->responderDetails->first() != null)
                                                {{ $responder->responderDetails->first()->anwered_counts }}
                                                @else
                                                Responder does not answered yet.
                                                @endif
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

        </div>

    </div>
</div>

@endsection
