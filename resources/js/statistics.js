document.addEventListener('DOMContentLoaded', function() {

    document.getElementById('filterButton').addEventListener('click', function () {
        generaInforme();
        creaGrafica();

    });
    document.getElementById('downloadButton').addEventListener('click', function () {
        generaInformePDF();
    });
});

//Funcion para generar la grafica de pedidos por dia
function creaGrafica() {
    var fechaInicio = document.getElementById('fechaInicio').value;
    var fechaFin = document.getElementById('fechaFin').value;

    // Objeto para almacenar los totales agrupados por día
    var groupedSales = {};

    salesJson.forEach(function (dato) {
        var fechaVenta = new Date(dato.date);
        if (fechaVenta >= new Date(fechaInicio) && fechaVenta <= new Date(fechaFin)) {
            var fechaKey = dato.date.split('T')[0];
            if (groupedSales[fechaKey]) {
                groupedSales[fechaKey].total += parseFloat(dato.total);
            } else {
                groupedSales[fechaKey] = {
                    date: fechaKey,
                    total: parseFloat(dato.total),
                };
            }
        }
    });

    var labels = Object.keys(groupedSales);
    var totalData = labels.map(function (date) {
        return groupedSales[date].total.toFixed(2);
    });


    var salesData = {
        labels: labels,
        datasets: [
            {
                label: 'Total de ventas',
                data: totalData,
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

// Funcion para generar el informe de ventas en funcion del rango de fechas seleccionado
function generaInforme() {
    var fechaInicio = document.getElementById('fechaInicio').value;
    var fechaFin = document.getElementById('fechaFin').value;
    var salesTableBody = document.getElementById('salesTableContainer');

    salesTableBody.innerHTML = '';

    var sales = {};

    //Agrupamos los pedidos por dia
    salesJson.forEach(function(dato) {
        var fechaVenta = new Date(dato.date);
        if (fechaVenta >= new Date(fechaInicio) && fechaVenta <= new Date(fechaFin)) {
            if (sales[dato.date]) {
                sales[dato.date].total += parseFloat(dato.total);
                sales[dato.date].margin += parseFloat(dato.margin);
            } else {
                sales[dato.date] = {
                    date: dato.date,
                    total: parseFloat(dato.total),
                    margin: parseFloat(dato.margin)
                };
            }
        }
    });

    var products = {};

    //Agrupamos los productos por dia y cantidad
    salesLinesJson.forEach(function(dato) {
        var fechaPedido = new Date(dato.created_at);
        var fechaKey = fechaPedido.toISOString().split('T')[0];
        if (fechaPedido >= new Date(fechaInicio) && fechaPedido <= new Date(fechaFin)) {
            var productKey = dato.product_id + '_' + fechaKey;
            if (products[productKey]) {
                products[productKey].quantity += parseInt(dato.quantity);
            } else {
                products[productKey] = {
                    created_at: fechaKey,
                    product_id: dato.product_id,
                    quantity: parseInt(dato.quantity)
                };
            }
        }
    });

    // Creamos la tabla de ventas
    for (var date in sales) {
        if (sales.hasOwnProperty(date)) {
            var row = document.createElement('tr');
            row.innerHTML = `
                <td>${sales[date].date}</td>
                <td>${sales[date].total.toFixed(2)}</td>
                <td>${sales[date].margin.toFixed(2)}</td>
            `;
            salesTableBody.appendChild(row);
        }
    }

    // Creamos la tabla de productos
    var productsTableBody = document.getElementById('productsTableContainer');
    productsTableBody.innerHTML = '';
    for (var key in products) {
        if (products.hasOwnProperty(key)) {
            var productRow = products[key];
            console.log(productRow);
            var product = productsJson.find(function(prod) {
                return prod.id === productRow.product_id;
            });
            var row = document.createElement('tr');
            row.innerHTML = `
                <td>${productRow.created_at}</td>
                <td>${product ? product.name : 'Desconocido'}</td>
                <td>${productRow.quantity}</td>
            `;
            productsTableBody.appendChild(row);
        }
    }

    document.getElementById('downloadButton').style.display = 'initial';
}

// Funcion para generar un pdf con los datos de las tablas previamente generados
function generaInformePDF() {
    // Obtenemos los datos de las tablas ya generadas
    var salesTableData = [['Fecha', 'Total Facturación', 'Margen']];
    var salesTableRows = document.querySelectorAll('#salesTableContainer tr');
    salesTableRows.forEach(function (row) {
        var cells = row.querySelectorAll('td');
        if (cells.length === 3) {
            salesTableData.push([cells[0].textContent, cells[1].textContent, cells[2].textContent]);
        }
    });

    var productsTableData = [['Fecha', 'Producto', 'Cantidad Vendida']];
    var productsTableRows = document.querySelectorAll('#productsTableContainer tr');
    productsTableRows.forEach(function (row) {
        var cells = row.querySelectorAll('td');
        if (cells.length === 3) {
            productsTableData.push([cells[0].textContent, cells[1].textContent, cells[2].textContent]);
        }
    });

    // Añadimos los datos al pdf
    var docDefinition = {
        content: [
            { text: 'Informe de Ventas', style: 'header' },
            ' ',
            { text: 'Tabla de Ventas', style: 'subheader' },
            {
                table: {
                    headerRows: 1,
                    body: salesTableData
                }
            },
            ' ',
            { text: 'Productos Vendidos', style: 'subheader' },
            {
                table: {
                    headerRows: 1,
                    body: productsTableData
                }
            }
        ],
        styles: {
            header: {
                fontSize: 18,
                bold: true
            },
            subheader: {
                fontSize: 16,
                bold: true,
                margin: [0, 10, 0, 5]
            }
        }
    };

    // Generamos el pdf y lo descargamos
    pdfMake.createPdf(docDefinition).download('informe.pdf');
}