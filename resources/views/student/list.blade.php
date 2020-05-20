@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <h2>{{__('display.student.label.list')}}</h2> 
        
        <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">{{__('display.action.list')}}</li>
            <li class="breadcrumb-item active"><a href="/add-student">{{__('display.action.add')}}</a></li>
        </ol>
        </nav>

        <div id="welcome_message" class="mb-4">
            @if(Session::get('msg'))
            <span class="alert-success success_message" id="success_status">{{Session::get('msg')}}</span>
            @endif
        </div>
        
        <span class="alert-danger" id="error_status"></span>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Father's Name</th>
                <th scope="col">Caste</th>
                <th scope="col">Phone</th>
                <th scope="col">Class</th>
                <th scope="col">Updated On</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="push_html">
            @if($response['data'])
                @foreach($response['data'] as $row)
                <tr>
                    <td>{{$row['reg_number']}}</td>
                    <td>{{$row['user']['name']}}</td>
                    <td>{{$row['father_name']}}</td>
                    <td>{{$row['caste']}}</td>
                    <td>{{$row['user']['phonenumber']}}</td>
                    <td>{{@$row['class']['detail']['roman_name']}}</td>
                    <td>{{$row['user']['updated_at']}}</td>
                    <td>
                    <a href="/add-student/{{$row['id']}}"><i class="fa fa-edit"></i></a>
                    <a href="/delete-student"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            @if ($response['last_page'] > 1)
            <ul class="pagination">
            <li class="page-item {{ ($response['current_page'] == 1) ? ' disabled' : '' }}">
            <a class="page-link" href="{{ $response['first_page_url'] }}">Previous</a>
            </li>
            @for ($i = 1; $i <= $response['last_page']; $i++)
            <li class="page-item {{ ($response['current_page'] == $i) ? ' active' : '' }}">
            <a class="page-link" href="{{ $response['path'].'?page='.$i }}">{{ $i }}</a>
            </li>
            @endfor
            <li class="page-item {{ ($response['current_page'] == $response['last_page']) ? ' disabled' : '' }}">
            <a class="page-link" href="{{ $response['path'].'?page='.$response['current_page'] }}" >Next</a>
            </li>
            </ul>
            @endif
        </nav>
        <input id="current_page" type="hidden" value="" />
    </div>
</div>
@endsection