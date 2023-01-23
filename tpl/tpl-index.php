<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- lib bootstrap -->
    <link rel="stylesheet" href="<?= createUrl('assets/vendor/bootstrap/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= createUrl('assets/css/main.css') ?>"> 
    <title>
        <?= SITE_TITLE ?>
    </title>
</head>

<body class="bg-primary">
    <main class="d-flex justify-content-center flex-row-reverse ">
        <section class="bg-body col-5 text-center rounded m-2 p-2">
            <h5 class="m-3">
                <?= SITE_TITLE ?> - <?= verta()->format('%B %d، %Y') ?>
            </h5>
            <!-- add todo -->
            <form class="container d-flex justify-content-between mb-3">
                <div class="col-10">
                    <input type="text" name="" id="add-todo" class="form-control">
                </div>
                <button class="btn btn-dark">Process</button>
            </form>
            <!-- list todo -->
            <form class="container d-flex flex-column text-start text-white">
                <!-- todo 1 -->
                <div class="bg-success bg-gradient d-flex justify-content-between p-2 mb-3">
                    <input type="checkbox" checked name="todo" id="todo1" class="todo-item form-check-input">
                    <label for="todo1" class="form-check-label">one todo</label>
                    <div class="d-flex align-self-center bg-danger rounded p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path
                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                        </svg>
                    </div>
                </div>
                <!-- todo 2 -->
                <div class="bg-primary bg-gradient d-flex justify-content-between p-2 mb-3">
                    <input type="checkbox" name="todo" id="todo2" class="todo-item form-check-input">
                    <label for="todo2" class="form-check-label">two todo</label>
                    <div class="d-flex align-self-center bg-danger rounded p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path
                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                        </svg>
                    </div>
                </div>
                <!-- todo 3 -->
                <div class="bg-primary bg-gradient d-flex justify-content-between p-2 mb-3">
                    <input type="checkbox" name="todo" id="todo3" class="todo-item form-check-input">
                    <label for="todo3" class="form-check-label">tree todo</label>
                    <div class="d-flex align-self-center bg-danger rounded p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-trash3-fill" viewBox="0 0 16 16">
                            <path
                                d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                        </svg>
                    </div>
                </div>
            </form>
        </section>
        <section class="bg-body col-auto text-center rounded  m-2 p-2">
            <!-- profile -->
            <img src=" <?= createUrl('assets/img/non-profile.png') ?>" class="img-thumbnail rounded mb-3 "
                alt="profile">
            <h6 class="text-info mb-3">Alireza10up</h6>
            <!-- folders -->
            <h5 class="text-white bg-primary d-flex gap-1 align-items-center rounded-3 p-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-archive-fill" viewBox="0 0 16 16">
                    <path
                        d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z" />
                </svg>
                Folders :
            </h5>
            <ul class="p-0 mb-3 d-flex justify-content-between">
                <div class="col-9">
                    <input type="text" class="form-control" id="newFolderInput" placeholder="Add New Folder">
                </div>
                <button class="btn btn-dark col-2" id="newFolderBtn">+</button>
            </ul>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    All
                    <span class="badge bg-primary rounded-pill">14</span>
                </li>
                <?php foreach ($folders as $folder): ?>
                    <a href="?folderId=<?= $folder->id ?>">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= $folder->name ?>
                            <span class="badge bg-primary rounded-pill">0</span>
                            <a href="?deleteFolderId=<?= $folder->id ?>">
                                <div class="d-flex align-self-center bg-danger rounded p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                        class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                    </svg>
                                </div>
                            </a>
                        </li>
                    </a>
                <?php endforeach; ?>
            </ul>
            <!-- accounting -->
            <h5 class="text-white bg-primary d-flex gap-1 align-items-center rounded-3 p-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                    <path
                        d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5ZM9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8Zm1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5Zm-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96c.026-.163.04-.33.04-.5ZM7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0Z" />
                </svg>
                Account :
            </h5>
            <ul class="list-group mb-3">
                <button class="list-group-item d-flex justify-content-between align-items-center">
                    Setting
                </button>
                <button class="list-group-item d-flex justify-content-between align-items-center bg-danger text-white">
                    Exit
                </button>
            </ul>
        </section>
    </main>
</body>

</html>
