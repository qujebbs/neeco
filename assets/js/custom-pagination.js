$(document).ready(function() {
    // DataTables initialization with custom pagination
    var userTable = $('#userTable').DataTable({
        "processing": true,
        "serverSide": true,
        "ajax": {
            "url": "custom-pagination.php", // Replace with your server-side script to fetch user data
            "type": "POST"
        },
        "columns": [
            { "data": "user_id" },
            { "data": "username" },
            { "data": "role" },
            { "data": "date_registered" },
            {
                "data": null,
                "render": function(data) {
                    return '<a href="edit_user.php?id=' + data.user_id + '" class="btn btn-primary btn-sm">Edit</a>';
                }
            }
        ],
        "language": {
            "paginate": {
                "first": "First",
                "last": "Last",
                "next": "Next",
                "previous": "Previous"
            }
        },
        "drawCallback": function(settings) {
            // Initialize the custom pagination function
            customizePagination(userTable);
        }
    });
});
