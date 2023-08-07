@extends('layouts.app')
@section('content')

<div class="mx-auto min-h-[90vh]">

    <div class="p-[1rem] md:p-[5rem] lg:p-[5rem]">
        <div class="bg-transparent  px-4 py-12 sm:mx-6 lg:mx-8">
            <div class="max-w-4xl mx-auto">
                <div class="text-center">
                    <h4 class="text-3xl text-rose-200 font-semibold mt-1 mb-2 text-shadow">Congrats {{ $isExist->name }}! Your quiz link is ready!</h4>
                    <p class="my-6 text-slate-200 text-shadow">Share this quiz with your friends, loved ones and see who gets maximum scores.</p>
                </div>
                <div class="px-10 py-10 glass rounded-3xl group shadow-lg hover:shadow-lg hover:shadow-slate-800 drop-shadow-xl shadow-slate-800">

                    <input id="creator_id" type="text" class="hidden" name="creator_id" value="{{ $isExist->id }}" required autocomplete="creator_id" autofocus>
                    <input id="dare_id" type="text" class="hidden" name="dare_id" value="{{ $dare_id }}" required autocomplete="dare_id" autofocus>

                    <div class="my-8">
                        <div class="text-center">
                            <button class="text-lg sm:text-xl md:text-xl lg:text-xl xl:text-xl 2xl:text-xl rounded-3xl group shadow-lg hover:shadow-md hover:shadow-slate-800 drop-shadow-xl shadow-slate-800 inline-block px-6 py-2.5 text-slate-900 font-medium leading-tight  hover:bg-green-400 focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out w-full bg-gradient-to-r from-pink-500 via-red-500 to-yellow-500 mb-10" onclick="copyToClipboard()">Copy</button>
                        </div>
                        <input placeholder="{{ $share_url }}" id="share_url" type="text" class="form-control rounded-3xl input-md block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-red-600 focus:outline-none mb-10" name="share_url" value="{{ $share_url }}" autocomplete="share_url">

                        <div class="my-5"></div>
                        <div class="addthis_inline_share_toolbox"></div>

                        <div class="text-center">
                            <button onclick="ConfirmDelete()" class="text-md rounded-3xl inline-block px-3 py-2.5 text-slate-900 font-medium leading-tight focus:shadow-lg focus:outline-none focus:ring-0 active:shadow-lg transition duration-150 ease-in-out bg-red-700 mt-10">Delete this Quizze</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    function copyToClipboard() {
        var copyText = document.getElementById("share_url");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        navigator.clipboard.writeText(copyText.value);
        alert("Copied the text: " + copyText.value);
    }

    function ConfirmDelete() {
        var result = confirm("Alert: Are you sure, you want to delete this quizze?");
        if (result) {
            let creator_id = $('#creator_id').val()
            let dare_id = $('#dare_id').val()

            $.ajax({
                type: 'POST',
                url: "{{ url('/creator_details/delete/alldata') }}",
                data: {
                    _token: '{{ csrf_token() }}',
                    creator_id: creator_id,
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
    }
</script>

@endsection
