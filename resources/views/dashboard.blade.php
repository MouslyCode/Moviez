<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Dashboard</title>
</head>

<header class="bg-white shadow-sm">
    <nav class="mx-auto flex max-w-7xl items-center justify-between p-6 lg:px-8" aria-label="Global">
        <div class="hidden lg:flex lg:gap-x-12">
            <a href="/" class="text-sm/6 font-semibold text-gray-900 hover:text-blue-400">Dashboard</a>
            <a href="movie" class="text-sm/6 font-semibold text-gray-900 hover:text-blue-400">Data</a>
        </div>
    </nav>
</header>

<body class="bg-slate-50 align-middle">
    <div class="grid grid-cols-3 mx-8">
        <div class="container mt-10 p-6 bg-white rounded shadow-md">
            <h2 class="text-2xl font-bold mb-4">Movie Genre Distribution</h2>
            <canvas id="genrePieChart" class="mx-full h-64 "></canvas>
        </div>
        <div class="container ml-1 mt-10 p-6 bg-white rounded shadow-md col-span-2">
            <h2 class="text-2xl font-bold mb-4">Data Agregation</h2>
            <canvas id="activityBarChart" class="mx-full h-64 "></canvas>
        </div>
    </div>

    <script>
        var labels = @json($labels);
        var data = @json($data);
        const ctxPie = document.getElementById('genrePieChart').getContext('2d');
        const genreChart = new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: [
                        '#f87171', '#fb923c', '#fbbf24', '#facc15',
                        '#a3e635', '#4ade80', '#2dd4bf', '#38bdf8',
                        '#60a5fa', '#818cf8', '#a78bfa', '#e879f9'
                    ]
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'right' }
                }
            }
        });

        var activityLabels = @json($activityDates);
        var totalActivityCounts = @json($totalActivityCounts);
        
        const ctxBar = document.getElementById('activityBarChart').getContext('2d');
        const activityChart = new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: activityLabels,
                datasets: [{
                    label: 'Total Activities',
                    data: totalActivityCounts,
                    backgroundColor: '#3B82F6',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'top' },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                    }
                }
            }
        });
    </script>


</body>

</html>
