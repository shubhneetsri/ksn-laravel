<!-- script -->
<script>

    // Fill Academic year dropdown list
    function GetAcademicYearDl() {
        $.ajax({
        type: "GET",
                url: "/get-academic-years",
                data: '',
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function(data) {
                $.each(data, function() {
                $(".academic_year").append($("<option     />").val(this.id).text(this.academic_year));
                });
                        @if (isset($data))
                        var data = {!! json_encode($data) !!};
                        $("#InputAcademicYearId").val(data.academic_year_id).change();
                        @endif
                },
                failure: function() {
                alert("Failed!");
                }
        });
    }

    // when document is ready
    $(document).ready(function () {

        GetAcademicYearDl();

        $("#InputFeeStructure").change(function () {
            $.ajax({
                type: "GET",
                url: "/get-fee-structure/{{$student_id}}/" + $(this).val() + '/' + $('#InputAcademicYearId').val(),
                data: '',
                contentType: "application/json; charset=utf-8",
                dataType: "json",
                success: function (data) {
                    if (data.status == 1) {
                        $('#admission_fee').html(data.fee_structure.admission_fee);
                        $('#development_fee').html(data.fee_structure.development_fee);
                        $('#other').html(data.fee_structure.other);
                        $('#monthly_fee').html(data.fee_structure.monthly_fee);
                        $('#InputAddFee').val(data.topay);
                    }
                },
                failure: function () {
                    alert("Failed!");
                }
            });
        });

        // On form submit validate
        $('form[id="UserForm"]').validate({
            rules: {
                academic_year_id: {
                    required: true,
                },
                fee_structure: {
                    required: true,
                },
                add_fee_amount: {
                    required: true,
                },
                recieved_on: {
                    required: true,
                }
            },
            submitHandler: function (form, event) {

                event.preventDefault();
                $("#messages").html("");

                $.ajax({
                    type: "POST",
                    url: "{{ route('add-student-fee').'/'.@$student_id }}",
                    headers: {
                        'csrftoken': '{{ csrf_token() }}'
                    },
                    data: $(form).serialize(), // serializes the form's elements.
                    success: function (data) {
                        if (data.status == 'error') {
                            $("#messages").html("<div class='alert alert-danger' role='alert'>" + data.message + "</div>");
                            $("#messages").css("display", "block");
                            //location.reload();
                        } else {
                            $("#messages").html("<div class='alert alert-success' role='alert'>" + data.message + "</div>");
                            $("#messages").css("display", "block");
                            location.reload();
                        }

                        $(window).scrollTop('slow');
                        setTimeout(function () {
                            $('.alert').fadeOut();
                            $('.alert').html('')
                        }, 10000);

                    }
                });

                return false; // required to block normal submit ajax used
            }
        });
        
        // Datepicker
        $(".recieved_on").datepicker({
            yearRange: "-20:+0", // this is the option you're looking for
            changeYear: true
        });



    });
</script>