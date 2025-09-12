<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table User</title>
     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="p-10">

    <p class="uppercase font-bold text-xl text-blue-500">Page Edit User</p>

    <form action="{{route('user.update', $user->id)}}" method="post" enctype="multipart/form-data" class="mt-10 flex flex-col gap-y-5">
        @csrf
        @method('PUT')

        <div class="flex flex-col gap-y-2">
            <label for="name" class="font-semibold text-md uppercase">name</label>
            <input type="text" id="name" name="name" class="w-full border-1 rounded-sm border-gray-700 py-2 px-4 focus:ring-blue-500 outline-none focus:border-blue-900 @error('name') border-red-500 text-red-500 @enderror" placeholder="Input your name" value="{{ $user->name }}" required>

            @error('name') 
                <p class="text-red-500 text-sm mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="flex flex-col gap-y-2">
            <label for="email" class="font-semibold text-md uppercase">email</label>
            <input type="email" id="email" name="email" class="w-full border-1 rounded-sm border-gray-700 py-2 px-4 focus:ring-blue-500 outline-none focus:border-blue-900 @error('email') border-red-500 text-red-500 @enderror" placeholder="Input your email" value="{{ $user->email }}" required> 

            @error('email') 
                <p class="text-red-500 text-sm mt-1">{{$message}}</p>
            @enderror

        </div>

        <div class="flex flex-col gap-y-2">
            <label for="password" class="font-semibold text-md uppercase">password
                <span class="text-sm text-gray-500">(Abaikan Jika tidak ingin diubah)</span>
            </label>
            <input type="password" id="password" name="password" class="w-full border-1 rounded-sm border-gray-700 py-2 px-4 focus:ring-blue-500 outline-none focus:border-blue-900 @error('password') border-red-500 text-red-500 @enderror" placeholder="Input your password">

            @error('password') 
                <p class="text-red-500 text-sm mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="flex flex-col gap-y-2">
            <label for="photo" class="font-semibold text-md uppercase">Photo                 
                <span class="text-sm text-gray-500">(Abaikan Jika tidak ingin diubah)</span>
            </label>
            <input 
                type="file" 
                id="photo" 
                name="photo" 
                class="w-full border-1 rounded-sm border-gray-700 py-2 px-4 focus:ring-blue-500 outline-none focus:border-blue-900 cursor-pointer @error('photo') border-red-500 text-red-500 @enderror"
            >

            @error('photo') 
                <p class="text-red-500 text-sm mt-1">{{$message}}</p>
            @enderror

            <p class="mt-1 text-xs text-gray-500">PNG, JPG, or JPEG (max 2MB)</p>
        </div>

        <div class="flex flex-row gap-x-2">
            <button type="submit" class="bg-blue-200 text-blue-700 px-4 py-2 font-semibold text-md rounded-lg">Submit</button>
            <a href="{{route('user.index')}}" class="bg-gray-200 text-gray-700 px-4 py-2 font-semibold text-md rounded-lg">Kembali</a>
        </div>

        
    </form>


</body>
</html>