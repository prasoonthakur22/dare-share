@extends('layouts.app')
@section('content')

<div class="mx-auto min-h-[90vh]">

    <div class="p-[1rem] md:p-[5rem] lg:p-[5rem]">
        <div class="bg-transparent  px-4 py-12 sm:mx-6 lg:mx-8">
            <div class="max-w-4xl mx-auto">
                <div class="text-center">
                    <h4 class="text-3xl text-slate-900 font-semibold mt-1 pb-1">Quizzee by {{ $isExist->name }}</h4>
                    <p class="my-6 text-white">Answer this Quizzee</p>
                </div>
                <div class="">
                    <div class="text-center">
                        <h4 id="dare" class="text-3xl text-slate-900 font-semibold mt-1 mb-12 pb-1"></h4>
                    </div>

                    <input id="creator_name" type="text" class="hidden" name="creator_name" value="{{ $isExist->name }}" autocomplete="creator_name" autofocus>
                    <input id="dare_id" type="text" class="hidden" name="dare_id" value="{{ $dare->id }}" required autocomplete="dare_id" autofocus>
                    <input id="creator_id" type="text" class="hidden" name="creator_id" value="{{ $isExist->id }}" required autocomplete="creator_id" autofocus>
                    <input id="responder_id" type="text" class="hidden" name="responder_id" value="{{ $responder_id }}" required autocomplete="responder_id" autofocus>

                    <div>
                        <ul class="text-center mb-5">
                            <li class="badge badge-lg mb-2" id="num1">1</li>
                            <li class="badge badge-lg mb-2" id="num2">2</li>
                            <li class="badge badge-lg mb-2" id="num3">3</li>
                            <li class="badge badge-lg mb-2" id="num4">4</li>
                            <li class="badge badge-lg mb-2" id="num5">5</li>
                            <li class="badge badge-lg mb-2" id="num6">6</li>
                            <li class="badge badge-lg mb-2" id="num7">7</li>
                            <li class="badge badge-lg mb-2" id="num8">8</li>
                            <li class="badge badge-lg mb-2" id="num9">9</li>
                            <li class="badge badge-lg mb-2" id="num10">10</li>
                        </ul>
                    </div>

                    <div id="quizzes" class="max-w-4xl">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="rounded-xl py-10 mb-52">
        <!-- Table  -->

        <div class="bg-transparent px-4 py-12 sm:mx-6 lg:mx-8">
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

<script>
    // #####
    var lastQuizzeID;
    var answerClicked;
    var correctAnswerCount = 0;
    var questionCount = 1;
    var skippedQuestions = [];
    var unansweredQuizzes = [];
    var asset_url = "{{asset('/storage')}}";

    Array.prototype.remove = function(from, to) {
        var rest = this.slice((to || from) + 1 || this.length);
        this.length = from < 0 ? this.length + from : from;
        return this.push.apply(this, rest);
    };

    $(document).ready(function() {
        answerClicked = function(element) {

            if (questionCount <= 10) {
                var ans_id = parseInt(element.parentNode.parentNode.id.replace(/^\D+/g, ''));
                var quizee_id = parseInt(element.parentNode.id.replace(/^\D+/g, ''));
                var creator_id = $('#creator_id').val()
                var choice_id = element.id;
                var dare_id = $('#dare_id').val()
                var responder_id = $('#responder_id').val()

                if (ans_id == choice_id) {
                    $("#" + choice_id + "").addClass('bg-green-400')
                    // console.log('correct')

                    correctAnswerCount++
                } else {
                    $("#" + choice_id + "").addClass('bg-red-400')
                    $("#" + ans_id + "").addClass('bg-green-400')
                    setTimeout(function() {}, 3000);
                    // console.log('In correct')
                }

                $("#quizzeBox" + quizee_id + "").addClass('Answered')

                if (!(questionCount == 10)) {
                    setTimeout(function() {
                        $("#quizzeBox" + quizee_id + "").addClass('hide')
                        $("#quizzeBox" + quizee_id + "").removeClass('show')

                        nextQuizee_id = yieldQuizze(quizee_id).next().value;
                        // console.log('current Q = ' + nextQuizee_id)
                        // console.log('_____________________')

                        $("#quizzeBox" + nextQuizee_id + "").addClass('show')
                        $("#quizzeBox" + nextQuizee_id + "").removeClass('hide')
                    }, 500);
                } else {

                    $.ajax({
                        type: 'POST',
                        url: "/responder_details/" + creator_id,
                        data: {
                            _token: '{{ csrf_token() }}',
                            anwered_counts: correctAnswerCount,
                            responder_id: responder_id,
                        },
                        dataType: 'json',
                        encode: true,
                        beforeSend: function() {},
                        success: function(result) {},
                        error: function(result) {
                            // console.log(result.responseText)
                            $('#message').html('Some error')
                        },
                        complete: function() {},
                    }).done(function(result) {});

                    // console.log(correctAnswerCount)

                    setTimeout(function() {
                        $("#quizzeBox" + quizee_id + "").addClass('hide')
                        $("#quizzeBox" + quizee_id + "").removeClass('show')
                    }, 500);

                    setTimeout(function() {
                        location.reload();
                    }, 500);
                }

                $('#num' + questionCount + "").addClass('badge-success border-1 border-black border-solid')

                questionCount++;
            } else {
                // console.log('completed')
            }
        }

        function* yieldQuizze(ID = 0) {
            while (true) {
                // console.log('lastQuizzeID ' + lastQuizzeID)
                let cIndex = unansweredQuizzes.indexOf(ID);
                // console.log('Answered [cIndex] ' + unansweredQuizzes[cIndex])

                if (unansweredQuizzes[cIndex] == lastQuizzeID) {
                    // console.log('.../restart')
                    cIndex = 0;
                }
                unansweredQuizzes.remove(cIndex)
                // console.log(unansweredQuizzes)
                cIndex = (cIndex + 1);

                if (cIndex >= unansweredQuizzes.length) {
                    cIndex = 0
                }
                yield(unansweredQuizzes[cIndex]);
            }
        }
        const quizzeIterator = yieldQuizze();

        if (true) {
            let dare_id = $('#dare_id').val()
            const creator_name = $('#creator_name').val()
            var finalData = <?php echo json_encode($finalData); ?>;
            // console.log(finalData);
            // $('#dare').html(result.data.dare.title)
            // $('#quizze').html(result.data.quizze.question)

            let i = 1;
            // lastQuizzeID = result.data.quizze.slice(-1)[0].id
            $.each(finalData, function(key, value) {
                unansweredQuizzes[key] = value.quizze.id;
                if (i == 1) {
                    nextQID = value.quizze.id;

                    i++;
                    $('#quizzes').append(
                        '<div id="quizzeBox' + value.quizze.id + '" class="show">' +
                        '<div class="glass rounded-3xl px-5 py-10 group shadow-lg hover:shadow-lg hover:shadow-slate-800 drop-shadow-xl shadow-slate-800 border-solid border-green-400 border-2 hover:border-solid hover:border-green-400 hover:border-2">' +
                        '<div class="text-center pt-1 mb-12 mt-10 pb-1">' +
                        '<div class="text-center">' +
                        '<p class="text-3xl text-slate-900 font-semibold mt-1 mb-5 pb-1">' + value.quizze.ask_question.replace('[name]', creator_name) + '</p>' +
                        '<div id="ans' + value.answer_id + '">' +
                        '<div id="quizze' + value.quizze.id + '" class="flex flex-wrap">' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    )
                } else {
                    $('#quizzes').append(
                        '<div id="quizzeBox' + value.quizze.id + '" class="hide">' +
                        '<div  class="glass rounded-3xl px-5 py-10 group shadow-lg hover:shadow-lg hover:shadow-slate-800 drop-shadow-xl shadow-slate-800 border-solid border-green-400 border-2 hover:border-solid hover:border-green-400 hover:border-2">' +
                        '<div class="text-center pt-1 mb-12 mt-10 pb-1">' +
                        '<div class="text-center">' +
                        '<p class="text-3xl text-slate-900 font-semibold mt-1 mb-5 pb-1">' + value.quizze.ask_question.replace('[name]', creator_name) + '</p>' +
                        '<div id="ans' + value.answer_id + '">' +
                        '<div id="quizze' + value.quizze.id + '" class="flex flex-wrap">' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>'
                    )
                }

                $.each(value.choices, function(key, val) {
                    if (!val.answer_image) {
                        $('#quizze' + value.quizze.id).append(
                            '<div onclick="answerClicked(this);" id="' + val.id + '" class="w-full bg-white h-auto flx flex-col m-2 group shadow-lg hover:shadow-md hover:shadow-slate-800 drop-shadow-xl shadow-slate-800 rounded-lg">' +
                            '<div class="p-2 flex-1 flex flex-col align-middle place-items-center ">' +
                            '<div class="text-xl">' + val.answer + '</div>' +
                            '</div>' +
                            '</div>'
                        );
                    } else {
                        let ansImg = 'src=' + asset_url + '/' + val.answer_image;
                        $('#quizze' + value.quizze.id).append(
                            '<div onclick="answerClicked(this);" id="' + val.id + '" class="w-full md:w-[100%] lg:w-48 h-72 bg-white h-auto flx flex-col m-2 mx-auto rounded-3xl group shadow-lg hover:shadow-md hover:shadow-slate-800 drop-shadow-xl shadow-slate-800">' +
                            '<div class="p-2 flex-1 flex flex-col align-middle place-items-center ">' +
                            '<figure><img ' + ansImg + ' class="object-fill h-56 w-full rounded-lg"/></figure>' +
                            '<div class="text-xl">' + val.answer + '</div>' +
                            '</div>' +
                            '</div>'
                        );
                    }

                });
            });
        }
    })
</script>
@endsection
