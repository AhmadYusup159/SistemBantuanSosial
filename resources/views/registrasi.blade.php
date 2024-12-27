@include('template.header')
<div class="bg-gradient-primary">
    <div class="container">
        <div class="container d-flex align-items-center justify-content-center h-100">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5"
                        style="width: 500px; height: 500px;  background-color: rgba(255, 255, 255, 0.8);">
                        <div class="card-body p-0">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Buat Akun</h1>
                                </div>
                                <form class="user" action="" method="post">
                                    <div class="form-group mt-3">
                                        <input type="email" class="form-control form-control-user"
                                            placeholder="Username" name="email">
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="password" class="form-control  form-control-user"
                                            placeholder="Password" name="password1">
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="password" class="form-control form-control-user"
                                            placeholder="Ulangi password" name="password2">
                                    </div>

                                    <button type="submit" class=" mt-3 btn btn-primary btn-user btn-block">
                                        Daftar
                                    </button>

                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="">Sudah Punya Akun?</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('template.footer')
