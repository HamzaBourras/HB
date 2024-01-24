@extends('layouts.layout')

@section('content')
<div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex items-center justify-around w-2/3">
    
    <div class="py-4 px-4 border-4 rounded-lg w-[48%] flex flex-col items-center justify-center">
        <h1 class="text-2xl font-semibold">Techear Space</h1>
        <p class="w-2/3 text-center mt-4">In this space you can add questions and create qcms</p>
        <div class="mt-4">
            <button type="button" class="text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2 text-center  dark:border-yellow-300 dark:text-yellow-300"><a href="{{route('user.createLogin')}}">see more</a></button>
        </div>
    </div>
    <div class="py-4 px-4 border-4 rounded-lg w-[48%] flex flex-col items-center justify-center">
        <h1 class="text-2xl font-semibold">Student Space</h1>
        <p class="w-2/3 text-center mt-4">In this space you can pass the qcm and view your result</p>
        <div class="mt-4">
            <button type="button" class="text-yellow-400 hover:text-white border border-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-4 py-2 text-center  dark:border-yellow-300 dark:text-yellow-300"><a href="{{route('user.createLogin')}}">see more</a></button>
        </div>
    </div>
</div>

@endsection