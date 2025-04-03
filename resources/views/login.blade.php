<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>ようこそ！</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://unpkg.com/pattern.css" rel="stylesheet">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/js/all.min.js" crossorigin="anonymous"></script>
    </head>
    <body style="background-color:#def7ea" >
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container  mt-5">
                        <div class="row justify-content-center  mt-5">
                            <div class="col-lg-5 ">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger">
                                                    {{ $error }}
                                        </div>
                                    @endforeach
                                @endif
                                <div class="card shadow-lg border-0 rounded-lg" style="position:absolute;top:230px;width:500px;">
                                    <div class="card-header" style="background-color:#2da9ba" ><h5 class="text-center font-weight-light my-2 my-3 text-white " >ログイン</h3></div>
                                    <div class="card-body">
                                            {{Form::open(['url'=>route('postLogin'),'method'=>'post'])}}
                                                <div class="form-floating mb-3 mt-5">
                                                    {{Form::email('email','',['class' => 'form-control'])}}
                                                    <label for="inputEmail">Email</label>
                                                </div>
                                                <div class="form-floating mb-3">
                                                    {{Form::text('password','',['class' => 'form-control'])}}
                                                    <label for="inputPassword">Password</label>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                                                    <button class="btn text-white" style="background-color:#2da9ba">ログイン</a>
                                                </div>
                                            {{Form::close()}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
