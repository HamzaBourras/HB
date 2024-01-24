@extends('layouts.layout')

@section('form')
    <div class="mb-[100px] mx-7 relative">
        <form action="{{route('teacher.storeQcm')}}"  method="POST">
            @csrf
            {{-- title --}}
            <div class="mb-5">
                <label for="message" class="block mb-2 font-medium text-gray-900 text-lg">QCM Title</label>
                <input id="message" name="QcmTitle" value="{{ old('QcmTitle') }}" required
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Write your thoughts here...">
            </div>

            {{-- questions and choices --}}
            <div class="border-4 border-black rounded-lg py-2 px-4 flex items-center justify-between flex-wrap mt-9">
                <p class="hidden">{{ $count = 1 }}</p>

                @foreach ($allQuestionsSelected as $questionSelected)
                    <div class="flex flex-col border-4 rounded-md my-2 py-3 px-2 w-[47%]">
                        {{-- question --}}
                        <h1 class="text-lg font-semibold pl-4 my-1">Question {{ $count++ }}
                        </h1>
                        <div class="flex items-center justify-between border-2 rounded-md my-2 py-3 px-3">
                            <p>{{ $questionSelected->text }}</p>
                            <button type="button" id="addChoice" data-question-id="{{$questionSelected->id}}"
                                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5  ">Add
                                choice</button>
                        </div>
                        {{-- choices --}}
                        <div id="choiceDiv" class="flex flex-wrap items-center justify-between border-2 rounded-md my-2 py-3 px-3 hidden">
                            
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- bloc to create a choice --}}
            <div id="bloc"
                class=" absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-white flex flex-col items-center justify-between border-2 rounded-md my-2 py-3 px-3 w-1/3">
                <div class="flex justify-end w-full pr-4"><p id="closebutton" class="border-2 border-red-500 text-red-500 p-3 cursor-pointer w-[20px] h-[20px] flex items-center justify-center rounded-[50%]">X</p></div>
                <div class="mb-6 w-[95%]">
                    <label class="block mb-2 text-sm font-medium text-gray-900 ">choice text</label>
                    <input placeholder="choice ..." type="text" id="choice-text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 ">
                </div>

                <div class="mb-6 w-[95%]">
                    <label class="block mb-2 text-sm font-medium text-gray-900 ">true or false</label>
                    <select id="trueOrFalse"
                        class="cursor-pointer bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option></option>
                        <option value="true">true</option>
                        <option value="false">false</option>
                    </select>
                </div>

                <button id="validButton" type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">valid</button>
            </div>

            <div class="mt-[20px] flex justify-end pr-[30px]">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 ">create QCM</button>
            </div>

        </form>
    </div>
@endsection

@section('scripts')
    @vite('resources/js/qcm.js')
@endsection
