<!-- script -->
<script>

// Create Connection
var socket = io.connect('ws://127.0.0.1:1215',{transports:['websocket']});

// Listen notification          
socket.on("notification", function(message) {
    $("#notification").html(message);
});

// Event to list users
socket.emit('users/list',{page:1});

// On next/Previous
function getPaginate(page){

    /*var page = parseInt($("#current_page").val());

    if(type == 'next'){
        page = page + 1;
    }else if(type == 'prev'){
        page = page - 1;
    }*/

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
        var pagiUl = "";

        // Prepare pagination links to render
        if(users.last_page > 1)
        {
            
            pagiUl+= '<ul class="pagination">';
            
            if(users.current_page == 1){
                pagiUl+= '<li class="page-item disabled">';
            }else{
                pagiUl+= '<li class="page-item">';
            }
            
            pagiUl+= '<a class="page-link" href="javascript:void(0)" onClick="getPaginate('+(users.current_page - 1)+')">Previous</a>';
            pagiUl+= '</li>';

            for (var i = 1; i <= users.last_page; i++)
            {
                if(users.current_page == i){
                    pagiUl+= '<li class="page-item active">';
                }else{
                    pagiUl+= '<li class="page-item">';
                }
                
                pagiUl+= '<a class="page-link" href="javascript:void(0)" onClick="getPaginate('+i+')">'+i+'</a>';
                pagiUl+= '</li>';
            }

            if(users.current_page == users.last_page)
            {
                pagiUl+= '<li class="page-item disabled">';
            }else{
                pagiUl+= '<li class="page-item">';
            }
            
            pagiUl+= '<a class="page-link" href="javascript:void(0)" onClick="getPaginate('+(users.current_page + 1)+')" >Next</a>';
            pagiUl+= '</li>';
            pagiUl+= '</ul>';
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

                html_list+= "<td> <a href='/add-user/"+user_id+"'>Edit</a> | <a href='javascript:void(0)' onClick='deleteUser("+user_id+","+main_key+")'>Delete</a> </td>";
                html_list+= "</tr>";
            });

            html_list+= "</tr>";

        }else{

            html_list+= "<tr id='"+row_id+"'>";
            html_list+= "<td colspan='7'> No data found </td>";
            html_list+= "</tr>";
        }
        
        // Render in table HTML
        $("#navigation").html(pagiUl);
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

// when document is ready
$(document).ready(function () {

$( "#navbarDropdown" ).click(function() {
    $('.dropdown-menu').toggle();
});

$( "#dropdown" ).blur(function() {
    $('.dropdown-menu').toggle();
});
});

</script>