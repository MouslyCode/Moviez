<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Create</title>
</head>
<body class="bg-center class="bg-slate-50"">
    <div class="container mx-48 my-14">
        <h1 class="text-2xl font-bold text-left">Add Movie</h1>
        <form action="{{ route('movies.store') }}" method="POST" class="mt-4 content-center">
            @csrf
            <div>
                <label for="title" class="block">Title</label>
                <div class="max-w-sm space-y-3 mt-2">
                    <input name="title" type="text" class="py-3 px-4 w-full bg-slate-100 border-gray-600 rounded-lg text-sm focus:border-blue-500 
                    focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none" value="{{ old('title') }}" placeholder="Title">
                  </div>
            </div>
            <div class="mt-4">
                <label for="genres" class="block">Genres</label>
                <div  class="h-56 grid grid-cols-4 gap-x-0 gap-y-1 mt-4 mr-56">
                    @foreach($genres as $genre)
                    {{-- <option value="{{ $genre->id }}">{{ $genre->name }}</option> --}}
                    <div class="flex items-center mb-2">
                        <input id="genre_{{ $genre->id }}" 
                        {{ in_array($genre->id, old('genres', [])) ? 'checked' : '' }}
                        type="checkbox" name="genres[]" value="{{ $genre->id }}" 
                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 
                        dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="genre_{{ $genre->id }}" class="ms-2 text-sm font-medium text-gray-900">{{ $genre->name }}</label>
                    </div>
                    @endforeach
                </div>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-8">Add Movie</button>
        </form>
    </div>
    
</body>
</html>