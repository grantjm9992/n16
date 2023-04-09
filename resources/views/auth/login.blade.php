<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Timetable application</title>
    <!-- base:css -->
    <link rel="stylesheet" href="/vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="/images/favicon.png" />
</head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="brand-logo">
                        </div>
                        <h4>Hello! let's get started</h4>
                        <h6 class="font-weight-light">Sign in to continue.</h6>
                        <form class="pt-3" id="sign-in-form">
                            <div class="form-group">
                                <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                            </div>
                            <div class="my-2 d-flex justify-content-between align-items-center">
                                <div class="form-check">
                                    <label class="form-check-label text-muted">
                                        <input type="checkbox" class="form-check-input">
                                        Keep me signed in
                                    </label>
                                </div>
                                <a href="#" class="auth-link text-black">Forgot password?</a>
                            </div>
                            <div class="text-center mt-4 font-weight-light">
                                Don't have an account? <a href="register.html" class="text-primary">Create</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- base:js -->
<script src="/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="/js/off-canvas.js"></script>
<script src="/js/hoverable-collapse.js"></script>
<script src="/js/template.js"></script>
<script src="/js/settings.js"></script>
<script src="/js/todolist.js"></script>
<script src="https://polyfill.io/v3/polyfill.min.js?features=WeakRef,BigInt"></script>
<script src="https://cdn.jsdelivr.net/npm/superagent"></script>
<script type="text/javascript">
    let form = document.getElementById('sign-in-form');
    form.onsubmit = (e) => {
        e.preventDefault();
        superagent
            .post('/api/login')
            .send({ email: document.getElementById('email').value, password: document.getElementById('password').value }) // sends a JSON post body
            .set('accept', 'json')
            .then((res) => {
                res = res.body;
                localStorage.setItem('user', res.user);
                localStorage.setItem('token', res.authorisation.token);
            }).catch((err) => {
            console.error(err);
        });
    }
</script>
<!-- endinject -->
</body>

</html>
