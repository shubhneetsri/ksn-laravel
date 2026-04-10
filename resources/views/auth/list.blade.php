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
        <script src="{{ asset('js/socket.io.js') }}"></script>
        <script src="{{ asset('js/jquery-3.5.0.min.js') }}"></script>

        <!-- script -->
        <script>

            // Create Connection
            var socket = io.connect('ws://127.0.0.1:1215',{transports:['websocket']});

            // Event to list users
            socket.emit('users/list',{page:1});

            // On next/Previous
            function getPaginate(type){

                var page = parseInt($("#current_page").val());

                if(type == 'next'){
                    page = page + 1;
                }else if(type == 'prev'){
                    page = page - 1;
                }

                // Event to list users
                socket.emit('users/list',{page:page});
            }

            // Delete user
            function deleteUser(user_id,row_id){

                if(confirm("Are you sure you Want to delete?")){
                    // Event to delete users
                    socket.emit('user/delete',{user_id:user_id});
                    $("#row_"+row_id).remove();
                }

            }
            
            // Listen the socket status to render users list          
            socket.on("users_list", function(response) {

                var html_list = "";
                
                if(response.success){

                    var link = "";
                    var row_id = "";
                    var user_id = "";
                    var users = response.success.data;

                    // set current page value for next & previous
                    $("#current_page").val(users.current_page);

                    // Disable previous button on first page
                    if(users.current_page == 1){
                        $("#prev").attr('disabled','disabled');   
                    }else{
                        $("#prev").removeAttr('disabled');
                    }

                    // Disable next button on last page
                    if(users.last_page == users.current_page){
                        $("#next").attr('disabled','disabled'); 
                    }else{
                        $("#next").removeAttr('disabled');
                    }

                    // Prepare table values to render
                    if(users.data.length > 0){
                        $.each( users.data, function( main_key, main_value ) {
                            
                            row_id = "row_"+main_key;
                            user_id = main_value.id;
                            html_list+= "<tr id='"+row_id+"'>";
                            
                            $.each( main_value, function( sub_key, sub_value ) {
                                html_list+= "<td>"+sub_value+"</td>";
                            });

                            html_list+= "<td> <a href='javascript:void(0)' onClick='deleteUser("+user_id+","+main_key+")'>Delete</a> </td>";
                            html_list+= "</tr>";
                        });

                        html_list+= "</tr>";

                    }else{

                        html_list+= "<tr id='"+row_id+"'>";
                        html_list+= "<td colspan='7'> No data found </td>";
                        html_list+= "</tr>";
                    }
                    
                    // Render in table HTML
                    $("#push_html").html(html_list);

                }else if(response.errors){
                    $("#error_status").html(response.errors.message);
                }
            });

            // Listen the socket status           
            socket.on("progress_message", function(message) {
                $("#welcome_message").html(message);
            });

            // Listen the socket status           
            socket.on("action_status", function(response) {
                
                if(response.errors.message){
                    $("#error_status").html(response.errors.message);
                }else if(response.success.message){
                    $("#success_status").html(response.success.message);
                }
                
            });
          
        </script>
    </head>
    <body>
        <div class="jumbotron">
            <h1><a href="/"><a href="/">Swoole Example</a></a></h1>
            <p id="welcome_message"></p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2>Users List</h2> 
                    
                    <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                    <li class="breadcrumb-item active">List</li>
                    <li class="breadcrumb-item"><a href="/add-user">Add User</a></li>
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
                        
                        </tbody>
                    </table>
                    <input id="current_page" type="hidden" value="" />
                    <button id="prev" onClick="getPaginate('prev');">Previous</button> | 
                    <button id="next" onClick="getPaginate('next');">Next</button>
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
