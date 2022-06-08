@extends('layouts.master')
@section('content')
    <section class="row flexbox-container">
        <div class="col-xl-8 col-10 d-flex justify-content-center">
            <div class="card bg-authentication rounded-0 mb-0">
                <div class="row m-0">
                    <div class="col-lg-6 d-lg-block d-none text-center align-self-center pl-0 pr-3 py-0">
                        <img src="../../../app-assets/images/pages/register.jpg" alt="branding logo">
                    </div>
                    <div class="col-lg-6 col-12 p-0">
                        <div class="card rounded-0 mb-0 p-2">
                            <div class="card-header pt-50 pb-1">
                                <div class="card-title">
                                    <h4 class="mb-0">Create Account</h4>
                                </div>
                            </div>
                            <p class="px-2">Fill the below form to create a new account.</p>
                            <div class="card-content">
                                <div class="card-body pt-0">
                                    <form role="form" method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-label-group">
                                            <input type="text" id="inputName" name="name" value="{{ old('name') }}" class="form-control" placeholder="Name" required>
                                            <label for="inputName">Name</label>
                                            @if ($errors->has('name'))
                                                <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    <p class="mb-0">
                                                        {{ $errors->first('name') }}
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-label-group">
                                            <input type="email" id="inputEmail" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>
                                            <label for="inputEmail">Email</label>
                                            @if ($errors->has('email'))
                                                <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    <p class="mb-0">
                                                        {{ $errors->first('email') }}
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-label-group">
                                            <input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required>
                                            <label for="inputPassword">Password</label>
                                            @if ($errors->has('password'))
                                                <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    <p class="mb-0">
                                                        {{ $errors->first('password') }}
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-label-group">
                                            <input type="password" id="inputConfPassword" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                                            <label for="inputConfPassword">Confirm Password</label>
                                            @if ($errors->has('password_confirmation'))
                                                <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                    <p class="mb-0">
                                                        {{ $errors->first('password_confirmation') }}
                                                    </p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <fieldset class="checkbox">
                                                    <div class="vs-checkbox-con vs-checkbox-primary">
                                                        <input type="checkbox" checked>
                                                        <span class="vs-checkbox">
                                                                        <span class="vs-checkbox--check">
                                                                            <i class="vs-icon feather icon-check"></i>
                                                                        </span>
                                                                    </span>
                                                        <span class=""> I accept the terms & conditions.</span>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <a href="{{route('login')}}" class="btn btn-outline-primary float-left btn-inline mb-50">Login</a>
                                        <button type="submit" class="btn btn-primary float-right btn-inline mb-50">Register</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
