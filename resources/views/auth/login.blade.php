@extends('layout.guest')

@section('content')
    <section class="hero is-fullheight">
        <div class="hero-body">
            <div class="container">
                <div class="container">
                    <div class="columns is-mobile">
                        <div class="column is-half is-offset-one-quarter">
                            <h1 class="title has-text-centered">Caerus</h1>
                        </div>
                    </div>
                    <div class="columns is-mobile">
                        <div class="column is-half is-offset-one-quarter">
                            <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                                {{ csrf_field() }}
                                <div class="field">
                                    <p class="control has-icons-left">
                                        <span class="icon is-small is-left">
                                          <i class="fa fa-envelope"></i>
                                        </span>
                                        <input class="input" type="email" name="email" placeholder="Email" autofocus>
                                    </p>
                                </div>
                                <div class="field">
                                    <p class="control has-icons-left">
                                        <input class="input" type="password" name="password" placeholder="Password">
                                        <span class="icon is-small is-left">
                                            <i class="fa fa-lock"></i>
                                        </span>
                                    </p>
                                </div>
                                <div class="field">
                                    <p class="control">
                                        <button type="submit" class="button is-success is-fullwidth">
                                            Login
                                        </button>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
