<div class="flex justify-between items-center py-2 px-3 shadow-lg ">
    <div>
        <h1 class="text-3xl font-bold cursor-pointer" onclick="javascript:history.back()">QCM</h1>
    </div>

    @auth  
    <div>
        <p class="text-2xl">{{Auth::user()->name}}</p>
    </div>
    @endauth
    <div>
        <ul class="flex text-slate-700 space-x-5">

            <li><a href="{{auth()->check() ? ( (Auth::user()->role->name == 'teacher') ? route('teacher.index') : route('student.index')) : route('home') }}">home</a></li>
            @auth
                @if (Auth::user()->role->name == 'teacher')  
                    <li><a href="{{route('teacher.createQuestion')}}">add question</a></li>
                    <li><a href="{{route('teacher.createSelectQuestions')}}">create qcm</a></li>
                    <li><a href="{{route('qcm.showAllQcms')}}">all qcms</a></li>
                @elseif (Auth::user()->role->name == 'student')
                    {{-- <li><a href="">pass qcm</a></li> --}}
                @endif

                <li><a href="{{ route('user.logout') }}">Logout</a></li>
            @endauth

            @guest

                <li><a class="hover:text-black" href="{{ route('user.createLogin') }}">Login</a></li>
                <li><a class="hover:text-black" href="{{ route('user.createRegister') }}">Register</a></li>
            @endguest
        </ul>

    </div>

</div>
