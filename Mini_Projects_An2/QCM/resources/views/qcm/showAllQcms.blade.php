@extends('layouts.layout')

@section('content')

<div class="mt-5">
    <h1 class="text-2xl font-semibold py-2 pl-3 mb-5">All Qcms</h1>
    <div class="w-2/3 mx-auto flex justify-between">
        @foreach ($allQcms as $qcm )
        <div class=" border-2 p-3 my-4 rounded-md w-[47%]">
            <p class="text-xl font-bold">{{strtoupper($qcm->title)}}</p>
            <div class="mt-3 mb-1 flex justify-end items-center">
                <button type="button" class="cursor-pointer focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-2 focus:ring-green-300 font-medium rounded-lg text-sm px-3 py-2 ">
                    <a href="{{route('qcm.showQcm',["id"=>$qcm->id])}}">show more</a>
                </button>
            </div>
        </div>
    @endforeach
    </div>
</div>
@endsection