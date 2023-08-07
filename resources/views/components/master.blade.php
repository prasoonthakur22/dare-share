    <!-- Basic Page Needs -->
    <meta charset="utf-8">

    <!-- Metas -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name="author" content="Anurag Deep | https://anuragdeep.com">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="asd" content="{{ csrf_token() }}">

    <title>Play Friendship Quiz - DareShare.in</title>
    <meta name="description" content="Create an Online Friendship Quiz, Send it to your Friends, Let them answer your questions, and see results. Friendship Bond 2022, Love Dare Quiz, Friendship dare quiz 2022.">
    <meta name="keywords" content="Smart,friendship,challenge,Make,quiz,Friendship Dare, Dare 2022, Love Dare 2022" />
    <meta property="og:type" content="website" />
    <meta property="og:site_name" content="DareShare.in" />
    <meta property="og:url" content="https://DareShare.in" />
    <meta property="og:title" content="Play Friendship Quiz - DareShare.in" />
    <meta property="og:description" content="Create an Online Friendship Quiz, Send it to your Friends, Let them answer your questions, and see results. Friendship Bond 2022, Love Dare Quiz, Friendship dare quiz 2022." />
    <meta property="og:image" content="https://DareShare.in/images/logo.png" />
    <meta name="twitter:card" content="photo" />
    <meta property="twitter:url" content="https://DareShare.in" />
    <meta name="twitter:title" content="Play Friendship Quiz - DareShare.in" />
    <meta name="twitter:image" content="https://DareShare.in/images/logo.png" />
    <meta property="twitter:description" content="Create an Online Friendship Quiz, Send it to your Friends, Let them answer your questions, and see results. Friendship Bond 2022, Love Dare Quiz, Friendship dare quiz 2022." />

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('images/logo.png') }}" />

    @stack('css')
    <!-- Main Stylesheet -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-multiselect-widget/2.0.2/jquery.multiselect.css" integrity="sha512-5/ZmFY3G32gOBpmU27viayZuf8M2eCcATMNr76kRTF7DdpKm5UGpehrbbq0wbAZ8AIFuPg19RulkOpJ1jw4LLw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    @stack('scripts')
    <!-- Javascripts -->
    <script src="{{ URL::asset('js/jquery.js') }}"></script>
    <script src="{{ URL::asset('js/app.js') }}"></script>
    <script src="{{ URL::asset('js/menu.js') }}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name=asd]').attr('content')
            }
        });
    </script>
