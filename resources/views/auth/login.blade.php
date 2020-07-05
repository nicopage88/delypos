@extends('layouts.app')

@section('auth')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Session::has('succes'))
                <div class="alert alert-warning alert-dismissible fade show" role="alert"><strong>Genial!</strong> Ya distre el primer paso, ahora puedes ingresar.
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                </div>
            @endif
            <form method="POST" action="{{ route('login') }}" autocomplete="off">
                @csrf
                <div class="card-group">
                    <div class="card p-4">
                        
                        <div class="card-body">
                            <h1>Iniciar Sesión</h1>
                            <p class="text-muted"></p>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend"><span class="input-group-text">
                                    <svg class="c-icon">
                                    <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-user">
                                        <svg id="cil-lock-locked" viewBox="0 0 24 24">
                                            <title>lock-locked</title><path d="M18 9.375v-2.625c0-3.314-2.686-6-6-6s-6 2.686-6 6v0 2.625h-1.875v6c0 4.342 3.533 7.875 7.875 7.875s7.875-3.533 7.875-7.875v-6zM7.5 6.75c0-2.485 2.015-4.5 4.5-4.5s4.5 2.015 4.5 4.5v0 2.625h-9zM18.375 15.375c0 3.515-2.86 6.375-6.375 6.375s-6.375-2.86-6.375-6.375v-4.5h12.75z"></path>
                                            </svg>
                                    </use>
                                    </svg></span>
                                </div>
                                <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" type="text" placeholder="Correo Electrónico" value="{{ old('email') }}" required autofocus autocomplete="off">
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-group mb-4">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <svg class="c-icon">
                                        <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-lock-locked">
                                            <svg id="cil-user" viewBox="0 0 24 24">
                                                <title>user</title><path d="M19.294 16.109l-3.414-2.219 1.287-2.359c0.288-0.519 0.457-1.137 0.458-1.796v-3.735c0-2.9-2.351-5.25-5.25-5.25s-5.25 2.351-5.25 5.25v0 3.735c0.001 0.658 0.17 1.277 0.468 1.815l-0.010-0.019 1.287 2.359-3.414 2.219c-1.033 0.676-1.706 1.828-1.706 3.137 0 0.002 0 0.005 0 0.007v-0 3.997h17.25v-3.997c0-0.002 0-0.005 0-0.007 0-1.309-0.673-2.461-1.692-3.128l-0.014-0.009zM19.5 21.75h-14.25v-2.497c0-0.001 0-0.003 0-0.004 0-0.785 0.404-1.477 1.015-1.877l0.009-0.005 4.578-2.976-1.952-3.578c-0.173-0.311-0.274-0.682-0.275-1.077v-3.735c0-2.071 1.679-3.75 3.75-3.75s3.75 1.679 3.75 3.75v0 3.735c-0 0.395-0.102 0.766-0.281 1.089l0.006-0.012-1.952 3.579 4.578 2.976c0.62 0.406 1.024 1.097 1.024 1.882 0 0.001 0 0.003 0 0.004v-0z"></path>
                                                </svg>
                                        </use>
                                        </svg>
                                    </span>
                                </div>
                                <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required autocomplete="off">
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-primary px-4" type="submit">Ingresar</button>
                                </div>
                              
                            </div>
                        </div>
                    </div>
                    <div class="card text-white py-5 d-md-down-none" style="width:44%;background:#ECF0F1 !important">
                        <div class="card-body text-center">
                            <div>
                                <img src="{{asset('img/logo2.png')}}" style="width:100%">
                                <span class="text-center text-muted"  style="color: #191919 !important">Bienvenidos</span>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
