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
                                <form class="user" action="{{ route('register') }}" method="post">
                                    @csrf
                                    <div class="form-group mt-3">
                                        <input type="email"
                                            class="form-control form-control-user @error('email') is-invalid @enderror"
                                            placeholder="Username" name="email" value="{{ old('email') }}">
                                        @error('email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="password"
                                            class="form-control  form-control-user @error('password1') is-invalid @enderror"
                                            placeholder="Password" name="password1">
                                        @error('password1')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <input type="password"
                                            class="form-control form-control-user @error('password2') is-invalid @enderror"
                                            placeholder="Ulangi password" name="password2">
                                        @error('password2')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="role">Pilih Role:</label><br>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="role_id"
                                                id="role_admin" value="1"
                                                {{ old('role_id') == '1' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="role_admin">Admin</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="radio" class="form-check-input" name="role_id" id="role_user"
                                                value="2" {{ old('role_id') == '2' ? 'checked' : '' }}>
                                            <label class="form-check-label" for="role_user">User Biasa</label>
                                        </div>
                                        @error('role_id')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <button type="submit" class=" mt-3 btn btn-primary btn-user btn-block">
                                        Daftar
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">Sudah Punya Akun?</a>
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
