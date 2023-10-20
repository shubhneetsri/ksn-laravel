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
            @if(Session::get('error_msg'))
            <span class="alert-danger error_message" id="error_status">{{Session::get('error_msg')}}</span>
            @endif
        </div>
        
        <span class="alert-danger" id="error_status"></span>

        <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col"># </th>
                <th scope="col">Name</th>
                <th scope="col">Class</th>
                <th scope="col">March | April | May</th>
                <th scope="col">June | July | Aug</th>
                <th scope="col">Sept | Oct | Nov</th>
                <th scope="col">Dec | Jan | Feb</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="push_html">
            @if($response['data'])
                @foreach($response['data'] as $row)
                <tr>
                    <td>{{$row['student']['reg_number']}}</td>
                    <td>{{@$row['student']['user']['name']}}</td>
                    <td></td>
                    <td>{{@$row['march']}} | {{@$row['april']}} | {{@$row['may']}}</td>
                    <td>{{@$row['june']}} | {{@$row['july']}} | {{@$row['aug']}}</td>
                    <td>{{@$row['sept']}} | {{@$row['oct']}} | {{@$row['nov']}}</td>
                    <td>{{@$row['dec']}} | {{@$row['jan']}} | {{@$row['feb']}}</td>
                    <td>
                    <a href=""><i class="fa fa-edit"></i></a>
                    <a href="" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
        {{app('request')->query('sort')}}
            @if ($response['last_page'] > 1)
            <ul class="pagination">
            <li class="page-item {{ ($response['current_page'] == 1) ? ' disabled' : '' }}">
            <a class="page-link" href="{{ $response['path'].'?by='.app('request')->query('by').'&sort='.app('request')->query('sort').'&page=1' }}">Previous</a>
            </li>
            @for ($i = 1; $i <= $response['last_page']; $i++)
            <li class="page-item {{ ($response['current_page'] == $i) ? ' active' : '' }}">
            <a class="page-link" href="{{ $response['path'].'?by='.app('request')->query('by').'&sort='.app('request')->query('sort').'&page='.$i }}">{{ $i }}</a>
            </li>
            @endfor
            <li class="page-item {{ ($response['current_page'] == $response['last_page']) ? ' disabled' : '' }}">
            <a class="page-link" href="{{ $response['path'].'?by='.app('request')->query('by').'&sort='.app('request')->query('sort').'&page='.$response['current_page'] }}" >Next</a>
            </li>
            </ul>
            @endif
        </nav>
        <input id="current_page" type="hidden" value="" />
    </div>
</div>
@endsection