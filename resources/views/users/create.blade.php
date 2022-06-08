@extends('layouts.master')
@section('content')
    @push('css')
        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/semi-dark-layout.css">

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/colors/palette-gradient.css">
        <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/wizard.css">
        <!-- END: Page CSS-->
    @endpush
    <section id="icon-tabs">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
{{--                        <h4 class="card-title">Form wizard with icon tabs</h4>--}}
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success alert-dismissible mb-2" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                    <p class="mb-0">
                                        {{ session('status') }}
                                    </p>
                                </div>
                            @endif
                            <form method="POST" action="{{route('users.create')}}" id="register-form" class="icons-tab-steps wizard-circle">
                                @csrf
                                <!-- Step 1 -->
                                <h6><i class="step-icon feather icon-home"></i> {{__('Account Details')}}</h6>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="firstName11">{{__('Name')}}</label>
                                                <input type="text" class="form-control" name="name" placeholder="Name" required>
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
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="email">{{__('Email')}}</label>
                                                <input type="email" class="form-control" name="email" placeholder="Email" required>
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
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('Password')}}</label>
                                                <input type="password" name="password" placeholder="Password" class="form-control" required>
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
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>{{__('Confirm Password')}}</label>
                                                <input type="password" name="password_confirmation" placeholder="Confirm Password" class="form-control" required>
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
                                        </div>
                                    </div>
                                </fieldset>
                                <!-- Step 2 -->
                                <h6><i class="step-icon feather icon-briefcase"></i>{{__('Personal Info')}}</h6>
                                <fieldset>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="proposalTitle11">Phone</label>
                                                <input name="phone_number" placeholder="Phone Number" type="text" class="form-control">
                                                @if ($errors->has('phone_number'))
                                                    <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        <p class="mb-0">
                                                            {{ $errors->first('phone_number') }}
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="jobtitle11">Passport</label>
                                                <input name="passport_number" placeholder="Passport Number" type="text" class="form-control">
                                                @if ($errors->has('passport_number'))
                                                    <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        <p class="mb-0">
                                                            {{ $errors->first('passport_number') }}
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label for="proposalTitle11">Birth Day</label>
                                                <input name="birth" placeholder="20-04-1997" type="text" aria-haspopup="true" aria-readonly="false" class="form-control pickadate-months-year">
                                                @if ($errors->has('birth'))
                                                    <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        <p class="mb-0">
                                                            {{ $errors->first('birth') }}
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="shortDescription11">Address:</label>
                                                <textarea name="address" rows="5" class="form-control"></textarea>
                                                @if ($errors->has('address'))
                                                    <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                        <p class="mb-0">
                                                            {{ $errors->first('address') }}
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@push('js')
    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/extensions/jquery.steps.min.js"></script>
    <script src="../../../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>


    <!-- END: Page Vendor JS-->
    <script >
        // Wizard tabs with icons setup
        $(".icons-tab-steps").steps({
            headerTag: "h6",
            bodyTag: "fieldset",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: 'Submit'
            },
            onFinished: function (event, currentIndex) {
                $( "#register-form").submit();
            }
        });
    </script>
@endpush
@endsection
