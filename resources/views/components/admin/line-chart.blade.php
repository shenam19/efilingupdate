<canvas {{$attributes}}></canvas>
@push('scripts')
<script>
    const {{ $attributes["chartName"] }} = new Chart(
        document.getElementById("{{$attributes['id']}}"),
        {
            type: 'line',
            data: {
                label: "User Logins",
                labels: @json($labels),
                datasets: [{
                    backgroundColor: "{{ $attributes['backgroundColor']}}",
                    borderColor: "{{ $attributes['borderColor']}}",
                    data: @json($chartData),
                }]
            },
        },
    );

    window.addEventListener('reloadChart', event => {
        myChart.data.labels = event.detail.labels;
        myChart.data.datasets[0].data = event.detail.data;
        myChart.update();
    });
</script>
@endpush('scripts')