$('document').ready(function () {
    // check click 
    $('#newFolderBtn').click(function (e) {
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
            success: function (response) {
                // check number 
                if (/^\d+$/.test(response)) {
                    $('<li class="list-group-item d-flex justify-content-between align-items-center"><a href="?folderId=' + response + '">' + input.val() + '<span class="badge bg-primary rounded-pill">0</span></a><a href="?deleteFolderId=' + response + '"><div class="d-flex align-self-center bg-danger rounded p-1"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16"><path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"></path></svg></div></a></li> ').appendTo('.folder_list');
                    swal("Create Successfully!", "Folder " + input.val() + " Created", "success");
                }
                // show err
                else {
                    swal("Oh No !!!" ,response ,"warning");
                }
                // clear input
                input.val('');
            }
        });
    });

    // menu handeling
    $('#menuBtn').click(function (e) {
        $('.section-menu').fadeIn();
        $('#menuCover').fadeIn();
    });
    $('#menuCover').click(function (e) {
        $('.section-menu').fadeOut();
        $('#menuCover').fadeOut();
    });
});