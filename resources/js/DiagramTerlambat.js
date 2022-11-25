import Chart from 'chart.js/auto'
const label = rangeTanggal

const data = {
    labels: label,
    datasets: [
        {
            label: 'Keterlambatan',
            backgroundColor: [
                'rgb(240, 80, 110)',
                'rgb(240, 80, 110)',
                'rgb(240, 80, 110)',
                'rgb(240, 80, 110)',
                'rgb(240, 80, 110)',
                'rgb(240, 80, 110)'
            ],
            fill: false,
            borderColor: 'rgb(240, 80, 110)',
            data: dataTerlambat,
            tension: 0.1
        },
    ]
}

const config = {
    type: 'line',
    data: data,
    options: {}
}

new Chart(
    document.getElementById('terlambatChart').getContext('2d'),
    config
)