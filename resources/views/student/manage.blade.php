<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Example</title>

        <!-- css -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

        <!-- js -->
        <script src="{{ asset('js/jquery-3.5.0.min.js') }}"></script>
        <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

        <!-- script -->
        <script>

            // Fill classes dropdown list
            function GetClassDl() {
                $.ajax({student
                    type: "GET",
                    url: "/get-classes",
                    data: '',
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(data)
                            {
                                $.each(data, function (){
                                    $(".class_id").append($("<option     />").val(this.id).text(this.roman_name));
                                });
                            },
                    failure: function () {
                        alert("Failed!");
                    }
                });
            }

            // Fill Academic year dropdown list
            function GetAcademicYearDl() {
                $.ajax({
                    type: "GET",
                    url: "/get-academic-years",
                    data: '',
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(data)
                            {
                                $.each(data, function (){
                                    $(".academic_year").append($("<option     />").val(this.id).text(this.academic_year));
                                });
                            },
                    failure: function () {
                        alert("Failed!");
                    }
                });
            }

            // Fill Academic year dropdown list
            function GetCountriesDl() {
                $.ajax({
                    type: "GET",
                    url: "/get-countries",
                    data: '',
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(data)
                            {
                                $.each(data, function (){
                                    $(".country").append($("<option     />").val(this.id).text(this.name));
                                });

                                $(".country").val(101).change();
                            },
                    failure: function () {
                        alert("Failed!");
                    }
                });

                
            }

            // Fill Academic year dropdown list
            function GetStatesDl(country_id) {

                var default_placeholder = "{{__('display.student.placeholder.state')}}";
                $(".state").html($("<option     />").val('').text(default_placeholder));

                $.ajax({
                    type: "GET",
                    url: "/get-states/"+country_id,
                    data: '',
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(data)
                            {
                                $.each(data, function (){
                                    $(".state").append($("<option     />").val(this.id).text(this.name));
                                });
                            },
                    failure: function () {
                        alert("Failed!");
                    }
                });
            }

            // Fill Academic year dropdown list
            function GetCitiesDl(state_id) {

                var default_placeholder = "{{__('display.student.placeholder.city')}}";
                $(".city").html($("<option     />").val('').text(default_placeholder));

                $.ajax({
                    type: "GET",
                    url: "/get-cities/"+state_id,
                    data: '',
                    contentType: "application/json; charset=utf-8",
                    dataType: "json",
                    success: function(data)
                            {
                                $.each(data, function (){
                                    $(".city").append($("<option     />").val(this.id).text(this.name));
                                });
                            },
                    failure: function () {
                        alert("Failed!");
                    }
                });
            }
            

            // when document is ready
            $(document).ready(function () {

                // Bind drop down with values
                GetClassDl();
                GetAcademicYearDl();
                GetCountriesDl();

                // On form submit validate
                $('form[id="UserForm"]').validate({
                    rules: {
                        class_id: {
                            required: true,
                        },
                        academic_year_id: {
                            required: true,
                        },
                        gender: {
                            required: true,
                        },
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
                        dob: {
                            required: true,
                        },
                        address: {
                            required: true,
                        },
                        country:{
                            required: true,
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
                    }/*,
                    submitHandler: function (form) {

                        // Form data   
                        
                    }*/
                });

                // Datepicker
                $("#InputDob").datepicker({ 
                    yearRange: "-20:+0", // this is the option you're looking for
                    changeYear: true
                });

            });

        </script>
    </head>
    <body>
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
                <a href="{{ url('/') }}">Home</a>
            @else
                <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}">Register</a>
                @endif
            @endauth
        </div>
        @endif
        <div class="jumbotron">
            <h1>{{__('display.project.student_module')}}</h1>
            <p id="welcome_message"></p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form method="post" id="UserForm" onsubmit="">
                    {!! csrf_field() !!}
                        <div class="row">
                            <div class="col-12">
                                <h2>{{__('display.student.label.add')}}</h2>
                                <!-- breadcrum -->
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="/student-list">{{__('display.action.list')}}</a></li>
                                        <li class="breadcrumb-item active">{{__('display.action.add')}}</li>
                                    </ol>
                                </nav>
                                <!-- messages -->
                                <span id="success_message" class="alert-success"></span>
                                <input type="hidden" name="form_error"/>
                                <span class="alert-danger"></span>
                                <!-- Input -->
                                <div class="row">
                                    <div class="col-sm col-6">
                                        <div class="form-group">
                                            <label for="InputClassId">{{__('display.student.label.class')}} <span class="text-danger">*</span></label>
                                            <select name="class_id" class="form-control class_id" id="InputClassId" >
                                            <option value=''>{{__('display.student.placeholder.class')}}</option>
                                            </select>
                                            <span class="alert-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputAcademicYearId">{{__('display.student.label.acadimic_year')}} <span class="text-danger">*</span></label>
                                            <select name="academic_year_id" class="form-control academic_year" id="InputAcademicYearId">
                                            <option value=''>{{__('display.student.placeholder.class')}}</option>
                                            </select>
                                            <span class="alert-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputName">{{__('display.student.label.username')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="username" class="form-control" id="InputName" placeholder="{{__('display.student.placeholder.username')}}">
                                            <span class="alert-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputGender">{{__('display.student.label.gender')}} <span class="text-danger">*</span></label>
                                            <select name="gender" class="form-control gender" id="InputGender">
                                            <option value=''>{{__('display.student.placeholder.gender')}}</option>
                                            <option value='M'>Male</option>
                                            <option value='F'>Female</option>
                                            </select>
                                            <span class="alert-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputEmail1">{{__('display.student.label.email')}} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="email" id="InputEmail" aria-describedby="emailHelp" placeholder="{{__('display.student.placeholder.email')}}">
                                            <span class="alert-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputPassword">{{__('display.student.label.password')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="password"  class="form-control" id="InputPassword" placeholder="{{__('display.student.placeholder.password')}}">
                                            <span class="alert-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputReEnterPassword">{{__('display.student.label.reenter_password')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="reenter_password"  class="form-control" id="InputReEnterPassword" placeholder="{{__('display.student.placeholder.reenter_password')}}">
                                            <span class="alert-danger"></span>
                                        </div>
                                    </div>
                                    <div class="col-sm col-6">
                                        <div class="form-group">
                                            <label for="InputPhone">{{__('display.student.label.phone')}} <span class="text-danger">*</span></label>
                                            <input type="text" name="phone"  class="form-control" id="InputPhone" placeholder="{{__('display.student.placeholder.phone')}}">
                                            <span class="alert-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputDob">{{__('display.student.label.dob')}} <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" name="dob" id="InputDob" placeholder="{{__('display.student.placeholder.dob')}}">
                                            <span class="alert-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputAddress">{{__('display.student.label.address')}} <span class="text-danger">*</span></label>
                                            <textarea name="address"  class="form-control" id="InputAddress" placeholder="{{__('display.student.placeholder.address')}}"></textarea>
                                            <span class="alert-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputCountry">{{__('display.student.label.country')}} <span class="text-danger">*</span></label>
                                            <select name="country" class="form-control country" id="InputCountry" onChange="GetStatesDl(this.value)">
                                            <option value=''>{{__('display.student.placeholder.country')}}</option>
                                            </select>
                                            <span class="alert-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputState">{{__('display.student.label.state')}} <span class="text-danger">*</span></label>
                                            <select name="state" class="form-control state" id="InputState" placeholder="State" onChange="GetCitiesDl(this.value)">
                                            <option value=''>{{__('display.student.placeholder.state')}}</option>
                                            </select>
                                            <span class="alert-danger"></span>
                                        </div>
                                        <div class="form-group">
                                            <label for="InputCity">{{__('display.student.label.city')}} <span class="text-danger">*</span></label>
                                            <select name="city"  class="form-control city" id="InputCity" placeholder="City">
                                            <option value=''>{{__('display.student.placeholder.city')}}</option>
                                            </select>
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
            <div class="footer-copyright text-center py-3">@Example</div>
            <!-- Copyright -->

        </footer>
        <!-- Footer -->

    </body>
</html>
