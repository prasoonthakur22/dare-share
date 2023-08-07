@extends('layouts.app')
@section('content')

<div class="mx-auto min-h-[90vh]">

    <div class="p-[1rem] md:p-[5rem] lg:p-[5rem]">
        <div class="bg-transparent  px-4 py-12 sm:mx-6 lg:mx-8">
            <div class="max-w-4xl mx-auto">
                <div class="text-center">
                    <h4 id="dare" class="text-3xl text-slate-900 font-semibold mt-1 mb-12 pb-1"></h4>
                </div>

                <input id="dare_id" type="text" class="hidden" name="dare_id" value="{{ $dare->id }}" required autocomplete="dare_id" autofocus>
                <input id="creator_id" type="text" class="hidden" name="creator_id" value="{{ $isExist->id }}" required autocomplete="creator_id" autofocus>

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

<script>
    // #####
    var lastQuizzeID;
    var answerClicked;
    var answeredData = [];
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

        console.log(questionCount)
        answerClicked = function(element) {

            if (questionCount <= 10) {
                var quizee_id = parseInt(element.parentNode.id.replace(/^\D+/g, ''));
                var creator_id = $('#creator_id').val()
                var choice_id = element.id;
                var dare_id = $('#dare_id').val()

                data = {
                    'creator_id': creator_id,
                    'dare_id': dare_id,
                    'quizze_id': quizee_id,
                    'choice_id': choice_id
                };

                var isInArray = answeredData.indexOf(data) !== -1;
                answeredData.push(data)

                $("#" + choice_id + "").addClass('bg-green-400')
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
                    }, 100);
                } else {
                    $.ajax({
                        type: 'POST',
                        url: "/creator_details/" + dare_id,
                        data: {
                            _token: '{{ csrf_token() }}',
                            answeredData: answeredData
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

                    // console.log('10 Done')
                    // console.log(answeredData)

                    setTimeout(function() {
                        $("#quizzeBox" + quizee_id + "").addClass('hide')
                        $("#quizzeBox" + quizee_id + "").removeClass('show')
                    }, 100);


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
                // console.log(cIndex)
                // cIndex = (cIndex + 1);

                if (cIndex >= unansweredQuizzes.length) {
                    cIndex = 0
                }
                yield(unansweredQuizzes[cIndex]);
            }
        }
        const quizzeIterator = yieldQuizze();

        var nextQID;
        skipClicked = function(element) {
            var quizee_id = parseInt(element.id.replace(/^\D+/g, ''));
            nextQID = quizee_id;
            // console.log('_____________________')
            // console.log('skipped Q = ' + nextQID)
            $("#quizzeBox" + nextQID + "").addClass('hide')
            $("#quizzeBox" + nextQID + "").removeClass('show')
            if (unansweredQuizzes.includes(nextQID)) {
                nextQID = yieldUnansweredQuizze(nextQID).next().value;
                // console.log('current Q = ' + nextQID)
            }
            $("#quizzeBox" + nextQID + "").addClass('show')
            $("#quizzeBox" + nextQID + "").removeClass('hide')
        }

        function* yieldUnansweredQuizze(ID = 0) {
            while (true) {
                console.log('lastQuizzeID ' + lastQuizzeID)
                let cIndex = unansweredQuizzes.indexOf(ID);
                // console.log('unansweredQuizzes[cIndex] ' + unansweredQuizzes[cIndex])
                if (unansweredQuizzes[cIndex] == lastQuizzeID) {
                    console.log('.../restart2')
                    cIndex = 0;
                }
                // console.log(unansweredQuizzes)
                cIndex = (cIndex + 1);
                yield(unansweredQuizzes[cIndex]);
            }
        }
        // const unansweredQuizzeIterator = yieldUnansweredQuizze();


        if (true) {
            let dare_id = $('#dare_id').val()
            $.ajax({
                type: 'GET',
                url: "/creator_details/" + dare_id,
                data: {
                    _token: '{{ csrf_token() }}',
                    dare_id: dare_id,
                },
                dataType: 'json',
                encode: true,
                beforeSend: function() {},
                success: function(result) {},
                error: function(result) {
                    $('#message').html('Some error')
                },
                complete: function() {},
            }).done(function(result) {
                if (result.success == true) {
                    // console.log(result);
                    $('#dare').html(result.data.dare.title)
                    $('#quizze').html(result.data.quizze.question)

                    let i = 1;
                    lastQuizzeID = result.data.quizze.slice(-1)[0].id
                    $.each(result.data.quizze, function(key, quizze) {

                        unansweredQuizzes[key] = quizze.id;
                        if (i == 1) {
                            nextQID = quizze.id;
                            i++;
                            $('#quizzes').append(
                                '<div id="quizzeBox' + quizze.id + '" class="show">' +
                                '<div class="text-center  mb-5">' +
                                '<button onclick="skipClicked(this);" id="skipId' + quizze.id + '" class="btn">Skip Question</button>' +
                                '</div>' +
                                '<div class="px-5 py-10 glass mx-auto rounded-3xl group shadow-lg hover:shadow-lg hover:shadow-slate-800 drop-shadow-xl shadow-slate-800 border-solid border-rose-400 border-2 hover:border-solid hover:border-rose-400 hover:border-2">' +
                                '<div class="text-center pt-1 mb-12 mt-10 pb-1">' +
                                '<div class="text-center">' +
                                '<p class="text-3xl text-slate-900 font-semibold mt-1 mb-5 pb-1">' + quizze.question + '</p>' +
                                '</div>' +
                                '<div id="quizze' + quizze.id + '" class="flex flex-wrap items-center">' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>'
                            )
                        } else {
                            $('#quizzes').append(
                                '<div id="quizzeBox' + quizze.id + '" class="hide">' +
                                '<div class="text-center  mb-5">' +
                                '<button onclick="skipClicked(this);" id="skipId' + quizze.id + '" class="btn">Skip Question</button>' +
                                '</div>' +
                                '<div  class="px-5 py-10 glass mx-auto rounded-3xl group shadow-lg hover:shadow-lg hover:shadow-slate-800 drop-shadow-xl shadow-slate-800 border-solid border-rose-400 border-2 hover:border-solid hover:border-rose-400 hover:border-2">' +
                                '<div class="text-center pt-1 mb-12 mt-10 pb-1">' +
                                '<div class="text-center">' +
                                '<div class="flex flex-wrap items-center text-3xl text-slate-900 font-semibold mt-1 mb-5 pb-1">' + quizze.question + '</div>' +
                                '</div>' +
                                '<div id="quizze' + quizze.id + '" class="flex flex-wrap items-center">' +
                                '</div>' +
                                '</div>' +
                                '</div>' +
                                '</div>'
                            )
                        }

                        $.each(quizze.choices, function(key, val) {
                            if (!val.answer_image) {
                                $('#quizze' + quizze.id).append(
                                    '<div onclick="answerClicked(this);" id="' + val.id + '" class="w-full bg-white hover:bg-rose-400 h-auto flx flex-col m-2 mx-auto rounded-3xl group shadow-lg hover:shadow-md hover:shadow-slate-800 drop-shadow-xl shadow-slate-800">' +
                                    '<div class="p-2 flex-1 flex flex-col align-middle place-items-center ">' +
                                    '<div class="text-xl">' + val.answer + '</div>' +
                                    '</div>' +
                                    '</div>'
                                );
                            } else {
                                let ansImg = 'src=' + asset_url + '/' + val.answer_image;
                                $('#quizze' + quizze.id).append(
                                    '<div onclick="answerClicked(this);" id="' + val.id + '" class="w-full bg-white hover:bg-rose-400 md:w-[100%] lg:w-48 h-72  flx flex-col m-2 mx-auto rounded-3xl group shadow-lg hover:shadow-md hover:shadow-slate-800 drop-shadow-xl shadow-slate-800">' +
                                    '<div class="p-2 flex-1 flex flex-col align-middle items-center ">' +
                                    '<figure><img ' + ansImg + ' class="object-fill h-56 w-full rounded-lg"/></figure>' +
                                    '<div class="text-xl">' + val.answer + '</div>' +
                                    '</div>' +
                                    '</div>'
                                );
                            }
                        });
                    });

                } else {
                    $('#message').html(result.message)
                }
            })
        }
    })
</script>

@endsection
