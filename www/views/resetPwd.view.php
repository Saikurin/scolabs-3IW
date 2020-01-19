<div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <?php $this->addModal("form", $configFormReset );?>
                                <hr>
                                <div class="text-center">


                                    <a class="small" href="<?= helpers::getUrl("user", "forgotPwd")?>">Forgot Password?</a>


                                </div>
                                <div class="text-center">


                                    <a class="small" href="<?= helpers::getUrl("user", "register")?>">Create an Account!</a>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>