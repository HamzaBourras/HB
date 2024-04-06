
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Store Course</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    

    <div class="w-1/2 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 border-4 border-black rounded-lg
                py-7 px-5">
        <form action="{{route('login')}}" method="POST" >
        @csrf

            <div class="my-5 space-y-2">
                <label class=" font-semibold" for="">Username</label>
                <div><input value="{{old('username')}}" class="w-full border-2 text-md py-1 px-2 rounded-md" type="text" name="username">
                    @error('username')
                    <p class="text-red-500 my-2">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="my-5 space-y-2">
                <label class=" font-semibold" for="">Password</label>
                <div><input value="{{old('password')}}" class="w-full border-2 text-md py-1 px-2 rounded-md" type="text" name="password">
                    @error('password')
                    <p class="text-red-500 my-2">{{$message}}</p>
                    @enderror
                </div>
            </div>



            <div class="mt-3 flex justify-end pt-5 pr-3">
                <div><input class="bg-blue-500 hover:bg-blue-600 cursor-pointer rounded-md text-white px-4 py-1 text-lg" type="submit" value="login"></div>
            </div>

        </form>
    </div>

</body>
</html>