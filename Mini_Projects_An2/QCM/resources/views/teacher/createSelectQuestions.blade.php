@extends('layouts.layout')

@section('form')
    <div>
        <h1 class="text-2xl font-semibold py-2 pl-3 mb-5">Select the questions to create QCM</h1>
        <div class="border-4 border-black rounded-lg py-2 px-4 w-2/3 mx-auto ">

            <form action="{{ route('teacher.storeSelectQuestions') }}" method="post">
                @csrf
                <div class=" flex flex-col items-center justify-center py-4">
                    @foreach ($allQuestions as $question)
                        <div class="flex items-center justify-around my-2 py-1 w-[90%]">
                            <p class=" w-3/4">{{ $question->text }}</p>
                            <p class=" w-[20px] flex items-center justify-center"><input
                                    class="cursor-pointer w-[15px] h-[15px]" name="SelectQuestions[]"
                                    value="{{ $question->id }}" type="checkbox"></p>
                        </div>
                    @endforeach
                </div>

                <div>
                    @error('SelectQuestions')
                        <p class="mt-4 pl-5 text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-5 flex justify-end items-center">
                    <input
                        class="cursor-pointer focus:outline-none text-white bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:focus:ring-yellow-900"
                        type="submit" value="following">
                </div>
            </form>
        </div>
    </div>
@endsection
