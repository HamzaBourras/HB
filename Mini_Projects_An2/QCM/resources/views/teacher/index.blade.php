@extends('layouts.layout')

@section('content')
    <div class="mx-auto mt-6">
        <h1 class="text-2xl font-semibold py-2 pl-3 mb-5">All Questions </h1>
        <div class="w-2/3 mx-auto border-2 rounded-xl py-3 px-5  border-black">
            @foreach ($questions as $question)
                <div class="border-2 border-black rounded-lg py-5 px-3 my-2 flex items-center justify-between">
                    <p>{{ $question->text }}</p>
                    {{-- <div>
                        <button class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm  sm:w-auto px-5 py-2.5 text-center ">delete</button>
                        <button class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm  sm:w-auto px-5 py-2.5 text-center ">edit</button>
                    </div> --}}
                </div>
            @endforeach
        </div>
    </div>
@endsection
