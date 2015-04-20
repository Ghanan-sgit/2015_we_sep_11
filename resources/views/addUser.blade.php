@extends('masterpages.master_dashboard')

@section('cssLinks')

    <link href="{{asset('public_assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet">

    <!-- Toastr style -->
    <link href="{{asset('public_assets/css/plugins/toastr/toastr.min.css')}}" rel="stylesheet">

    <!-- Gritter -->
    <link href="{{asset('public_assets/js/plugins/gritter/jquery.gritter.css')}}" rel="stylesheet">


    <link href="{{ asset('public_assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/plugins/steps/jquery.steps.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('public_assets/css/style.css') }}" rel="stylesheet">


@endsection

@section('content')

    @if ( Session::has('flash_message') )

        <div class="alert {{ Session::get('flash_type') }}">
            <h3>{{ Session::get('flash_message') }}</h3>
        </div>

    @endif

    <div class="ibox">
        <div class="ibox-title">
            <h5>User Accounts Management</h5>
            <div class="ibox-tools">
                <a class="collapse-link">
                    <i class="fa fa-chevron-up"></i>
                </a>
                <!--a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench"></i>
                </a-->
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#">Config option 1</a>
                    </li>
                    <li><a href="#">Config option 2</a>
                    </li>
                </ul>
                <!--a class="close-link">
                    <i class="fa fa-times"></i>
                </a-->
            </div>
        </div>
        <div class="ibox-content">
            <h2>
                Add New User Account
            </h2>
            <p>
                Add User Account details.
            </p>



            <form id="form" method ="post" action="addUser" class="wizard-big">
                <h1>Account</h1>
                <fieldset>
                    <h2>Account Information</h2>
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="form-group">
                                <label>Username *</label>

                                <input id="userName" name="userName" placeholder="User Name" type="text" class="form-control required"/>
                            </div>
                            <div class="form-group">
                                <label>Password *</label>
                                <input id="password" type="password" name="password" placeholder="Password" type="text" class="form-control required"/>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password *</label>
                                <input id="confirm" type="password" name="confirm" type="password" placeholder="Re-Password" class="form-control required"/>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="text-center">
                                <div style="margin-top: 20px">
                                    <i class="fa fa-sign-in" style="font-size: 180px;color: #e5e5e5 "></i>
                                </div>
                            </div>
                        </div>
                    </div>

                </fieldset>
                <h1>Profile</h1>
                <fieldset>
                    <h2>Profile Information</h2>
                    <div class="row">
                        <div class="col-lg-6">

                            <label>Registered ID *</label>
                            <div class="form-group">
                                <input id="name" name="registereID" placeholder="Registered ID" type="text" class="form-control required"/>
                            </div>
                            <div class="form-group">
                                <label>FUll Name *</label>
                                <input id="fullname" name="fullname" placeholder="Full Name" type="text" class="form-control required"/>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email *</label>
                                <input id="email" name="email" type="email" placeholder="Enter email" class="form-control required" required="" aria-required="true" aria-invalid="true">

                            </div>
                            <div class="form-group">
                                <label>Posstion *</label>
                                <!--select id="position" name="position" type="text" class="form-control"-->
                                <!-- Brand and toggle get grouped for better mobile display -->

                                <select id="position" name="position" class="form-control">
                                    <option>RPC</option>
                                    <option>Admin</option>
                                    <option>Student</option>
                                    <option>examiner</option>
                                </select>

                                <!---->
                            </div>
                        </div>
                    </div>
                </fieldset>

                <h1>Warning</h1>
                <fieldset>
                    <div class="text-center" style="margin-top: 120px">
                        <h2>You did it Man :-)</h2>
                    </div>
                </fieldset>

                <h1>Finish</h1>
                <fieldset>
                    <h2>Terms and Conditions</h2>
                    <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms">I agree with the Terms and Conditions.</label>
                </fieldset>
            </form>
        </div>
    </div>
    </div>


@endsection

@section('ValidationJavaScript')



    <!-- bootbox code -->
    <script src="{{ asset('public_assets/css/style.css') }}"></script>
    <script>
        $(document).ready(function(){
            $("#wizard").steps();
            $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex)
                {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex)
                    {
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18)
                    {
                        return false;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex)
                    {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex)
                {
                    // Suppress (skip) "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18)
                    {
                        $(this).steps("next");
                    }

                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3)
                    {
                        $(this).steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex)
                {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex)
                {
                    var form = $(this);
                    form.submit();
                    // Submit form input

                    //alert(form.serialize());

                    bootbox.alert("Hello world!", function() {

                    });
                }
            }).validate({
                errorPlacement: function (error, element)
                {
                    element.before(error);
                },
                rules: {
                    confirm: {
                        equalTo: "#password"
                    }
                }
            });
        });
    </script>





@endsection