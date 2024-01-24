@extends('layouts.layout')

@section('content')

<div class="mt-5">
    <h1 class="text-2xl font-semibold py-2 pl-3 mb-5">All Qcms</h1>
    <div class="w-2/3 mx-auto flex justify-between">
        @foreach ($allQcms as $qcm )
        <div class=" border-2 p-3 my-4 rounded-md w-[47%]">
            <p class="text-xl font-bold">{{strtoupper($qcm->title)}}</p>
            <div class="mt-3 mb-1 flex justify-end items-center">
                <button type="button" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">
                    <a href="{{route('student.passQcm',["id"=>$qcm->id])}}">Pass the Qcm</a>
                </button>
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection