@section('container')
    <!doctype html>
    <html lang="en">

    {{-- tag head --}}
    @include('user.parts.head')

    <body>
        @include('user.parts.navbar')
        @include('user.parts.sidebar')
        <main id="main" class="main">
            <div class="pagetitle">
                <h1 class="mb-2 fs-2">Welcome to Dashboard </h1>
                <nav class="shadow-sm bg-body rounded pt-2 px-2 " style="width: 98%;">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item fs-5"><a href="/dashboardUser">Home</a></li>
                        @yield('pagetitle')
                    </ol>
                </nav>
            </div>
            @yield('container')
        </main>

        <!-- ======= Footer ======= -->
        <footer id="footer" class="footer bg-dark" style="height: 100px;">
            <div class="copyright">

            </div>
            <div class="credits">

            </div>
        </footer>
        <!-- End Footer -->

        {{--  tag script --}}
        @include('user.parts.script')

    </body>





    </html>