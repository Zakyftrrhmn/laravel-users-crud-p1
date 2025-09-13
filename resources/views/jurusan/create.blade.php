<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table Jurusan</title>
     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="p-10">

    <p class="uppercase font-bold text-xl text-blue-500">Page Add Jurusan</p>

    <form action="{{route('jurusan.store')}}" method="post" enctype="multipart/form-data" class="mt-10 flex flex-col gap-y-5">
        @csrf

        <div class="flex flex-col gap-y-2">
            <label for="nama_jurusan" class="font-semibold text-md uppercase">nama jurusan</label>
            <input type="text" id="nama_jurusan" name="nama_jurusan" class="w-full border-1 rounded-sm border-gray-700 py-2 px-4 focus:ring-blue-500 outline-none focus:border-blue-900 @error('nama_jurusan') border-red-500 text-red-500 @enderror" placeholder="Input your nama_jurusan">

            @error('nama_jurusan') 
                <p class="text-red-500 text-sm mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="flex flex-col gap-y-2">
            <label for="logo_jurusan" class="font-semibold text-md uppercase">Logo jurusan</label>
            <input 
                type="file" 
                id="logo_jurusan" 
                name="logo_jurusan" 
                class="w-full border-1 rounded-sm border-gray-700 py-2 px-4 focus:ring-blue-500 outline-none focus:border-blue-900 cursor-pointer @error('logo_jurusan') border-red-500 text-red-500 @enderror"
            >

            @error('logo_jurusan') 
                <p class="text-red-500 text-sm mt-1">{{$message}}</p>
            @enderror

            <p class="mt-1 text-xs text-gray-500">PNG, JPG, or JPEG (max 2MB)</p>
        </div>

        <div class="flex flex-row gap-x-2">
            <button type="submit" class="bg-blue-200 text-blue-700 px-4 py-2 font-semibold text-md rounded-lg">Submit</button>
            <a href="{{route('jurusan.index')}}" class="bg-gray-200 text-gray-700 px-4 py-2 font-semibold text-md rounded-lg">Kembali</a>
        </div>

        
    </form>


</body>
</html>