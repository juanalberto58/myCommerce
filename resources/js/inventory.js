document.addEventListener('DOMContentLoaded', function() {
    const deleteProductButton = document.getElementById('deleteProductButton');

    deleteProductButton.addEventListener('click', function(event) {
        event.preventDefault();
        var productId = event.target.getAttribute('data-id');
        eliminarProducto(productId);
    });


    cargarProveedores(contactsData, 'contact_id');
});

document.addEventListener('DOMContentLoaded', function() {
    const filtrarInventario = document.getElementById('filtrarInventario');

    filtrarInventario.addEventListener('click', function() {
        realizarFiltrado();
    });
});

document.getElementById('limpiarFiltro').addEventListener('click', function() {
    actualizarProductos(products);
    
    document.getElementById('referencia').value = '';
    document.getElementById('proveedor').value = '';
});

// Función para filtrar los pedidos de los productos
function realizarFiltrado() {
    var referenciaFiltro = document.getElementById('referencia').value;
    var proveedorId = parseInt(document.getElementById('proveedor').value);
    var resultadosFiltrados = products.filter(function(prod) {
        var referenciaCoincide = !referenciaFiltro || prod.reference.toLowerCase().includes(referenciaFiltro.toLowerCase());
        var proveedorFiltrar = isNaN(proveedorId) || prod.contact_id === proveedorId;

        return referenciaCoincide && proveedorFiltrar;
    });

    actualizarProductos(resultadosFiltrados);
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

// Función para eliminar un producto.
function eliminarProducto(productId) {
    if (confirm("¿Estás seguro de que deseas eliminar este producto?")) {
        $.ajax({
            type: 'DELETE',
            url: '/products/' + productId,
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                console.log(data);
                if (data.success) {
                    alert("Producto eliminado exitosamente.");
                    window.location.href = '/inventory';
                } else {
                    alert("Hubo un error al eliminar el producto. Por favor, intenta nuevamente.");
                }
            },
            error: function() {
                alert("Hubo un error al comunicarse con el servidor. Por favor, intenta nuevamente.");
            }
        });
    }
}

// Función para actualizar los productos de la tabla.
function actualizarProductos(resultadosFiltrados) {

    var productosContainer = document.getElementById('productos-container');

    productosContainer.innerHTML = '';

    resultadosFiltrados.forEach(function(prod) {
        var colDiv = document.createElement('div');
        colDiv.className = 'col-md-3 mb-4';

        var cardLink = document.createElement('a');
        cardLink.href = "{{ route('products.show', $prod->id) }}";
        cardLink.className = 'card-link';

        var cardDiv = document.createElement('div');
        cardDiv.className = 'card';

        var img = document.createElement('img');
        img.src = prod.image;
        img.className = 'card-img-top';
        img.alt = prod.reference;
        img.style.width = '100px';
        img.style.height = '100px';

        var cardBody = document.createElement('div');
        cardBody.className = 'card-body';

        var cardTitle = document.createElement('h5');
        cardTitle.className = 'card-title';
        cardTitle.textContent = prod.reference;

        var cardText = document.createElement('p');
        cardText.className = 'card-text';
        cardText.textContent = prod.name;

        cardBody.appendChild(cardTitle);
        cardBody.appendChild(cardText);

        cardDiv.appendChild(img);
        cardDiv.appendChild(cardBody);

        cardLink.appendChild(cardDiv);

        colDiv.appendChild(cardLink);

        productosContainer.appendChild(colDiv);
    });
}


