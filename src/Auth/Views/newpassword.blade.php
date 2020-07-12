<!doctype html>
<html>
    <head>
        <title>Reset Password</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h3>Reset Password</h3>
            <form action="/auth/recover" method="POST">
                @csrf
                @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form-group">
                    <label>Password</label>
                        <input type="password" name="password" class="form-control @error('password') border-danger @enderror" placeholder="Password" required="required" value="{{ old('password') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                        <input type="password" name="password" class="form-control @error('password') border-danger @enderror" placeholder="Password" required="required" value="{{ old('password') }}">
                    </div>
                </div>
                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="form-control @error('password') border-danger @enderror" placeholder="Konfirmasi Password" required="required" value="{{ old('password_confirmation') }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </body>
</html>
