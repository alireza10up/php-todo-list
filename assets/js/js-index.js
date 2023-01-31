$('document').ready(function () {
    // check click add folder
    $('#newFolderBtn').click((e) => {
        // get data and send with ajax
        let input = $('#newFolderInput');
        // ajax request
        $.ajax({
            url: 'process/ajaxHandler.php',
            method: 'post',
            data: {
                action: 'addFolder',
                folderName: input.val()
            },
            success: (response) => {
                // check number 
                if (/^\d+$/.test(response)) {
                    $('<li class="list-group-item d-flex justify-content-between align-items-center"><a href="?folderId=' + response + '">' + input.val() + '<span class="badge bg-dark rounded-pill">0</span></a><a href="?deleteFolderId=' + response + '" class="deleteItem"><div class="d-flex align-self-center bg-danger rounded p-1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16"><path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"></path></svg></div></a></li> ').appendTo('.folder_list');
                    swal("Create Successfully!", "Folder " + input.val() + " Created", "success");
                }
                // show err
                else {
                    swal("Oh No !!!", response, "warning");
                }
                // clear input
                input.val('');
            }
        });
    });

    // check click add tasks
    $('#addTaskBtn').click(() => {
        // get data and send whith ajax
        let input = $('#addTaskInput');
        // get folder id
        let urlParams = new URLSearchParams(window.location.search);
        let folderId = urlParams.getAll("folderId");
        // ajax request
        $.ajax({
            url: 'process/ajaxHandler.php',
            method: 'post',
            data: {
                action: 'addTask',
                title: input.val(),
                folderId: folderId[0]
            },
            success: (response) => {
                if (/^\d+$/.test(response)) {
                    location.reload();
                }
                // show err
                else {
                    swal("Oh No !!!", response, "warning");
                }
            }
        });
    });

    // switch task
    $('.taskItem').on('click', function (e) {
        // get data and send whith ajax
        let taskId = $(this).val();
        // ajax request
        $.ajax({
            url: 'process/ajaxHandler.php',
            method: 'post',
            data: {
                action: 'switchTask',
                taskId: taskId
            },
            success: (response) => {
                if (/^\d+$/.test(response)) {
                    location.reload();
                }
                // show err
                else {
                    swal("Oh No !!!", response, "warning");
                }
            }
        })
    });

    // menu handeling
    $('#menuBtn').click((e) => {
        $('.section-menu').fadeIn();
        $('#menuCover').fadeIn();
    });
    $('#menuCover').click((e) => {
        $('.section-menu').fadeOut();
        $('#menuCover').fadeOut();
    });

    // delete handel
    $('.deleteItem').on('click', function (e) {
        // get folder id for back to on folder
        let urlParams = new URLSearchParams(window.location.search);
        let folderId = urlParams.getAll("folderId");
        e.preventDefault();
        swal({
            title: "Are you sure?",
            text: "This is Item deleted for ever !!!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                let hrefItem = $(this).attr('href');
                window.location.href = hrefItem + "&folderId=" + folderId;
            };
            return false
        });
    });
});