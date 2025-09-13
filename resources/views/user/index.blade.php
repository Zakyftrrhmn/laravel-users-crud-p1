<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Table User</title>
     @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="p-2">

    @if(session('success'))
        <div class="w-full px-6 py-3 text-green-700 bg-green-200 rounded-md">
                    <span class="">{{ session('success') }}</span>
        </div>
    @endif

    <br>
    <br>
    <a href="{{route('user.create')}}" class="py-3 px-6 bg-blue-200 text-blue-800 rounded-full font-bold text-md uppercase">+ Add User</a>

    <table class="w-full text-sm text-left text-gray-500 mt-20">
        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
            <tr>
                <th scope="col" class="px-6 py-3 text-center">
                    No
                </th>              
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Jurusan
                </th>
                <th scope="col" class="px-6 py-3">
                    Photo
                </th>
                <th scope="col" class="px-6 py-3 text-center">
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr class="bg-white border-b border-gray-200">
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap text-center">
                    {{$loop->iteration}}
                </th>
                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                    {{$user->name}}
                </th>
                <td class="px-6 py-4">
                    {{$user->email}}
                </td>
                <td class="px-6 py-4">
                    {{ $user->jurusan->nama_jurusan }}
                </td>
                <td class="px-6 py-4">
                    <img src="{{ asset('storage/'. $user->photo) }}" class="w-10 h-10 rounded-full object-fill" alt="">
                </td>
                <td class="px-6 py-4 ">
                    <div class="flex flex-row gap-x-2 items-center justify-center">
                        <a href="{{route('user.edit', $user->id)}}" class="py-2 px-4 bg-yellow-200 text-yellow-700 rounded-full text-sm font-mediumcursor-pointer ">Edit</a>

                        <form action="{{ route('user.destroy', $user->id) }}" method="post" onclick="return confirm('Are you sure want to delete this data?')">
                            @csrf
                            @method('DELETE')

                        <button type="submit" class="cursor-pointer py-2 px-4 bg-red-200 text-red-700 rounded-full text-sm font-medium">Hapus</button>

                        </form>

                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>