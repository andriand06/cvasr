<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="container mt-5">
        <div class="kotak">
            <center>
                <h1>CREATE ACCOUNT FOR FREE!</h1>
            </center>
            <center>
                <p><label for="">Already have an account?</label>
                    <a href="<?= base_url('login'); ?>">Login here.</a></p>
            </center>
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" value="<?= $username; ?>">
                    <small style="color:red;">
                        <?= \Config\Services::validation()->getError('username'); ?></small>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?= $password; ?>">
                    <small style="color:red;">
                        <?= \Config\Services::validation()->getError('password'); ?></small>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="Ulangi Password" name="ulangipassword" placeholder="Ulangi Password">
                    <small style="color:red;">
                        <?= \Config\Services::validation()->getError('ulangipassword'); ?></small>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Isi dengan Format Email" value="<?= $email; ?>">
                    <small style="color:red;">
                        <?= \Config\Services::validation()->getError('email'); ?></small>
                </div>
                <button type="submit" class="btn btn-primary">Registrasi</button>
            </form>
        </div>


    </div>
</body>

</html>