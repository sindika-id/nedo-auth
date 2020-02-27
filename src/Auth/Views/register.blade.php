<!doctype html>
<html>
    <head>
        <title>Register</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <h3>Register</h3>
            <form action="/auth/register" method="POST">
                @csrf
                @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                @endif
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Username</label>
                    <div class="col-lg-10">
                        <input type="text" name="username" class="form-control @error('username') border-danger @enderror" value="{{old('username')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Email</label>
                    <div class="col-lg-10">
                        <input type="text" name="email" class="form-control @error('email') border-danger @enderror" value="{{old('email')}}">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-form-label col-lg-2">Captcha</label>
                    <div class="col-lg-10">
                        <div style="margin-bottom: 5px;">
                            <?php echo captcha_img(); ?>
                        </div>
                        <input type="text" name="captcha" class="form-control @error('email') border-danger @enderror">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </body>
</html>
