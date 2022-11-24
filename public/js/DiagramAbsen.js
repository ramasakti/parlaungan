import Chart from 'chart.js/auto'
const label = [
    'Sakit',
    'Izin', 
    'Alfa'
]

const data = {
    labels: label,
    datasets: [{
        label: 'My First dataset',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(255, 99, 132)',
        data: [0, 10, 5],
    }]
}

const config = {
    type: 'line',
    data: data,
    options: {}
}

new Chart(
    document.getElementById('myChart').getContext('2d'),
    config
)