function deleteNote(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/note/delete/"+id,
                method: 'delete',
                data: {
                    id: id
                },
                success: function(response){
                    Swal.fire({
                        icon: 'success',
                        html: response.message
                    });
                    $('#note-'+id).fadeOut();

                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    var errorMessage ="";

                    $.each(err.data, function (index, val) {
                        errorMessage += val + "<br>";
                    });

                    Swal.fire({
                        icon: 'error',
                        html: errorMessage
                    });

                }
            });
        }
    });
}

function deleteTodo(id) {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/todo/delete/"+id,
                method: 'delete',
                data: {
                    id: id
                },
                success: function(response){
                    Swal.fire({
                        icon: 'success',
                        html: response.message
                    });
                    $('#todo-'+id).fadeOut();

                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    var errorMessage ="";

                    $.each(err.data, function (index, val) {
                        errorMessage += val + "<br>";
                    });

                    Swal.fire({
                        icon: 'error',
                        html: errorMessage
                    });

                }
            });
        }
    });
}

function toggleTodo(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/todo/done/"+id,
        method: 'patch',
        data: {
            id: id
        },
        success: function(response){
            $('#done-todo-'+id).css("text-decoration","line-through");

            $('#done-btn-'+id).fadeOut();
            Swal.fire({
                icon: 'success',
                html: response.message
            });

        },
        error: function(xhr, status, error) {
            var err = eval("(" + xhr.responseText + ")");
            var errorMessage ="";

            $.each(err.data, function (index, val) {
                errorMessage += val + "<br>";
            });

            Swal.fire({
                icon: 'error',
                html: errorMessage
            });

        }
    });
}


jQuery(document).ready(function(){

    if ($('#note-page').length)
    {   

        $('#submitBtn').click(function(e){
            e.preventDefault();

            $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });

           $.ajax({
                url: "/note/store",
                method: 'post',
                data: {
                    title: $('#note-title').val(),
                    note: $('#note').val()
                },
                success: function(response){
                    

                    let timerInterval
                    Swal.fire({
                    icon: 'success',
                    html: response.message,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                    }).then((result) => {
                        $('#note-title').val("");
                        $('#note').val("");
                        location.reload();
                    })


                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    var errorMessage ="";

                    $.each(err.data, function (index, val) {
                        errorMessage += val + "<br>";
                    });

                    Swal.fire({
                        icon: 'error',
                        html: errorMessage
                    });

                }
            });

        });

    }

    if ($('#note-edit-page').length) {

        $('#submitBtn').click(function(e){
            e.preventDefault();

            $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });

           $.ajax({
                url: "/note/update/"+$('#note-id').val(),
                method: 'patch',
                data: {
                    title: $('#note-title').val(),
                    note: $('#note').val()
                },
                success: function(response){

                    Swal.fire({
                        icon: 'success',
                        html: response.message
                    });

                    $('#note-title').val(response.data.title);
                    $('#note').val(response.data.note);

                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    var errorMessage ="";

                    $.each(err.data, function (index, val) {
                        errorMessage += val + "<br>";
                    });

                    Swal.fire({
                        icon: 'error',
                        html: errorMessage
                    });

                }
            });

        });
    }

    if ($('#todo-page').length) {

        $('#submitBtn').click(function(e){
            e.preventDefault();

            $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });

           $.ajax({
                url: "/todo/store",
                method: 'post',
                data: {
                    title: $('#todo').val()
                },
                success: function(response){
                    
                    let timerInterval
                    Swal.fire({
                    icon: 'success',
                    html: response.message,
                    timer: 2000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                        b.textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                    }).then((result) => {
                        $('#todo').val("");
                        location.reload();
                    })


                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    var errorMessage ="";

                    $.each(err.data, function (index, val) {
                        errorMessage += val + "<br>";
                    });

                    Swal.fire({
                        icon: 'error',
                        html: errorMessage
                    });

                }
            });

        });
    }

    if ($('#todo-edit-page').length) {

        $('#submitBtn').click(function(e){
            e.preventDefault();

            $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
            });

           $.ajax({
                url: "/todo/update/"+$('#todo-id').val(),
                method: 'patch',
                data: {
                    title: $('#todo').val()
                },
                success: function(response){

                    Swal.fire({
                        icon: 'success',
                        html: response.message
                    });

                    $('#todo').val(response.data.title);
                },
                error: function(xhr, status, error) {
                    var err = eval("(" + xhr.responseText + ")");
                    var errorMessage ="";

                    $.each(err.data, function (index, val) {
                        errorMessage += val + "<br>";
                    });

                    Swal.fire({
                        icon: 'error',
                        html: errorMessage
                    });

                }
            });

        });
    }

});