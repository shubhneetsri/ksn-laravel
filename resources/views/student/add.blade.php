@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
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
                    <span id="success_message" class="alert-success"></span>
                    <span id="error_message" class="alert-danger"></span>
                    <input type="hidden" name="form_error" />
                    <span class="alert-danger"></span>
                    <!-- Input -->
                    <div class="row">
                        <div class="col-sm col-6">
                            <div class="form-group">
                                <label for="InputClassId">{{__('display.student.label.class')}} <span class="text-danger">*</span></label>
                                <select name="class_id" class="form-control class_id" id="InputClassId">
                                    <option value=''>{{__('display.student.placeholder.class')}}</option>
                                </select>
                                <span class="alert-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputAcademicYearId">{{__('display.student.label.acadimic_year')}} <span class="text-danger">*</span></label>
                                <select name="academic_year_id" class="form-control academic_year" id="InputAcademicYearId">
                                    <option value=''>{{__('display.student.placeholder.acadimic_year')}}</option>
                                </select>
                                <span class="alert-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputName">{{__('display.student.label.username')}} <span class="text-danger">*</span></label>
                                <input type="text" name="username" value="{{ old('username') }}" class="form-control" id="InputName" placeholder="{{__('display.student.placeholder.username')}}">
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
                                <label for="InputFatherName">{{__('display.student.label.father_name')}} </label>
                                <input type="text" name="father_name" value="{{ old('father_name') }}" class="form-control" id="InputFatherName" placeholder="{{__('display.student.placeholder.father_name')}}">
                                <span class="alert-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputMotherName">{{__('display.student.label.mother_name')}} </label>
                                <input type="text" name="mother_name" value="{{ old('mother_name') }}" class="form-control" id="InputMotherName" placeholder="{{__('display.student.placeholder.mother_name')}}">
                                <span class="alert-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputCaste">{{__('display.student.label.caste')}} </label>
                                <select name="caste" class="form-control caste" id="InputCaste">
                                    <option value=''>{{__('display.student.placeholder.caste')}}</option>
                                    <option value='GEN'>General</option>
                                    <option value='SC'>Schedule Class</option>
                                    <option value='ST'>Schedule Tribe</option>
                                    <option value='OBC'>Other Backword</option>
                                </select>
                                <span class="alert-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputEmail1">{{__('display.student.label.email')}} <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="email" value="{{ old('email') }}" id="InputEmail" aria-describedby="emailHelp" placeholder="{{__('display.student.placeholder.email')}}">
                                <span class="alert-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputPassword">{{__('display.student.label.password')}}</label>
                                <input type="text" name="password" value="{{ old('password') }}" class="form-control" id="InputPassword" placeholder="{{__('display.student.placeholder.password')}}">
                                <span class="alert-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputReEnterPassword">{{__('display.student.label.reenter_password')}}</label>
                                <input type="text" name="reenter_password" value="{{ old('reenter_password') }}" class="form-control" id="InputReEnterPassword" placeholder="{{__('display.student.placeholder.reenter_password')}}">
                                <span class="alert-danger"></span>
                            </div>
                        </div>
                        <div class="col-sm col-6">
                            <div class="form-group">
                                <label for="InputPhone">{{__('display.student.label.phone')}} <span class="text-danger">*</span></label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control" id="InputPhone" placeholder="{{__('display.student.placeholder.phone')}}">
                                <span class="alert-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputDob">{{__('display.student.label.dob')}} <span class="text-danger">*</span></label>
                                <input type="text" autocomplete="off" class="form-control user_date" name="dob" value="{{ old('dob') }}" id="InputDob" placeholder="{{__('display.student.placeholder.dob')}}">
                                <span class="alert-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputAddress">{{__('display.student.label.address')}} <span class="text-danger">*</span></label>
                                <textarea name="address" value="{{ old('address') }}" class="form-control" id="InputAddress" placeholder="{{__('display.student.placeholder.address')}}"></textarea>
                                <span class="alert-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputCurrentAddress">{{__('display.student.label.current_address')}} <span class="text-danger">*</span></label>
                                <textarea name="current_address" value="{{ old('current_address') }}" class="form-control" id="InputCurrentAddress" placeholder="{{__('display.student.placeholder.current_address')}}"></textarea>
                                <span class="alert-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputCountry">{{__('display.student.label.country')}} <span class="text-danger">*</span></label>
                                <select name="country" value="{{ old('country') }}" class="form-control country" id="InputCountry" onChange="GetStatesDl(this.value)" readonly>
                                    <option value=''>{{__('display.student.placeholder.country')}}</option>
                                </select>
                                <span class="alert-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputState">{{__('display.student.label.state')}} <span class="text-danger">*</span></label>
                                <select name="state" value="{{ old('state') }}" class="form-control state" id="InputState" placeholder="State" onChange="GetCitiesDl(this.value)">
                                    <option value=''>{{__('display.student.placeholder.state')}}</option>
                                </select>
                                <span class="alert-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputCity">{{__('display.student.label.city')}} <span class="text-danger">*</span></label>
                                <select name="city" value="{{ old('city') }}" class="form-control city" id="InputCity" placeholder="City">
                                    <option value=''>{{__('display.student.placeholder.city')}}</option>
                                </select>
                                <span class="alert-danger"></span>
                            </div>
                            <div class="form-group">
                                <label for="InputDoj">{{__('display.student.label.doj')}} </label>
                                <input type="text" autocomplete="off" class="form-control user_date" name="doj" value="{{ old('doj') }}" id="InputDoj" placeholder="{{__('display.student.placeholder.doj')}}">
                                <span class="alert-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm col-6">
                            <!-- onClick="return validate(this.form)" -->
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
@include('student.js.add_student_script')
@endsection