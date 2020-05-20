
<!-- script -->
<script>
            // Fill classes dropdown list
            function GetClassDl() {
                $.ajax({
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

                                @if(@$data['class']['class_id'])
                                    $(".class_id").val({{$data['class']['class_id']}}).change();
                                @endif

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

                                @if(@$data['class']['academic_year_id'])
                                    $(".academic_year").val({{$data['class']['academic_year_id']}}).change();
                                @endif
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

                                @if(@$data['user']['state_id'])
                                $(".state").val({{$data['user']['state_id']}}).change();
                                @endif
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



                                @if(@$data['user']['city_id'])
                                $(".city").val({{$data['user']['city_id']}}).change();
                                @endif
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
                            //required: true,
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
                $(".user_date").datepicker({ 
                    yearRange: "-20:+0", // this is the option you're looking for
                    changeYear: true
                });

            });

        </script>