
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
        <form action="{{route('professor.course.storeCourse')}}" method="POST" enctype="multipart/form-data">
        @csrf

            <div class="my-5 space-y-2">
                <label class=" font-semibold" for="">Course Title</label>
                <div><input value="{{old('name')}}" class="w-full border-2 text-md py-1 px-2 rounded-md" type="text" name="name">
                    @error('name')
                    <p class="text-red-500 my-2">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div class="my-5 space-y-2">
                <label class=" font-semibold" for="">Sector</label>
                <div>
                    <select value="{{old('sector')}}" class="w-full border-2 text-md py-1 px-2 rounded-md" name="sectors" id="">
                        <option value=""></option>
                        <option value="GI">GI</option>
                        <option value="IDSD">IDSD</option>
                        <option value="TM">TM</option>
                    </select>
                    @error('sectors')
                    <p class="text-red-500 my-2">{{$message}}</p>
                    @enderror

                </div>
            </div>

            <div class="my-5 space-y-2">
                <label class=" font-semibold" for="">Department</label>
                <div>
                    <select value="{{old('sector')}}" class="w-full border-2 text-md py-1 px-2 rounded-md" name="department" id="">
                        <option value=""></option>
                        <option value="GI">Math->info</option>
                    </select>
                    @error('department')
                    <p class="text-red-500 my-2">{{$message}}</p>
                    @enderror

                </div>
            </div>

            <div class="my-5 space-y-2">
                <label class=" font-semibold" for="">Email</label>
                <div><textarea value="{{old('email')}}" class="w-full border-2 text-md py-1 px-2 rounded-md" type="text" name="email"></textarea>
                    @error('email')
                    <p class="text-red-500 my-2">{{$message}}</p>
                    @enderror
                </div>
            </div>



            <div class="mt-3 flex justify-end pt-5 pr-3">
                <div><input class="bg-blue-500 hover:bg-blue-600 cursor-pointer rounded-md text-white px-4 py-1 text-lg" type="submit" value="store"></div>
            </div>

        </form>
    </div>

</body>
</html>