@extends('admin.dashboard')
@section('subcontent')

        <div class="flex flex-col items-center gap-4 mt-5 md:justify-around md:gap-0 md:flex-row">
            <div class="w-full p-6 rounded bg-emerald-300 md:w-auto">
                <span class="flex items-center justify-center gap-2 text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                            d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z"
                            clip-rule="evenodd" />
                        <path
                            d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                    </svg>

                    {{ $users->count() }} Usuários
                </span>
            </div>
            <div class="w-full p-6 bg-blue-300 rounded md:w-auto">
                <span class="flex items-center justify-center gap-2 text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                            d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                            clip-rule="evenodd" />
                    </svg>
                    {{ $posts->count() }} Postagens
                </span>
            </div>
            <div class="w-full p-6 bg-red-300 rounded md:w-auto">
                <span class="flex items-center justify-center gap-2 text-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path
                            d="M11.644 1.59a.75.75 0 0 1 .712 0l9.75 5.25a.75.75 0 0 1 0 1.32l-9.75 5.25a.75.75 0 0 1-.712 0l-9.75-5.25a.75.75 0 0 1 0-1.32l9.75-5.25Z" />
                        <path
                            d="m3.265 10.602 7.668 4.129a2.25 2.25 0 0 0 2.134 0l7.668-4.13 1.37.739a.75.75 0 0 1 0 1.32l-9.75 5.25a.75.75 0 0 1-.71 0l-9.75-5.25a.75.75 0 0 1 0-1.32l1.37-.738Z" />
                        <path
                            d="m10.933 19.231-7.668-4.13-1.37.739a.75.75 0 0 0 0 1.32l9.75 5.25c.221.12.489.12.71 0l9.75-5.25a.75.75 0 0 0 0-1.32l-1.37-.738-7.668 4.13a2.25 2.25 0 0 1-2.134-.001Z" />
                    </svg>

                    {{ $projects->count() }} Projetos
                </span>
            </div>
        </div>
        <div class="grid grid-cols-3 gap-8 mt-8 md:gap-4">
            <div class="col-span-3 md:col-span-1">
                <canvas id="usersChart"></canvas>
            </div>
            <div class="col-span-3 md:col-span-1">
                <canvas id="postsChart"></canvas>
            </div>
            <div class="col-span-3 md:col-span-1">
                <canvas id="projectsChart"></canvas>
            </div>
        </div>
<script>
    var usersChart = document.getElementById('usersChart').getContext('2d');
    var postsChart = document.getElementById('postsChart').getContext('2d');
    var projectsChart = document.getElementById('projectsChart').getContext('2d');
    var myChart = new Chart(usersChart, {
        type: 'bar',
        data: {
            labels: [{{ $userYear }}],
            datasets: [{
                label: 'Usuários criados por ano',
                data: [{{ $userTotal }}],
                borderWidth: 1,
                backgroundColor: 'lightgreen'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                },
            },
        },
    });

    var myChart = new Chart(postsChart, {
        type: 'bar',
        data: {
            labels: [{{ $postsYear }}],
            datasets: [{
                label: 'Postagens criados por ano',
                data: [{{ $postsTotal }}],
                borderWidth: 1,
                backgroundColor: 'lightblue'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                },
            },
        },
    });

    var myChart = new Chart(projectsChart, {
        type: 'bar',
        data: {
            labels: [{{ $projectsYear }}],
            datasets: [{
                label: 'Projetos criados por ano',
                data: [{{ $projectsTotal }}],
                borderWidth: 1,
                backgroundColor: 'pink'
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                },
            },
        },
    });
</script>

@endsection
