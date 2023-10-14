@extends('index')
@section('content')
    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div
            class="
            h-100vh
      auth-wrapper
      d-flex
      no-block
      justify-content-center
      align-items-center
      bg-dark
    ">
            <div class="auth-box bg-dark border-top border-secondary">
                <div id="loginform">
                    <div class="text-center pt-3 pb-3">
                        <h3 class="db text-white">
                            {{-- <img src="../assets/admin/images/logo.png" alt="logo" /> --}}
                            Fruit Supplier
                        </h3>
                    </div>
                    <!-- Form -->
                    <form class="form-horizontal mt-3" id="loginform" method="post"
                        action="{{ route('post-login') }}">
                        @csrf
                        <div class="row pb-4">
                            <div class="col-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-success text-white h-100" id="basic-addon1"><i
                                                class="mdi mdi-account fs-4"></i></span>
                                    </div>
                                    <input name="email" type="text" class="form-control form-control-lg" placeholder="Email"
                                        aria-label="Email" aria-describedby="basic-addon1"  />
                                 
                                </div>
                                <div class=" mb-3">
                                       @foreach ($errors->get('email') as $error)
                                        <span class="text-danger"> {!! $error !!} </span>
                                    @endforeach
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-warning text-white h-100" id="basic-addon2"><i
                                                class="mdi mdi-lock fs-4"></i></span>
                                    </div>
                                    <input name="password" type="password" class="form-control form-control-lg" placeholder="Password"
                                        aria-label="Password" aria-describedby="basic-addon1"  />
                                  
                                </div>
                                <div class=" mb-3">
                                      @foreach ($errors->get('password') as $error)
                                        <span class="text-danger"> {!! $error !!} </span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-secondary">
                            <div class="col-12">
                                <div class="form-group">
                                    <div class="pt-3">
                                        {{-- <button class="btn btn-info" id="to-recover" type="button">
                                            <i class="mdi mdi-lock fs-4 me-1"></i> Lost password?
                                        </button> --}}
                                        <button class="btn btn-success float-end text-white" type="submit">
                                            Login
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                {{-- <div id="recoverform">
                    <div class="text-center">
                        <span class="text-white">Enter your e-mail address below and we will send you
                            instructions how to recover a password.</span>
                    </div>
                    <div class="row mt-3">
                        <!-- Form -->
                        <form class="col-12" action="index.html">
                            <!-- email -->
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-danger text-white h-100" id="basic-addon1"><i
                                            class="mdi mdi-email fs-4"></i></span>
                                </div>
                                <input type="text" class="form-control form-control-lg" placeholder="Email Address"
                                    aria-label="Username" aria-describedby="basic-addon1" />
                            </div>
                            <!-- pwd -->
                            <div class="row mt-3 pt-3 border-top border-secondary">
                                <div class="col-12">
                                    <a class="btn btn-success text-white" href="#" id="to-login" name="action">Back
                                        To Login</a>
                                    <button class="btn btn-info float-end" type="button" name="action">
                                        Recover
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div> --}}
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper scss in scafholding.scss -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right Sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="../assets/matrix-theme/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="../assets/matrix-theme/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugin js -->
    <!-- ============================================================== -->
    <script>
        $(".preloader").fadeOut();
        // ==============================================================
        // Login and Recover Password
        // ==============================================================
        $("#to-recover").on("click", function() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        });
        $("#to-login").click(function() {
            $("#recoverform").hide();
            $("#loginform").fadeIn();
        });
    </script>
@endsection
