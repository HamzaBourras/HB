@extends('layouts.layout')

@section('content')
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-green-200  border-4 border-black rounded-lg py-4 px-4">
        <p class="text-xl "><span>Your result is : </span ><span class="font-bold">{{ $studentScore }}</span></p>
    </div>
@endsection
