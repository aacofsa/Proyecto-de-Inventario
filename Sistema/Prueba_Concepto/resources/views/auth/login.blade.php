@extends('layouts.app')

@section('content')

<style>
    .elementos-alineados {
        display: flex;
        justify-content: space-between;
    }
</style>

    <br>
    <br>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div style="text-align: center; padding: 20px"><h2 style="margin: 0"><strong>{{ __('Login title') }}</strong></h2></div>
                <hr style="margin: 0px 16px 10px 16px; text-align: center">
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="results">
                            @if(Session::get('fail'))
                                <div class="alert alert-danger">
                                    {{ Session::get('fail') }}
                                </div>
                            @endif
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-12 pb-3">
                                <label class="form-label" for="Email">{{ __('E-Mail Address') }}</label>
                                <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" placeholder="Ingresa tu correo electrónico" id="Email" autocomplete="email">
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="col-md-12 pb-3">
                                <label class="form-label" for="Clave">{{ __('Password') }}</label>
                                <input class="form-control @error('clave') is-invalid @enderror" type="password" autocomplete="false" spellcheck="false" name="clave" value="{{ old('clave') }}" placeholder="Ingresa tu clave" id="Clave" autocomplete="current-password">
                                @error('clave')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="elementos-alineados" style="margin-top: 6px">
                            <div style="align-self: center">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection