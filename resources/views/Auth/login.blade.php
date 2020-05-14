<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Swoole Socket Assignment</title>

        <!-- css -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

        <!-- js -->
        <script src="{{ asset('js/jquery-3.5.0.min.js') }}"></script>
        <script src="{{ asset('js/jquery.validate.min.js') }}"></script>

        <!-- script -->
        <script>

            // when document is ready
            $(document).ready(function () {

                // On form submit validate
                $('form[id="UserForm"]').validate({
                    rules: {
                        username: {
                            required: true,
                            minlength: 2,
                        },
                        email: {
                            required: true,
                            email :true
                        },
                        phone: {
                            required: true,
                            minlength: 10,
                            maxlength: 13,
                        },
                        password: {
                            required: true,
                            minlength: 6,
                        },
                        reenter_password: {
                            equalTo: "#InputPassword"
                        },
                        state: {
                            required: true,
                        },
                        city: {
                            required: true,
                        }

                    },
                    messages: {
                        username: 'This field is required'
                    },
                    submitHandler: function (form) {

                    }
                });

            });

        </script>
    </head>
    <body>
        <div class="jumbotron">
            <h1><a href="/">Login Example</a></h1>
            <p id="welcome_message"></p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form method="post" id="UserForm" onsubmit="">
                    {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-12">
                                <h2>Login User</h2>
                                <!-- breadcrum 
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/users-list">List</a></li>
                                        <li class="breadcrumb-item active">Add User</li>
                                    </ol>
                                </nav>-->
                                <!-- messages -->
                                <span id="success_message" class="alert-success"></span>
                                <input type="hidden" name="form_error"/>
                                <span class="alert-danger"></span>
                                <!-- Input -->
                                <div class="row">
                                    <div class="col-sm col-6">
                                        <div class="form-group">
                                            <label for="InputName">Username <span class="text-danger">*</span></label>
                                            <input type="text" name="username" class="form-control" id="InputName" placeholder="Name">
                                            <span class="alert-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputPassword">Password <span class="text-danger">*</span></label>
                                            <input type="text" name="password"  class="form-control" id="InputPassword" placeholder="Password">
                                            <span class="alert-danger"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                <div class="col-sm col-6">
                                    <!-- onClick="return validate(this.form)" -->
                                    <button type="submit" class="btn btn-primary" >Submit</button>
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="page-footer font-small blue">

            <!-- Copyright -->
            <div class="footer-copyright text-center py-3">@Swoole Example</div>
            <!-- Copyright -->

        </footer>
        <!-- Footer -->

    </body>
</html>
