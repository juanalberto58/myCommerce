document.addEventListener('DOMContentLoaded', function() {
    filterData();
});

function filterData() {

    var salesData = {
        labels: salesJson.map(item => item.date),
        datasets: [
            {
                label: 'Total de ventas',
                data: salesJson.map(item => item.total),
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }
        ]
    };
    

    var salesChart = new Chart(document.getElementById('salesChart'), {
        type: 'bar',
        data: salesData,
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
