@include('template.header')
<div class="bg-gradient-primary">
    <div class="container">
        <div class="container d-flex align-items-center justify-content-center h-100">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5"
                        style="width: 500px; height: 400px; background-color: rgba(255, 255, 255, 0.8);">
                        <div class="card-body p-0">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Selamat Datang</h1>
                                </div>
                                <form class="user" action="" method="post">
                                    <div class="form-group">
                                        <input type="text" name="username" class="form-control form-control-user"
                                            placeholder="Username">
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            placeholder="Password">
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary btn-block justify-content-center">Log
                                        in</button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="">Create an Account!</a>
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
