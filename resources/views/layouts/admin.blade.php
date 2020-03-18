<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include('include.admin.head')
        <title>Full Funnel - @yield('title')</title>
    </head>
    <body id="page-top">
        <div id="wrapper">
            @include('include.admin.sidebar')
            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column"> 
                <!-- Main Content -->
                <div id="content"> 
                    @include('include.admin.header') 
                    <!-- Begin Page Content -->
                    <div class="container-fluid marg-top-20">
                        @yield('content')
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- End of Main Content -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        @include('include.admin.footer')
    </body>
</html>
