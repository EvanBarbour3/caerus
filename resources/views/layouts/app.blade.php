@extends('layouts.master')

@section('page')
<div id="app">
    <div class="container">
    @include('layouts.navigation')
    </div>

    @yield('content')
    <footer class="footer">
        <div class="container">
            <div class="content has-text-centered">
                <p>
                    <strong>Bulma</strong> by <a href="http://jgthms.com">Jeremy Thomas</a>. The source code is licensed
                    <a href="http://opensource.org/licenses/mit-license.php">MIT</a>. The website content
                    is licensed <a href="http://creativecommons.org/licenses/by-nc-sa/4.0/">CC ANS 4.0</a>.
                </p>
                <p>
                    <a class="icon" href="https://github.com/jgthms/bulma">
                        <i class="fa fa-github"></i>
                    </a>
                </p>
            </div>
        </div>
    </footer>
</div>
@endsection

@section('scripts')
<!-- Scripts -->
@yield('scripts')
<script src="{{ asset('js/app.js') }}"></script>
@endsection
