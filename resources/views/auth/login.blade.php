@extends('layouts.app')

@section('content')

<style>
/*EXTRA*/
body {
    background-color: #212529;
}
</style>

<link href="{{asset('css/login.css')}}" rel="stylesheet">    
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-center">
            <a href="#" class="active" id="login-form-link"> Inicia Sesion</a>
                ó <a href="#" id="register-form-link">Registrate</a></div>

                <div class="card-body">
                    <form id="login-form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                            <div class="form-group">
                                <label for="email">Correo electronico</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}"
                                aria-describedby="emailHelp" placeholder="ejemplo@correo.com" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif                        
                            </div>


                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif                        
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Recuérdame
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                Iniciar Sesión
                            </button>                            
                            <a class="btn btn-link form-control forgot" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>                            
                        </div>
                    </form>
                    <!---->
                    <form id="register-form" method="POST" action="{{ route('register') }}" style="display:none;">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">

                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}"
                                aria-describedby="nameHelp" placeholder="" required autofocus>
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif                        
                            </div>

                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <div class="form-group">
                                <label for="email">Correo electronico</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}"
                                aria-describedby="emailHelp" placeholder="ejemplo@correo.com" required>
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <div class="form-group">
                                <label for="password">Contraseña</label>
                                <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}"
                                aria-describedby="passwordHelp" placeholder="" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm">Confirmar contraseña</label>
                            <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="password-confirm" name="password_confirmation" value="{{old('password')}}"
                            aria-describedby="passwordHelp" placeholder="" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                ¡Registrate!
                            </button>
                        </div>
                    </form>                    
                    <!---->
                </div>
                <div class="card-footer text-center">
                    <a class="btn btn-facebook" href="redirect/facebook">
                      <i class="fa fa-facebook"></i>
                        {{--Facebook--}}
                    </a>
                    <a class="btn btn-twitter" href="redirect/twitter">
                      <i class="fa fa-twitter"></i>
                        {{--Twitter--}}
                    </a>
                    <a class="btn btn-google" href="redirect/google">
                      <i class="fa fa-google-plus"></i>
                        {{--Google--}}
                    </a>     
                    <a class="btn btn-github" href="redirect/github">
                      <i class="fa fa-github"></i>
                        {{--Github--}}
                    </a>        
                    <a class="btn btn-linkedin" href="redirect/linkedin">
                      <i class="fa fa-linkedin"></i>
                        {{--Linkedin--}}
                    </a>                                  
                </div>                
            </div>
        </div>
    </div>
</div>
@endsection


<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script>

$(function() {

$('#login-form-link').click(function(e) {
    $("#login-form").delay(100).fadeIn(100);
     $("#register-form").fadeOut(100);
    $('#register-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
});
$('#register-form-link').click(function(e) {
    $("#register-form").delay(100).fadeIn(100);
     $("#login-form").fadeOut(100);
    $('#login-form-link').removeClass('active');
    $(this).addClass('active');
    e.preventDefault();
});

});




</script>    