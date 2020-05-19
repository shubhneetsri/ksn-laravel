<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Swoole Socket Assignment</title>

        <!-- css -->
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <!-- js -->
        <script src="{{ asset('js/jquery-3.5.0.min.js') }}"></script>

        <!-- script -->
        <script>

        </script>
    </head>
    <body>
        <div class="jumbotron">
            <h1>{{__('display.project.student_module')}}</h1>
            <p id="welcome_message"></p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>{{__('display.student.label.list')}}</h2> 
                    
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">{{__('display.action.list')}}</li>
                        <li class="breadcrumb-item active"><a href="/add-student">{{__('display.action.add')}}</a></li>
                    </ol>
                    </nav>

                    <div id="welcome_message" class="mb-4"></div>
                    <span class="alert-success" id="success_status"></span>
                    <span class="alert-danger" id="error_status"></span>

                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Created On</th>
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
                                <td>{{$row['user']['email']}}</td>
                                <td>{{$row['user']['phonenumber']}}</td>
                                <td>{{$row['user']['created_at']}}</td>
                                <td>{{$row['user']['updated_at']}}</td>
                                <td>
                                <a href="/add-student"><i class="fa fa-edit"></i></a>
                                <a href="/delete-student"><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                    <input id="current_page" type="hidden" value="" />
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
