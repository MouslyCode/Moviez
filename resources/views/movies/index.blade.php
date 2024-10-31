<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>Movies</title>
</head>

<header class="bg-white shadow-sm">
    <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="hidden lg:flex lg:gap-x-12">
            <a href="/" class="text-sm/6 font-semibold text-gray-900 hover:text-blue-400">Dashboard</a>
            <a href="movie" class="text-sm/6 font-semibold text-gray-900 hover:text-blue-400">Data</a>
        </div>
    </nav>
</header>

<body class="bg-slate-50">
    <div class="mt-6 px-16">
        <a href="{{ route('movies.create')}}"
         class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            + Add Movie
        </a>
    </div>
    <div class="flex flex-col px-16 mt-6">
        <div class="-m-1.5 overflow-x-auto">
            <div class="p-1.5 min-w-full inline-block align-middle">
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">NO</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Movie</th>
                                <th scope="col"
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Genre</th>
                                <th scope="col" 
                                    class="px-6 py-3 text-start text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th scope="col"
                                    class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php $i = 1; ?>
                            @foreach ($movies as $item)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                        {{ $i }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">{{ $item->title }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        {{-- {{ implode(', ', $item['genre_names']->toArray()) }} --}}
                                        @foreach ($item->genres as $genre)
                                            {{ $genre->name }}{{ !$loop->last ? ', ' : '' }}
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        {{ date('d/m/y', strtotime($item->date)) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <a href="{{ route('movies.edit', $item) }}"
                                            class="inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent 
                                        text-blue-600 hover:text-blue-800 focus:outline-none focus:text-blue-800 disabled:opacity-50 
                                        disabled:pointer-events-none">Edit</a>
                                        <form action="{{ route('movies.destroy', $item) }}" method="POST" onsubmit="return confirm('Delete the Data?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="btn btn-danger inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent 
                                        text-red-600 hover:text-red-800 focus:outline-none focus:text-red-800 disabled:opacity-50 
                                        disabled:pointer-events-none">Delete</button>
                                        </form>

                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
