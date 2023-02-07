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
        <?= SITE_TITLE ?> || 10UP
    </title>
</head>

<body class="bg-primary">
    <main>
        <section class="section-menu-navigation bg-body text-center rounded m-2 p-2 d-none">
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" id="menuBtn" class="bi bi-list" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z" />
            </svg>
        </section>
        <div id="menuCover"></div>
        <section class="section-menu bg-body text-center rounded m-2 p-2">
            <!-- profile -->
            <img src=" <?= "https://www.gravatar.com/avatar/" . md5( strtolower( trim( getUserById($_COOKIE['login'])->email ) ) ) ?>" class="img-thumbnail rounded mb-3 " alt="profile">
            <h6 class="text-info mb-3">Welcome <?= getUserById($_COOKIE['login'])->name ?></h6>
            <!-- folders -->
            <h5 class="text-white bg-primary d-flex gap-1 align-items-center rounded-3 p-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-archive-fill" viewBox="0 0 16 16">
                    <path d="M12.643 15C13.979 15 15 13.845 15 12.5V5H1v7.5C1 13.845 2.021 15 3.357 15h9.286zM5.5 7h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1 0-1zM.8 1a.8.8 0 0 0-.8.8V3a.8.8 0 0 0 .8.8h14.4A.8.8 0 0 0 16 3V1.8a.8.8 0 0 0-.8-.8H.8z" />
                </svg>
                Folders :
            </h5>
            <ul class="p-0 mb-3 d-flex justify-content-between">
                <div class="col-9">
                    <input type="text" class="form-control" id="newFolderInput" placeholder="Add New Folder">
                </div>
                <button class="btn btn-dark col-2" id="newFolderBtn">+</button>
            </ul>
            <ul class="folder_list rounded-3 list-group mb-3">
                <a href="<?= BASE_URL ?>">
                    <li class="<?= /* active all */ (!isset($_GET['folderId'])) ? "active" : " rounded-top list-group-item-action" ?> list-group-item d-flex justify-content-between align-items-center">
                        All
                        <span class="badge bg-dark rounded-pill"><?= countItemInFolder()[0]->total ?></span>
                    </li>
                </a>
                <?php foreach ($folders as $folder) : ?>
                    <a href="?folderId=<?= $folder->id ?>">
                        <li class="<?= /* active */ (isset($_GET['folderId']) && $_GET['folderId'] == $folder->id) ? "active" : "list-group-item-action" ?> list-group-item d-flex justify-content-between align-items-center">
                            <?= $folder->name ?>
                            <span class="badge bg-dark rounded-pill"><?= countItemInFolder($folder->id)[0]->total ?></span>
                            <a href="?deleteFolderId=<?= $folder->id ?>" class="deleteItem">
                                <div class="d-flex align-self-center bg-danger rounded p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                    </svg>
                                </div>
                            </a>
                        </li>
                    </a>
                <?php endforeach; ?>
            </ul>
            <!-- accounting -->
            <h5 class="text-white bg-primary d-flex gap-1 align-items-center rounded-3 p-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-vcard-fill" viewBox="0 0 16 16">
                    <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm9 1.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4a.5.5 0 0 0-.5.5ZM9 8a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 0-1h-4A.5.5 0 0 0 9 8Zm1 2.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 0-1h-3a.5.5 0 0 0-.5.5Zm-1 2C9 10.567 7.21 9 5 9c-2.086 0-3.8 1.398-3.984 3.181A1 1 0 0 0 2 13h6.96c.026-.163.04-.33.04-.5ZM7 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0Z" />
                </svg>
                Account :
            </h5>
            <ul class="list-group mb-3">
                <button class="list-group-item d-flex justify-content-between align-items-center">
                    Setting
                </button>
                <button onclick="location.href='?logout=1'" class="list-group-item d-flex justify-content-between align-items-center bg-danger text-white">
                    Exit
                </button>
            </ul>
        </section>
        <section class="section-content bg-body rounded m-2 p-2">
            <div class="container d-flex flex-wrap">
                <h4 class="m-1 alert-primary p-2 rounded-3 d-flex align-items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" style='fill:#084298' class="bi bi-check2-square" viewBox="0 0 16 16">
                        <path d="M3 14.5A1.5 1.5 0 0 1 1.5 13V3A1.5 1.5 0 0 1 3 1.5h8a.5.5 0 0 1 0 1H3a.5.5 0 0 0-.5.5v10a.5.5 0 0 0 .5.5h10a.5.5 0 0 0 .5-.5V8a.5.5 0 0 1 1 0v5a1.5 1.5 0 0 1-1.5 1.5H3z" />
                        <path d="m8.354 10.354 7-7a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0z" />
                    </svg>
                    <?= SITE_TITLE ?> <br>
                </h4>
                <h4 class="m-1 alert-danger p-2 rounded-3 d-flex align-items-center gap-1">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" style="fill:#842029" class="bi bi-calendar-event-fill" viewBox="0 0 16 16">
                        <path d="M4 .5a.5.5 0 0 0-1 0V1H2a2 2 0 0 0-2 2v1h16V3a2 2 0 0 0-2-2h-1V.5a.5.5 0 0 0-1 0V1H4V.5zM16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zm-3.5-7h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z" />
                    </svg>
                    <?= date('Y - m - d') ?>
                </h4>
            </div>

            <!-- add todo -->
            <article class="container d-flex flex-column gap-3 mt-3 mb-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" style="fill:black;" class="bi bi-list-task" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5H2zM3 3H2v1h1V3z" />
                                <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1h-9z" />
                                <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5V7zM2 7h1v1H2V7zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5H2zm1 .5H2v1h1v-1z" />
                            </svg>
                        </span>
                    </div>
                    <input type="text" id="addTaskInput" class="form-control input-add-todo" placeholder="Write Youre Task ...">
                </div>
                <div class="d-flex gap-2">
                    <button id="addTaskBtn" class="btn btn-dark ">Submit</button>
                    <input type="reset" id="clearBtn" class="btn btn-danger" value="Clear">
                </div>
            </article>
            <!-- list todo -->
            <article class="container d-flex flex-column text-start text-white">
                <?php if (sizeof($tasks)) : ?>
                    <?php $i = 1; ?>
                    <?php foreach ($tasks as $task) : ?>
                        <!-- todo 1 -->
                        <div class="flex-wrap rounded-3 gap-3 <?= /* checked ? */ $task->is_done ? 'bg-success' : 'bg-primary'; ?> bg-gradient d-flex justify-content-between p-2 mb-3">
                            <div class="d-flex gap-2 rounded-3 p-2 alert-primary align-items-center">
                                <input type="checkbox" <?= /* checked */ $task->is_done ? 'checked' : '' ?> id="todo<?= $i ?>" class="taskItem form-check-input" value="<?= /* task id */ $task->id ?>">
                                <label for="todo<?= $i ?>" class="form-check-label"><?= /* title */ $task->title ?></label>
                            </div>
                            <div class="d-flex gap-3 ">
                                <span class="alert-info p-2 rounded-3 d-flex align-items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" style='fill:#055160;' class="bi bi-calendar-plus" viewBox="0 0 16 16">
                                        <path d="M8 7a.5.5 0 0 1 .5.5V9H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V10H6a.5.5 0 0 1 0-1h1.5V7.5A.5.5 0 0 1 8 7z" />
                                        <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                    </svg>
                                    <?= /* create at */ $task->create_at ?>
                                </span>
                                <a href="?deleteTaskId=<?= $task->id ?>" class="deleteItem d-flex align-self-center bg-danger rounded p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="flex-wrap rounded-3 bg-warning bg-gradient d-flex justify-content-between p-2 mb-3">
                        Nothing Task Here ...
                    </div>
                <?php endif; ?>
            </article>
        </section>
    </main>
</body>
<!-- lib jquery -->
<script src="<?= createUrl('assets/vendor/jquery/jquery-3.6.3.min.js') ?>"></script>
<script src="<?= createUrl('assets/js/js-index.js') ?>"></script>
<script src="<?= createUrl('assets/vendor/sweetalert/sweetalert.min.js') ?>"></script>

</html>