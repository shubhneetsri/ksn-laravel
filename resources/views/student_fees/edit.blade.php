@extends('layouts.admin')
@section('content')
<style>
    #fees_display_table td {
        width: 34%;
        border: 1px solid;
        padding: 8px;
        font-weight: bold;
        text-align: center;
    }
    #fees_display_table .left{
        text-align: left;
    }
    .fee_text{
        font-weight: bold;
    }
    .paid{
        color:green;
        font-size: 15px;
    }
    .due{
        color:#dc3545;
        font-size: 15px;
    }
</style>
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
                    <div id="messages"></div>
                    <div class="flash-message">
                        @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                        @if(Session::has('alert-' . $msg))
                        <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}</p>
                        @endif
                        @endforeach
                    </div>
                    <span id="success_message" class="alert-success"></span>
                    <input type="hidden" name="form_error" />
                    <span class="alert-danger"></span>
                    <!-- Input -->
                    <div class="row">
                        <div class="col-sm col-6">
                            <div class="form-group">
                                <label for="InputClassId">{{__('display.student.label.class')}} <span class="text-danger">*</span></label>
                                <select name="class_id" class="form-control class_id" id="InputClassId" readonly disabled>
                                    <option value=''>{{__('display.student.placeholder.class')}}</option>
                                    <option selected value="{{$data['class']['class_id']}}">{{\App\Helpers\Helper::getClassNameByID($data['class']['class_id'])}}</option>
                                </select>
                                <span class="alert-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputAcademicYearId">{{__('display.student.label.acadimic_year')}} <span class="text-danger">*</span></label>
                                <select name="academic_year_id" class="form-control academic_year" id="InputAcademicYearId">
                                    <option value=''>{{__('display.student.placeholder.class')}}</option>
                                    <option selected value="{{$data['class']['academic_year_id']}}">{{\App\Helpers\Helper::getAcademicYearByID($data['class']['academic_year_id'])}}</option>
                                </select>
                                <span class="alert-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputName">{{__('display.student.label.username')}} <span class="text-danger">*</span></label>
                                <input type="text" name="username" class="form-control" id="InputName" placeholder="{{__('display.student.placeholder.username')}}" value="{{$data['user']['name']}}" readonly />
                                <span class="alert-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputAcademicYearId">{{__('display.student.label.select_fee_structure')}} <span class="text-danger">*</span></label>
                                <select name="fee_id" class="form-control fee_structure" id="InputFeeStructure">
                                    <option value=''>{{__('display.student.placeholder.select_fee_structure')}}</option>
                                    @if(!empty($feeStructures))
                                    @foreach($feeStructures as $structure)
                                    <option value='{{$structure['id']}}' @if(isset($student_fee_details['fee_structure']->id) && $student_fee_details['fee_structure']->id == $structure['id']) selected @endif>{{$structure['academic_year']['academic_year']}}</option>
                                    @endforeach
                                    @endif
                                </select>
                                <span class="alert-danger"></span>
                                <a href="javascript:void(0)">Manage Fee Structures</a>
                            </div>


                            <div class="form-group">
                                <label for=""><h4>Fee Structure</h4></label>
                            </div><!-- comment -->
                            <div class="form-group">
                                <label for="InputAcademicYearId">{{__('display.student.label.admission_fee')}} : </label>
                                <span class="fee_text" id="admission_fee">@if(isset($student_fee_details['fee_structure']->admission_fee)) {{$student_fee_details['fee_structure']->admission_fee}} @else - @endif</span>
                            </div>

                            <div class="form-group">
                                <label for="InputAcademicYearId">{{__('display.student.label.development_fee')}} : </label>
                                <span class="fee_text" id="development_fee">@if(isset($student_fee_details['fee_structure']->development_fee)) {{$student_fee_details['fee_structure']->development_fee}} @else - @endif</span>
                            </div>

                            <div class="form-group">
                                <label for="InputAcademicYearId">{{__('display.student.label.other')}} : </label>
                                <span class="fee_text" id="other">@if(isset($student_fee_details['fee_structure']->other)) {{$student_fee_details['fee_structure']->other}} @else - @endif</span>
                            </div>

                            <div class="form-group">
                                <label for="InputAcademicYearId">{{__('display.student.label.monthly_fee')}} : </label>
                                <span class="fee_text" id="monthly_fee">@if(isset($student_fee_details['fee_structure']->monthly_fee)) {{$student_fee_details['fee_structure']->monthly_fee}} @else - @endif</span>
                            </div>
                            
                            @if($is_payment_pending)
                            <div class="form-group">
                                <label for="InputName">{{__('display.student.label.add_fee_amount')}} <span class="text-danger">*</span></label>
                                <input type="number" name="add_fee_amount" class="form-control" id="InputAddFee" placeholder="{{__('display.student.placeholder.add_fee_amount')}}" value="{{$student_fee_details['total_pending_fee']}}"  />
                                <span class="alert-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputName">{{__('display.student.label.recieved_on')}} <span class="text-danger">*</span></label>
                                <input type="date" name="recieved_on" class="form-control" id="InputRecievedOn" placeholder="{{__('display.student.placeholder.recieved_on')}}"  />
                                <span class="alert-danger"></span>
                            </div>
                            @else
                            <div class="form-group">
                                <label for="InputName">{{__('display.student.label.add_fee_amount')}} : </label>
                                Student's all submissions have been done for this year. No pending fees.
                                <span class="alert-danger"></span>
                            </div>
                            @endif

                        </div>
                        <div class="col-sm col-6">
                            <table id="fees_display_table">
                                <thead>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                </thead>
                                <tbody>

                                    @php $index = 0; @endphp
                                    @foreach($key_value_array as $key => $value)

                                    @if(!is_int($key))
                                    <tr>
                                        <td colspan="3" class='left'>{{__('display.student_fee.label.'.$value)}}: <span class='paid'>Paid : {{$student_fee_details['student_fee_stack'][$key]}}</span> | <span class='due'> Due : {{$student_fee_details['pending_fee_details'][$key]}}</span></td>
                                    </tr>
                                    @endif

                                    @if(is_int($key))

                                    @if($index === 0)
                                    <tr>
                                        @endif
                                        @php $index++; @endphp

                                        <td clsss="month">{{__('display.student_fee.label.'.$value)}}<br/>
                                            <span class='paid'>Paid ({{$student_fee_details['student_fee_stack'][$key]}})</span>
                                            &nbsp;|&nbsp;<span class='due'>Due ({{$student_fee_details['pending_fee_details'][$key]}})</span> 

                                            @if($index > 2)
                                    </tr>
                                    @php $index = 0; @endphp
                                    @endif

                                    @endif
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if($is_payment_pending)
                    <div class="row">
                        <div class="col-sm col-6">
                            <!-- onClick="return validate(this.form)" -->
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

@include('student_fees.js.script')

@endsection