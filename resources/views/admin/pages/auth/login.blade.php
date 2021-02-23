@extends('layouts.admin-login')

@section('loginForm')
<form method="post" action="{{ route('admin.login') }}" class="form" novalidate="novalidate" id="kt_login_signin_form">
    @csrf
    <div class="form-group">
        <input class="form-control form-control-solid h-auto py-5 px-6" type="text" placeholder="Username" name="email" autocomplete="off" />
    </div>
    <div class="form-group">
        <input class="form-control form-control-solid h-auto py-5 px-6" type="password" placeholder="Password" name="password" autocomplete="off" />
    </div>
    <!--begin::Action-->
    <div class="form-group d-flex flex-wrap justify-content-between align-items-center">
        <a href="javascript:;" class="text-dark-50 text-hover-primary my-3 mr-2" id="kt_login_forgot">Forgot Password ?</a>
        <button type="button" id="kt_login_signin_submit" class="btn btn-primary font-weight-bold px-9 py-4 my-3">Sign In</button>
    </div>
    <!--end::Action-->
</form>
@endsection

@section('styles')
<style>
.login.login-1 .login-signin,
.login.login-1 .login-signup,
.login.login-1 .login-forgot {
  display: none;
}
.login.login-1.login-signin-on .login-signup {
  display: none;
}
.login.login-1.login-signin-on .login-signin {
  display: block;
}
.login.login-1.login-signin-on .login-forgot {
  display: none;
}
.login.login-1.login-signup-on .login-signup {
  display: block;
}
.login.login-1.login-signup-on .login-signin {
  display: none;
}
.login.login-1.login-signup-on .login-forgot {
  display: none;
}
.login.login-1.login-forgot-on .login-signup {
  display: none;
}
.login.login-1.login-forgot-on .login-signin {
  display: none;
}
.login.login-1.login-forgot-on .login-forgot {
  display: block;
}

@media (min-width: 992px) {
  .login.login-1 .login-aside {
    width: 100%;
    max-width: 600px;
  }
  .login.login-1 .login-form {
    width: 100%;
    max-width: 400px;
  }
}
@media (min-width: 992px) and (max-width: 1399.98px) {
  .login.login-1 .login-aside {
    width: 100%;
    max-width: 400px;
  }
}
@media (max-width: 991.98px) {
  .login.login-1 .login-form {
    width: 100%;
    max-width: 350px;
  }
}
@media (max-width: 575.98px) {
  .login.login-1 .login-form {
    width: 100%;
    max-width: 100%;
  }
}
</style>
@endsection