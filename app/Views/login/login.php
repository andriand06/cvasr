<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.min.css">

</head>

<body>


    <div class="container mt-5">

        <h1><?= $judul; ?></h1>

        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success">
                <?php echo session()->getFlashdata('success');
                ?>
            </div>
        <?php endif; ?>


        <div class="row">
            <div class="col-md-8">
                <?php if (session()->getFlashdata('error')) :
                ?>

                    <div class="alert alert-danger" data-flashdata="<?//=session()->getFlashdata('error'); ?>">
                        <?php echo session()->getFlashdata('error');
                        ?>
                    </div>
                <?php endif;  ?>
            </div>
        </div>


        <div class="row">
            <div class="col-md-8">
                <form class="px-4 py-3" method="post" action="">
                    <div class="form-group">

                        <input type="text" class="form-control <?= ($val->hasError('username')) ? 'is-invalid' : ''; ?>" name="username" placeholder="Username" autocomplete="off" value="<?= old('username'); ?>">
                        <div class="invalid-feedback" style="color:red;">
                            <?= $val->getError('username'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control <?= ($val->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password">
                        <div class="invalid-feedback" style="color:red;">
                            <?= $val->getError('password'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="dropdownCheck">
                            <label class="form-check-label" for="dropdownCheck">
                                Remember me
                            </label>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Sign In">
                </form>
                <div class="dropdown-divider"></div>

                <div class="col-md-8">
                    <p><label>New around here? </label><a href="<?= base_url('Login/registration'); ?>">Sign up</a></p>
                    <p><label>Forgot your password? </label><a href="<?= base_url('Auth/forgot'); ?>">Click here</a></p>
                </div>


            </div>

        </div>
    </div>