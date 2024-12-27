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
                                @if ($errors->any())
                                    <div class="alert alert-danger mt-3">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form class="user" action="{{ route('login') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control form-control-user"
                                            placeholder="Email" value="{{ old('email') }}">
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
                                    <a class="small" href="{{ route('register') }}">Create an Account!</a>
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
