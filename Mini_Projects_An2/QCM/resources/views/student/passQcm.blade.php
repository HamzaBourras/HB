@extends('layouts.layout')

@section('content')
    <div>
        <div class="mt-[25px] mx-3 pl-4 border-4 border-black py-7 rounded-lg">
            <p><span class="text-xl ">Title : </span><span class="text-2xl font-semibold">{{ $qcm->title }}</span></p>

            <div class="w-1/2 mx-auto mt-[20px]">
                <form action="{{ route('student.storeCheckResult') }}" method="POST">
                    @csrf

                    <p class="hidden">{{ $count = 1 }}</p>
                    @foreach ($qcm->questions as $question)
                        <div class="border-2 rounded-lg py-3 px-2 my-3">
                            <p><span class="font-semibold text-lg">Question N° {{ $count++ }} : </span>
                                {{ $question->text }}</p>
                            <div>
                                <p class="hidden">{{ $count2 = 1 }}</p>
                                @foreach ($question->choixes as $choix)
                                    <div class="bg-slate-100 my-2 py-4 px-5 rounded-md flex justify-between items-center">
                                        <p> {{ $choix->text }}</p>
                                        <input type="checkbox" name="studentAnswers[]" value="{{$choix->text}}" class="w-[15px] h-[15px] cursor-pointer">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                    <div class="mt-7 flex justify-end">
                        <input type="submit" value="See results"
                            class="cursor-pointer text-green-700 hover:text-white border border-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
