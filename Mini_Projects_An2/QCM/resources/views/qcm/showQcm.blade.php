@extends('layouts.layout')

@section('content')
    <div>
        <div class="mt-[25px] ml-3 pl-4 border-4 border-black py-7 rounded-lg">
            <p><span class="text-xl ">Title : </span><span class="text-2xl font-semibold">{{ $qcm->title }}</span></p>

            <div class="w-2/3 mx-auto mt-[20px]">
                <p class="hidden">{{ $count = 1 }}</p>
                @foreach ($qcm->questions as $question)
                    <div class="border-2 rounded-lg py-3 px-2 my-3">
                        <p><span class="font-semibold text-lg">Question N° {{ $count++ }} : </span> {{ $question->text }}</p>
                        <div>
                            <p class="hidden">{{ $count2 = 1 }}</p>
                            @foreach ($question->choixes as $choix)
                                <div class="bg-slate-100 my-2 py-4 px-5 rounded-md flex justify-between items-center">
                                    <p><span class="font-semibold">Choice N° {{ $count2++ }} : </span> {{$choix->text}}</p>
                                    <p>{{$choix->tr_fl == 1 ? "true" : "false"}}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
