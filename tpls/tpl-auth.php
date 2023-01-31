<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login || register</title>
    <link rel="stylesheet" href="<?= createUrl('assets/css/main.css') ?>">
    <link rel="stylesheet" href="<?= createUrl('assets/css/auth.css') ?>">
</head>

<body>
    <div class="login-box">
        <div class="lb-header">
            <a href="#" class="active" id="login-box-link">Login</a>
            <a href="#" id="signup-box-link">Sign Up</a>
        </div>
        <form class="email-login" method="post">
            <input type="hidden" name="action" value="login">
            <div class="u-form-group">
                <input type="email" name="email" placeholder="Email" value="<?= $_POST['email'] ?? null ?>" />
            </div>
            <div class="u-form-group">
                <input type="password" name="password" placeholder="Password" value="<?= $_POST['password'] ?? null ?>" />
            </div>
            <div class="u-form-group">
                <button type='submit'>Log in</button>
            </div>
            <div class="u-form-group">
                <a href="<?= BASE_URL ?>" class="forgot-password">Back To Home</a>
            </div>
        </form>
        <form class="email-signup" method="post">
            <input type="hidden" name="action" value="register">
            <div class="u-form-group">
                <input type="text" name="name" placeholder="Name" value="<?= $_POST['name'] ?? null ?>" />
            </div>
            <div class="u-form-group">
                <input type="email" name="email" placeholder="Email" value="<?= $_POST['email'] ?? null ?>" />
            </div>
            <div class="u-form-group">
                <input type="password" name="password" placeholder="Password" value="<?= $_POST['password'] ?? null ?>" />
            </div>
            <div class=" u-form-group">
                <button type='submit'>Sign Up</button>
            </div>
        </form>
    </div>
</body>
<!-- scripts  -->
<script src="<?= createUrl('assets/vendor/jquery/jquery-3.6.3.min.js') ?>"></script>
<script src="<?= createUrl('assets/vendor/sweetalert/sweetalert.min.js') ?>"></script>
<script>
    $(".email-signup").hide();
    $("#signup-box-link").click(function() {
        $(".email-login").fadeOut(100);
        $(".email-signup").delay(100).fadeIn(100);
        $("#login-box-link").removeClass("active");
        $("#signup-box-link").addClass("active");
    });
    $("#login-box-link").click(function() {
        $(".email-login").delay(100).fadeIn(100);;
        $(".email-signup").fadeOut(100);
        $("#login-box-link").addClass("active");
        $("#signup-box-link").removeClass("active");
    });
</script>

</html>