<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{asset('img/logo.png')}}" rel="icon">
    <link href="{{asset('assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

    <link href="https://fonts.gstatic.com" rel="preconnect">

    <!-- Vendor CSS Files -->
    <link href="{{asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    {{-- <link href="../../../assets/vendor/simple-datatables/style.css" rel="stylesheet"> --}}

    <!-- Template Main CSS File -->
    @if (Request::is('login'))
        <link href="{{asset('assets/css/landingPage.css')}}" rel="stylesheet">
        <title>login | landing page</title>
    @else
        <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
        <title>
            @if (auth()->user()->cekLevel == 'admin')
                admin | {{ $title }}
            @elseif(auth()->user()->cekLevel == 'user')
                user | {{ $title }}
            @endif
        </title>
    @endif

    <!-- =======================================================
    * Template Name: Techie
    * Updated: Mar 10 2023 with Bootstrap v5.2.3
    * Template URL: https://bootstrapmade.com/techie-free-skin-bootstrap-3/
    * Author: BootstrapMade.com
    * License: https://bootstrapmade.com/license/
    ======================================================== -->
    <style>
        /* body{
            background: black;
        } */
        .tolak:checked~label .badge {
            transform: scale(1.2);
            /* border-radius: 50%; */
            transition: .1s;
        }

        .terima:checked~label .badge {
            transform: scale(1.2);
            /* border-radius: 50%; */
            transition: .1s;
        }


        a {
            text-decoration: none;
        }

        .font-poppins {
            font-family: "Poppins", sans-serif;

        }

        .color-primary {
            color: rgb(3, 41, 90);
        }

        .color-black {
            color: black;
        }

        .size-number {
            font-size: 50px;
        }

        /* negatif margin */
        /* .pe-n5 {
            padding-left: -1rem !important;
        } */
        .mt-n1 {
            margin-top: -0.25rem !important;
        }

        .mt-n2 {
            margin-top: -0.5rem !important;
        }

        .mt-n3 {
            margin-top: -0.75rem !important;
        }

        .mt-n4 {
            margin-top: -0.1rem !important;
        }

        .mt-n5 {
            margin-top: -0.5rem !important;
        }

        .mb-n1 {
            margin-top: -0.25rem !important;
        }

        .mb-n2 {
            margin-top: -0.5rem !important;
        }

        .mb-n3 {
            margin-top: -0.75rem !important;
        }

        .mb-n4 {
            margin-top: -0.1rem !important;
        }

        .mb-n5 {
            margin-top: -0.5rem !important;
        }

        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            border-radius: 5px;
            box-shadow: transparent
        }

        ::-webkit-scrollbar-thumb {
            border-radius: 5px;
            background: rgba(48, 48, 192, 0.13);
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
</head>