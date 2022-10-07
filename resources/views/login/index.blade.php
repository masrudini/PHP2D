<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login | Page</title>
    <link rel="stylesheet" href="admin_template/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="admin_template/assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="admin_template/assets/css/style.css">
    <link rel="shortcut icon" href="images/sungai_kakap.ico" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth">
                <div class="row flex-grow">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-center p-5">
                            @if (session()->has('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif
                            @if (session()->has('loginError'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('loginError') }}
                                </div>
                            @endif
                            <div class="brand-logo">
                                <img src="{{ url('images/sungai_kakap.png') }}" style="width: 60px;">
                            </div>
                            <h4>Selamat Datang di Website Sungai Kakap</h4>
                            <h6 class="font-weight-light">Masuk untuk melanjutkan</h6>
                            <form class="pt-3" method="POST" action="/login">
                                @csrf
                                <div class="form-group">
                                    <input type="email"
                                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                                        id="email" name="email" placeholder="Username" value="{{ old('email') }}"
                                        autofocus required>
                                    @error('email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password"
                                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Password">
                                    @error('password')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-end">
                                    <p class="text-muted">Show Password <i class="mdi mdi-eye-off"
                                            id="togglePassword"></i></p>
                                </div>
                                <div class="mt-3 ">
                                    <button
                                        class="btn btn-block btn-gradient-info btn-lg font-weight-medium auth-form-btn"
                                        type="submit">SIGN IN</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const password = document.querySelector("#password");

        togglePassword.addEventListener("click", function() {
            // toggle the type attribute
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);

            // toggle the icon
            const kelas = togglePassword.getAttribute("class") === "mdi mdi-eye-off" ? "mdi mdi-eye" :
                "mdi mdi-eye-off";
            togglePassword.setAttribute("class", kelas);
        });
    </script>

    {{-- js --}}
    <script src="admin_template/assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="admin_template/assets/js/off-canvas.js"></script>
    <script src="admin_template/assets/js/hoverable-collapse.js"></script>
    <script src="admin_template/assets/js/misc.js"></script>
</body>

</html>
