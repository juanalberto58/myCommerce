var lineasPedido = [];

document.addEventListener('DOMContentLoaded', function() {

    const addButton = document.getElementById('addButton');
    const createPurchaseOrder = document.getElementById('createPurchaseOrder');

    addButton.addEventListener('click', function() {
        agregarLineaPedido();
    });

    createPurchaseOrder.addEventListener('click', function() {
        crearPedidoCompra();
    });

    cargarProveedores(contactsData, 'contact_id');
    cargarProductos(productsData, 'product_id');
});


//Evento para mostrar un pedido de compra concreto
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('purchase-link')) {
        event.preventDefault();
        var purchaseId = event.target.getAttribute('data-id');
        window.location.href = `/purchases/${purchaseId}`;
    }
});


document.addEventListener('DOMContentLoaded', function() {
    const filtrarCompras = document.getElementById('filtrarCompras');
    const limpiarFiltro = document.getElementById('limpiarFiltro');
    cargarProveedores(contactsData, 'proveedor');

    filtrarCompras.addEventListener('click', function() {
        realizarFiltrado();
    });

    limpiarFiltro.addEventListener('click', function() {
        cargarCompras(); // Llama a la función cargarCompras para mostrar todos los pedidos
        limpiarCamposFiltro(); // Limpia los campos de filtro
    });

    cargarCompras();

});

document.addEventListener('DOMContentLoaded', function() {
    const deletePurchaseButton = document.getElementById('deletePurchaseButton');

    deletePurchaseButton.addEventListener('click', function(event) {
        event.preventDefault();
        var purchaseId = event.target.getAttribute('data-id');
        eliminarPedidoCompra(purchaseId);
    });
});



// Función para agregar una línea de pedido
function agregarLineaPedido() {
    var product_id = document.getElementById('product_id').value;
    var quantity = document.getElementById('quantity').value;
    var tax_base = document.getElementById('tax_base').value;
    var tax = document.getElementById('tax').value;


    if (quantity.trim() === '') {
        alert('Por favor, complete todos los campos.');
        return;
    }

    lineasPedido.push({ product_id: product_id, quantity: quantity, tax_base: tax_base, tax: tax });

    document.getElementById('product_id').value = '';
    document.getElementById('quantity').value = '';
    document.getElementById('tax_base').value = '';
    document.getElementById('tax').value = '';

    // Actualizar la tabla con las líneas de pedido agregadas
    actualizarTablaLineasPedido();
    agregarFilaSumaTotal();
    actualizarSumaTotal();
}

// Función para agregar la fila de suma total al final de la tabla
function agregarFilaSumaTotal() {
    var tablaBody = document.getElementById('lineasPedidoTableBody');
    var row = document.createElement('tr');
    row.innerHTML = '<td colspan="6"></td><td id="sumaTotal"></td>';
    tablaBody.appendChild(row);
}

// Función para actualizar la tabla de lineas de pedido
function actualizarTablaLineasPedido() {
    var tablaBody = document.getElementById('lineasPedidoTableBody');
    tablaBody.innerHTML = '';

    lineasPedido.forEach(function(linea, index) {
        var row = document.createElement('tr');
        var productCell = document.createElement('td');
        var quantityCell = document.createElement('td');
        var tax_baseCell = document.createElement('td');
        var taxCell = document.createElement('td');
        var totalCell = document.createElement('td');
        var deleteCell = document.createElement('td');

        // Buscar el objeto de producto correspondiente al ID en la línea actual
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

        var subtotal = parseFloat(linea.quantity) * parseFloat(linea.tax_base);
        var ivaAmount = (subtotal * (parseFloat(linea.tax) / 100));
        var total = subtotal + ivaAmount;
        totalCell.innerText = total.toFixed(2);

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
        tablaBody.appendChild(row);
    });
}

// Función para calcular y mostrar la suma total
function actualizarSumaTotal() {
    var sumaTotal = 0;

    lineasPedido.forEach(function(linea) {
        sumaTotal += parseFloat(linea.quantity) * parseFloat(linea.tax_base) + (parseFloat(linea.tax) / 100);
    });

    var sumaTotalCell = document.getElementById('sumaTotal');
    sumaTotalCell.innerText = sumaTotal.toFixed(2);
}

// Funciona para obtner la fecha actual
function obtenerFechaActual() {
    var fecha = new Date();
    var dia = fecha.getDate();
    var mes = fecha.getMonth() + 1;
    var año = fecha.getFullYear();
    
    // Formateamos la fecha en el formato (YYYY-MM-DD)
    var fechaFormateada = año + '-' + (mes < 10 ? '0' : '') + mes + '-' + (dia < 10 ? '0' : '') + dia;
    
    return fechaFormateada;
}

// Función para eliminar una línea de pedido
function eliminarLineaPedido(index) {
    lineasPedido.splice(index, 1);
    actualizarTablaLineasPedido();
    agregarFilaSumaTotal();
    actualizarSumaTotal();
}

// Función para mostrar el listado de los pedidos de compra
function cargarCompras() {
    var comprasTableBody = document.getElementById('compras-table-body');
    comprasTableBody.innerHTML = '';
    purchases.forEach(function(dato) {
        var row = document.createElement('tr');
        var contacto = contactsData.find(function(contact) {
            return contact.id === dato.contact_id;
        });
        row.innerHTML = `
            <td><a class="purchase-link" data-id="${dato.id}" href="#">${dato.id}</a></td>
            <td>${dato.date}</td>
            <td>${contacto ? contacto.name : 'Desconocido'}</td>
            <td>${dato.tax_base}</td>
            <td>${dato.total}</td>
            <td>${dato.estado}</td>
        </tr>
    `;
        comprasTableBody.appendChild(row);
    });
    var purchaseLinks = document.querySelectorAll('.purchase-link');
    purchaseLinks.forEach(function(link) {
    link.addEventListener('click', function(event) {
        event.preventDefault();
        var purchaseId = link.getAttribute('data-id');
        mostrarDetallesPedido(purchaseId);
    });
});
}


 // Función que para obtener los detalles del pedido concreto
function mostrarDetallesPedido(purchaseId) {
    $.ajax({
        type: 'GET',
        url: `/purchases/${purchaseId}`, 
        success: function(data) {
            console.log(data);
        },
        error: function() {
            alert('Hubo un error al obtener los detalles del pedido.');
        }
    });
}

// Función para crear un pedido de compra
function crearPedidoCompra() {
    if (lineasPedido.length === 0) {
        alert("No hay líneas de pedido para guardar.");
        return;
    }

    var taxBase = 0;
    var tax = 0;
    var totalPedido = 0;
    
    lineasPedido.forEach(function(linea) {
        taxBase += parseFloat(linea.tax_base);
        tax += parseFloat(linea.tax);

        var subtotal = parseFloat(linea.quantity) * parseFloat(linea.tax_base);
        var ivaAmount = (subtotal * (parseFloat(linea.tax) / 100));
        var totalLinea = subtotal + ivaAmount;
        linea.total = totalLinea; 

        totalPedido += totalLinea; 
    });

    var contact_id = document.getElementById('contact_id').value;

    // Crear un objeto con los datos del pedido
    var pedidoData = {
        date: obtenerFechaActual(),
        contact_id: contact_id, 
        user_id: authenticatedUserId,
        tax_base: taxBase,
        tax: tax,
        total: totalPedido,
        lineasPedido: lineasPedido
    };

    console.log(pedidoData);

    // Enviar los datos al servidor utilizando AJAX con jQuery
    $.ajax({
        type: "POST",
        url: "/purchases/store", 
        data: JSON.stringify(pedidoData),
        contentType: "application/json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content') 
        },
        dataType: "json",
        success: function(data) {
            if (data.success) {
                alert("Pedido de compra creado exitosamente.");
                window.location.href = '/purchases';
            } else {
                alert("Hubo un error al crear el pedido de compra. Por favor, intenta nuevamente.");
            }
        },
        error: function() {
            alert("Hubo un error al comunicarse con el servidor. Por favor, intenta nuevamente.");
        }
    });
}

// Función para filtrar los pedidos de compra
function realizarFiltrado() {
    var fecha = document.getElementById('fecha').value;
    var proveedorId = parseInt(document.getElementById('proveedor').value);

    var resultadosFiltrados = purchases.filter(function(purchase) {
        var fechaFiltrar = !fecha || purchase.date === fecha;
        var proveedorFiltrar = isNaN(proveedorId) || purchase.contact_id === proveedorId;

        // Si no se selecciona proveedor ni fecha, mostrar todos los resultados
        if (isNaN(proveedorId) && fechaFiltrar) {
            return true;
        }

        // Filtrar por proveedor y fecha si se seleccionan ambos
        return fechaFiltrar && proveedorFiltrar;
    });

    console.log(resultadosFiltrados);
    actualizarTabla(resultadosFiltrados);
}

// Función para actualizar la tabla de los pedidos de compra
function actualizarTabla(resultados) {

    var tbody = document.getElementById('compras-table-body');
    tbody.innerHTML = '';

    resultados.forEach(function(purchase) {

        var row = document.createElement('tr');
        var contacto = contactsData.find(function(contact) {
            return contact.id === purchase.contact_id;
        });
        row.innerHTML = `
            <td><a class="purchase-link" data-id="${purchase.id}" href="#">${purchase.id}</a></td>
            <td>${purchase.date}</td>
            <td>${contacto ? contacto.name : 'Desconocido'}</td>
            <td>${purchase.tax_base}</td>
            <td>${purchase.total}</td>
            <td>${purchase.estado}</td>
        `;
        tbody.appendChild(row);
    });
}

// Función para limpiar los campos de filtro
function limpiarCamposFiltro() {
    document.getElementById('fecha').value = '';
    document.getElementById('proveedor').value = '';
}

// Función para cargar todos los proveedores en el select
function cargarProveedores(contacts, select) {
    var proveedorSelect = document.getElementById(select);
    
    var proveedores = contacts.filter(function(contact) {
        return contact.type === 'proveedor';
    });

    proveedores.forEach(function(proveedor) {
        var option = document.createElement('option');
        option.value = proveedor.id;
        option.textContent = proveedor.name;
        proveedorSelect.appendChild(option);
    });

    // Inicializar Select2 para ambos selects
    $(proveedorSelect).select2({
        placeholder: 'Seleccionar proveedor',
        allowClear: true,
        theme: 'bootstrap'
    });
}


// Función para cargar todos los proveedores en el select
function cargarProductos(products, select) {
    var productosSelect = document.getElementById(select);
    var proveedorSelect = document.getElementById('contact_id');

    console.log(proveedorSelect.value);

    var productos = products.filter(function(product) {
        return product.contact_id == proveedorSelect.value;
    });

    productos.forEach(function(producto) {
        var option = document.createElement('option');
        option.value = producto.id;
        option.textContent = producto.name;
        productosSelect.appendChild(option);
    });

    // Inicializar Select2 para ambos selects
    $(productosSelect).select2({
        placeholder: 'Seleccionar Producto',
        allowClear: true,
        theme: 'bootstrap'
    });
}



// Función para eliminar un pedido de compra.
function eliminarPedidoCompra(purchaseId) {
    if (confirm("¿Estás seguro de que deseas eliminar este pedido de compra y todas sus líneas de pedido?")) {
        $.ajax({
            type: 'DELETE',
            url: '/purchases/' + purchaseId,
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data);
                if (data.success) {
                    alert("Pedido de compra eliminado exitosamente.");
                    window.location.href = '/purchases';
                } else {
                    alert("Hubo un error al eliminar el pedido de compra. Por favor, intenta nuevamente.");
                }
            },
            error: function() {
                alert("Hubo un error al comunicarse con el servidor. Por favor, intenta nuevamente.");
            }
        });
    }
}

