<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    @if (session('success'))
        {{ session('success') }}
    @endif

@error('email')
        <div class="text-red-600 text-sm">{{ $message }}</div>
    @enderror

    <form action="{{ route('loginProses') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="">Email</label>
            <input type="text" name="email" id="email" placeholder="input your email">
        </div>

        
        <div>
            <label for="">password</label>
            <input type="password" name="password" id="password" placeholder="input your password">
        </div>

        
        <div>
            <button type="submit">Login</button>
            <a href="{{route('register')}}">register</a>
        </div>

    </form>
</body>
</html>