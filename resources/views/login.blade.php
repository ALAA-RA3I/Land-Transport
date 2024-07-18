<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Defines the compatibility of version with browser -->
    <meta name="viewport" content="width=device-width,
                   initial-scale=1.0" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    @include('cdn.cdn')
</head>
<body>
<section class="vh-100" style="background-color: #f8c62d;">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="{{asset('images/zreek logo login.png')}}"
                                 alt="login form" style=" height:500px ;width: 500px; position:relative;top: 5px ;right: 2px" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px; text-align:center;font-weight: bolder">Sign into manager dashboard</h5>
                                <form method="POST" action="{{ route('doLogin') }}">
                                    @csrf
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="form2Example17" style="font-weight: bold">Email address</label>
                                        <input type="email" id="form2Example17" class="form-control form-control-lg" class="form-control @error('email') is-invalid @enderror" autofocus />
                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label" for="form2Example27" style="font-weight: bold">Password</label>
                                        <input type="password" id="form2Example27" class="form-control form-control-lg" class="form-control @error('password') is-invalid @enderror" />
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button type="submit"  class="btn btn-dark btn-lg btn-block"  >Login</button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
