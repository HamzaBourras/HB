@extends('layouts.layout')

@section('form')
    <form class="w-2/3 m-auto p-4 px-6 border-black border-2 rounded-lg" action="{{route('teacher.storeQuestion')}}" method="post">
        @csrf
        <div class="mb-5">
            <label for="message" class="block mb-2 font-medium text-gray-900 dark:text-white">Your question</label>
            <textarea id="message" rows="4" name="textQuestion" value="{{old('textQuestion')}}"
                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                placeholder="Write your thoughts here..."></textarea>
            @error('textQuestion')
                <p class="mt-4 text-red-500">{{$message}}</p>
            @enderror
        </div>

        <input type="submit" value="Add"
            class="cursor-pointer text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
    </form>
@endsection
