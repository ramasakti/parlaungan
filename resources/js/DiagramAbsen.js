import Chart from 'chart.js/auto'
const label = [
    'Hadir', //Ijo
    'Terlambat', //Orens
    'Izin', 
    'Sakit', 
    'Alfa' //Red
]

const data = {
    labels: label,
    datasets: [
        {
            label: 'Data Absen',
            backgroundColor: [
                'rgb(50, 210, 150)',
                'rgb(250, 160, 90)',
                'rgb(30, 135, 240)',
                'rgb(255, 243, 140)',
                'rgb(240, 80, 110)'
            ],
            borderColor: [
                'rgb(50, 210, 150)',
                'rgb(250, 160, 90)',
                'rgb(30, 135, 240)',
                'rgb(255, 243, 140)',
                'rgb(240, 80, 110)'
            ],
            data: diagramAbsen
        },
    ]
}

const config = {
    type: 'pie',
    data: data,
    options: {}
}

new Chart(
    document.getElementById('absenChart').getContext('2d'),
    config
)