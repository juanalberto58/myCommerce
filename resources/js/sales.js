// Arreglo para almacenar las líneas de pedido agregadas
var lineasPedido = [];

//Evento para los botones y las acciones de la vista de inicio
document.addEventListener('DOMContentLoaded', function() {

    const filtrarVentas = document.getElementById('filtrarVentas');
    const limpiarFiltro = document.getElementById('limpiarFiltro');
    cargarClientes(contactsData, 'cliente');

    filtrarVentas.addEventListener('click', function() {
        realizarFiltrado();
    });

    limpiarFiltro.addEventListener('click', function() {
        cargarVentas(); 
        limpiarCamposFiltro(); 
    });

    cargarVentas();
});

//Evento para los botones y las acciones de la vista de creacion de pedidos
document.addEventListener('DOMContentLoaded', function() {
    const addButtonSale = document.getElementById('addButtonSale');
    const createSaleOrder = document.getElementById('createSaleOrder');

    addButtonSale.addEventListener('click', function() {
        agregarLineaPedidoVenta();
    });

    createSaleOrder.addEventListener('click', function() {
        crearPedidoVenta();
    });
    cargarClientes(contactsData, 'contact_id');
    cargarProductos(productsData, 'product_id');
});

//Evento para mostrar un pedido de venta concreto
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('sale-link')) {
        event.preventDefault();
        var saleId = event.target.getAttribute('data-id');
        window.location.href = `/sales/${saleId}`;
    }

});

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('downloadButtonInvoice').addEventListener('click', function () {
        generarFacturaPDF();
    });
});




//Evento para el boton de eliminar una linea de pedido
document.addEventListener('DOMContentLoaded', function() {
    const deleteSaleButton = document.getElementById('deleteSaleButton');

    deleteSaleButton.addEventListener('click', function(event) {
        event.preventDefault();
        var saleId = event.target.getAttribute('data-id');
        eliminarPedidoVenta(saleId);
    });
});

// Función para agregar una línea de pedido
function agregarLineaPedidoVenta() {
    var product_id = document.getElementById('product_id').value;
    var quantity = document.getElementById('quantity').value;
    var tax_base = document.getElementById('tax_base').value;
    var tax = document.getElementById('tax').value;
    var salePrice = document.getElementById('salePrice').value;
    var margin = parseFloat(salePrice) - (parseFloat(quantity) * parseFloat(tax_base) * (1 + parseFloat(tax) / 100));

    // Validar que los campos no estén vacíos
    if (quantity.trim() === '') {
        alert('Por favor, complete todos los campos.');
        return;
    }

    // Agregar la línea de pedido al arreglo
    lineasPedido.push({
        product_id: product_id,
        quantity: quantity,
        tax_base: tax_base,
        tax: tax,
        salePrice: salePrice,
        margin: margin.toFixed(2)
    });

    // Limpiar los campos del formulario
    document.getElementById('product_id').value = '';
    document.getElementById('quantity').value = '';
    document.getElementById('tax_base').value = '';
    document.getElementById('tax').value = '';
    document.getElementById('salePrice').value = '';

    // Actualizar la tabla con las líneas de pedido agregadas
    actualizarTablaLineasPedido();
}

// Función para actualizar la tabla de lineas de pedido al agregar lineas de pedido
function actualizarTablaLineasPedido() {
    var tablaBody = document.getElementById('lineasPedidoTableBody');
    tablaBody.innerHTML = '';

    lineasPedido.forEach(function(linea, index) {
        console.log(linea);
        var row = document.createElement('tr');
        var productCell = document.createElement('td');
        var quantityCell = document.createElement('td');
        var tax_baseCell = document.createElement('td');
        var taxCell = document.createElement('td');
        var totalCell = document.createElement('td'); 
        var salePriceCell = document.createElement('td'); 
        var deleteCell = document.createElement('td');
        var marginCell = document.createElement('td');

        // Mostramos nombre de producto en vez de la id
        var producto = productsData.find(function(product) {
            return product.id == linea.product_id;
        });

        if (producto){
            productCell.innerText = producto.name;
        }else{
            productCell.innerText = 'Producto no encontrado';
        }

        quantityCell.innerText = linea.quantity;
        tax_baseCell.innerText = linea.tax_base;
        taxCell.innerText = linea.tax;
        salePriceCell.innerText = linea.salePrice;
        marginCell.innerText = linea.margin;

        // Calcular el total basado en el precio de coste, cantidad y porcentaje de IVA
        var total = parseFloat(linea.quantity) * parseFloat(linea.tax_base) * (1 + parseFloat(linea.tax) / 100);
        totalCell.innerText = total.toFixed(2);

        // Calcular el margen como precio de venta menos el total
        var margin = parseFloat(linea.salePrice) - total;
        marginCell.innerText = margin.toFixed(2);

        var deleteButton = document.createElement('button');
        deleteButton.innerText = 'Eliminar';
        deleteButton.classList.add('btn', 'btn-danger');
        deleteButton.addEventListener('click', function() {
            eliminarLineaPedido(index);
        });

        deleteCell.appendChild(deleteButton);

        row.appendChild(deleteCell);
        row.appendChild(productCell);
        row.appendChild(quantityCell);
        row.appendChild(tax_baseCell);
        row.appendChild(taxCell);
        row.appendChild(totalCell); 
        row.appendChild(salePriceCell); 
        row.appendChild(marginCell);
        tablaBody.appendChild(row);
    });
}

// Función para obtener la fecha actual
function obtenerFechaActual() {
    var fecha = new Date();
    var dia = fecha.getDate();
    var mes = fecha.getMonth() + 1; 
    var año = fecha.getFullYear();
    
    // Formatear la fecha en el formato deseado (YYYY-MM-DD)
    var fechaFormateada = año + '-' + (mes < 10 ? '0' : '') + mes + '-' + (dia < 10 ? '0' : '') + dia;
    
    return fechaFormateada;
}

// Función para eliminar una línea de pedido
function eliminarLineaPedido(index) {
    lineasPedido.splice(index, 1);
    actualizarTablaLineasPedido();
}

// Función para mostrar el listado de los pedidos de venta
function cargarVentas() {
    var ventasTableBody = document.getElementById('ventas-table-body');
    ventasTableBody.innerHTML = '';
    console.log(sales);
    sales.forEach(function(dato) {
        var row = document.createElement('tr');
        var contacto = contactsData.find(function(contact) {
            return contact.id === dato.contact_id;
        });
        row.innerHTML = `
            <td><a class="sale-link" data-id="${dato.id}" href="#">${dato.id}</a></td>
            <td>${contacto ? contacto.name : 'Desconocido'}</td>
            <td>${dato.date}</td>
            <td>${dato.tax_base}</td>
            <td>${dato.tax}</td>
            <td>${dato.total}</td>
            <td>${dato.margin}</td>
        </tr>
    `;
        ventasTableBody.appendChild(row);
    });
    var saleLinks = document.querySelectorAll('.sale-link');
    saleLinks.forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault(); 

        var saleId = link.getAttribute('data-id');
        mostrarDetallesPedido(saleId);
    });
});
}

// Funcion para mostrar los detalles de un pedido
function mostrarDetallesPedido(saleId) {
    $.ajax({
        type: 'GET',
        url: `/sales/${saleId}`,
        success: function(data) {
            console.log(data);
        },
        error: function() {
            alert('Hubo un error al obtener los detalles del pedido.');
        }
    });
}

// Función para crear un pedido de venta
function crearPedidoVenta() {
    // Verificar si hay líneas de pedido para guardar
    if (lineasPedido.length === 0) {
        alert("No hay líneas de pedido para guardar.");
        return;
    }

    // Calcular el total, tax_base y tax
    var taxBase = 0;
    var tax = 0;
    var totalPedido = 0;
    var margin = 0;
    var salePrice = 0;

    lineasPedido.forEach(function(linea) {

        taxBase += parseFloat(linea.tax_base);
        salePrice += parseFloat(linea.salePrice);
        tax = parseFloat(linea.tax);

        var subtotal = parseFloat(linea.quantity) * parseFloat(linea.tax_base);
        var ivaAmount = (subtotal * (parseFloat(linea.tax) / 100));
        var totalLinea = subtotal + ivaAmount;
        linea.total = totalLinea; 
        totalPedido += totalLinea;
    });

    margin = parseFloat(salePrice) - parseFloat(totalPedido);

    var contact_id = document.getElementById('contact_id').value;

     // Crear un objeto con los datos del pedido
     var pedidoData = {
        date: obtenerFechaActual(),
        contact_id: contact_id,
        user_id: authenticatedUserId,
        tax_base: taxBase,
        tax: tax,
        total: salePrice,
        margin: margin,
        lineasPedido: lineasPedido
    };

    // Enviar los datos al servidor utilizando AJAX con jQuery
    $.ajax({
        type: "POST",
        url: "/sales/store", 
        data: JSON.stringify(pedidoData),
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content') 
        },
        dataType: "json",
        success: function(data) {
            if (data.success) {
                alert("Pedido de venta creado exitosamente.");
                window.location.href = '/sales';
            } else {
                alert("Hubo un error al crear el pedido de venta. Por favor, intenta nuevamente.");
            }
        },
        error: function() {
            alert("Hubo un error al comunicarse con el servidor. Por favor, intenta nuevamente.");
        }
    });
}

// Función para filtrar los pedidos de venta
function realizarFiltrado() {
    var fecha = document.getElementById('fecha').value;
    var clienteId = parseInt(document.getElementById('cliente').value);

    var resultadosFiltrados = sales.filter(function(sale) {
        var fechaFiltrar = !fecha || sale.date === fecha;
        var clienteFiltrar = isNaN(clienteId) || sale.contact_id === clienteId;

        // Si no se selecciona proveedor ni fecha, mostrar todos los resultados
        if (isNaN(clienteId) && fechaFiltrar) {
            return true;
        }

        // Filtrar por proveedor y fecha si se seleccionan ambos
        return fechaFiltrar && clienteFiltrar;
    });

    actualizarTabla(resultadosFiltrados);
}

// Función para actualizar la tabla de los pedidos de venta
function actualizarTabla(resultados) {
    var tbody = document.getElementById('ventas-table-body');
    tbody.innerHTML = '';

    resultados.forEach(function(sale) {
        var row = document.createElement('tr');
        var contacto = contactsData.find(function(contact) {
            return contact.id === sale.contact_id;
        });
        row.innerHTML = `
            <td><a class="sale-link" data-id="${sale.id}" href="#">${sale.id}</a></td>
            <td>${contacto ? contacto.name : 'Desconocido'}</td>
            <td>${sale.date}</td>
            <td>${sale.tax_base}</td>
            <td>${sale.tax}</td>
            <td>${sale.total}</td>
            <td>${sale.margin}</td>
        `;
        tbody.appendChild(row);
    });
}

// Función para limpiar los campos de filtro
function limpiarCamposFiltro() {
    document.getElementById('fecha').value = '';
    document.getElementById('proveedor').value = '';
}

// Función para eliminar un pedido de venta.
function eliminarPedidoVenta(saleId) {
    if (confirm("¿Estás seguro de que deseas eliminar este pedido de venta y todas sus líneas de pedido?")) {
        $.ajax({
            type: 'DELETE',
            url: '/sales/' + saleId,
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data);
                if (data.success) {
                    alert("Pedido de venta eliminado exitosamente.");
                    window.location.href = '/sales';
                } else {
                    alert("Hubo un error al eliminar el pedido de venta. Por favor, intenta nuevamente.");
                }
            },
            error: function() {
                alert("Hubo un error al comunicarse con el servidor. Por favor, intenta nuevamente.");
            }
        });
    }
}

// Función para cargar todos los clientes en el select
function cargarClientes(contacts, select) {
    var clienteSelect = document.getElementById(select);
    
    var clientes = contacts.filter(function(contact) {
        return contact.type === 'cliente';
    });

    clientes.forEach(function(cliente) {
        var option = document.createElement('option');
        option.value = cliente.id;
        option.textContent = cliente.name;
        clienteSelect.appendChild(option);
    });

    $(clienteSelect).select2({
        placeholder: 'Seleccionar cliente',
        allowClear: true,
        theme: 'bootstrap'
    });
}

// Función para cargar todos los proveedores en el select
function cargarProductos(products, select) {
    var productosSelect = document.getElementById(select);

    products.forEach(function(producto) {
        var option = document.createElement('option');
        option.value = producto.id;
        option.textContent = producto.name;
        productosSelect.appendChild(option);
    });

    $(productosSelect).select2({
        placeholder: 'Seleccionar Producto',
        allowClear: true,
        theme: 'bootstrap'
    });
}

// Define una función para generar el PDF de la factura
function generarFacturaPDF() {
    var productsTableData = [['Producto', 'Cantidad', 'Base Imponible', 'Iva', 'Total']];
    var productsTableRows = document.querySelectorAll('#lines-table-body tr');

    productsTableRows.forEach(function (row) {
        var cells = row.querySelectorAll('td');
        if (cells.length >= 5) { 
            var rowData = [];
            for (var i = 0; i < 5; i++) {
                if (cells[i].querySelector('input')) {
                    rowData.push(cells[i].querySelector('input').value);
                } else {
                    rowData.push(cells[i].textContent.trim());
                }
            }
            productsTableData.push(rowData);
        }
    });

    // Añadimos los datos al pdf
    var docDefinition = {
        content: [
            { text: 'Factura', style: 'header' },
            ' ',
            ' ',
            { text: 'Productos', style: 'subheader' },
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

    // Genera y descarga el PDF
    pdfMake.createPdf(docDefinition).download('factura.pdf');
}