<canvas id="{{$attributes['id']}}" id="myChart" width="400" height="200"></canvas>

@push('scripts')
<script>
    
const ctx = document.getElementById("{{$attributes['id']}}");
const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: @json($labels),
        datasets: [{
            label: 'In MB',
            data: @json($chartData),
            backgroundColor:'rgba(54, 162, 54, 0.2)',
            borderColor: 'rgba(55, 132, 99, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

</script>

@endpush