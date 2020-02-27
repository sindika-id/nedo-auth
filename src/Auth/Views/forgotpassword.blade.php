<!doctype html>
<html>
    <head>
        <title>Reset Password</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h3>Reset Password</h3>
            <form action="/auth/forgotpass" method="POST">
                @csrf
                @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Email Address</label>
                    <div class="col-lg-10">
                        <input type="text" name="email" class="form-control @error('email') border-danger @enderror" placeholder="" value={{old('email')}}>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Reset Password</button>
            </form>
        </div>
    </body>
</html>
