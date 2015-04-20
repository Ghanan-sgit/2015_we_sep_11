@extends('masterpages.master_dashboard')

@section('css_links')

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

@section('main content')


            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Update User Account <small>Details.</small></h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa fa-wrench"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="#">Config option 1</a>
                            </li>
                            <li><a href="#">Config option 2</a>
                            </li>
                        </ul>
                        <a class="close-link">
                            <i class="fa fa-times"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">
                    <div id='result'></div>
                    <form class="form-horizontal" method ="post" action="updateUser">
                        <div class="form-group"><label class="col-sm-2 control-label">Search(ID)</label>


                            <div class="col-sm-10">
                                <select class="form-control m-b" name="searchdropdown" id="searchdropdown">


                                    <?php
                                    #
                                    foreach($categories1 as $category=>$value)
                                    {
                                        $category = htmlspecialchars($category);
                                        echo '<option value="'. $category .'">'. $value .'</option>';
                                    }
                                    ?>

                                </select>


                            </div>

                        </div>

                            <div class="hr-line-dashed"></div>

                        <div class="form-group"><label class="col-sm-2 control-label">Email</label>

                            <div class="col-sm-10"> <input id="email" name="email" type="email" placeholder="Enter Email" class="form-control required" required="" aria-required="true" aria-invalid="true"></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">User Name</label>

                            <div class="col-sm-10"><input id="userName" name="userName" placeholder="Enter User Name" type="text" class="form-control required"/></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Password</label>

                            <div class="col-sm-10"><input id="password" type="password" name="password" placeholder="Enter Password" type="text" class="form-control required"/></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Confirm Password</label>

                            <div class="col-sm-10"><input id="confirm" type="password" name="confirm" type="password" placeholder="Enter Confirm Password" class="form-control required"/></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Registed ID</label>

                            <div class="col-sm-10"><input id="name" name="registereID" placeholder="Enter Registered ID" type="text" class="form-control required"/></div>
                        </div>

                        <div class="form-group"><label class="col-sm-2 control-label">Full Name</label>

                            <div class="col-sm-10"><input id="fullname" name="fullname" placeholder="Enter Full Name" type="text" class="form-control required"/></div>
                        </div>



                        <div class="form-group"><label class="col-sm-2 control-label">Position</label>

                            <div class="col-sm-10"><select class="form-control m-b" name="account">
                                    <option>RPC</option>
                                    <option>Admin</option>
                                    <option>Student</option>
                                    <option>examiner</option>
                                </select>


                            </div>
                        </div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group">
                            <div class="col-sm-4 col-sm-offset-2">

                                <button class="btn btn-primary" type="submit">Save changes</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>



@endsection

@section('javascripts')


    <script>
      /*  $(document).ready( function() {
            $('select[name="searchdropdown"]').change(function() {

        });*/
      $('#searchdropdown').on('change', function() {
          var optionSelected = $(this).find("option:selected");
          var eid = optionSelected.val();
          alert(eid);

          $.ajax({
              type: "post",
              url: "test",
              data: {
                  id: eid
              }
              // data: $("#examId").val()
          })
                  .done(function() {
                      alert('im here');
                  });
      });
    </script>

    <?php if(isset($rows)){
        $i=1;
        foreach ($rows as $row) {
            print "
      <tr>
        <td>".$i."</td>
        <td>".$row->name." ".$row->email."</td>

      </tr>
    ";
            $i++;
        }
    }?>

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