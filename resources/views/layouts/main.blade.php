<!DOCTYPE html>
<html lang="pt-br">

    @include('components.head')

    <body>

        @include('components.header')

        <div class="container pt-4 pb-4">
            @yield('content')
        </div>

        <script src="{{asset('assets/js/vendor.min.js')}}"></script>
        <script src="{{asset('assets/js/scripts.min.js')}}"></script>


    </body>

</html>
