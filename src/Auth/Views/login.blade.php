<!doctype html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h3>Login</h3>
            <form action="/auth/login" method="POST">
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
                        <input type="text" name="username" class="form-control @error('username') border-danger @enderror" placeholder="" value={{old('username')}}>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Password</label>
                    <div class="col-lg-10">
                        <input type="password" name="password" class="form-control @error('password') border-danger @enderror" placeholder="">
                    </div>
                </div>

                <a href="{{ url('/') }}/auth/forgotpass">Forgot Password</a>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </body>
</html>
