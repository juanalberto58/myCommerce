document.addEventListener('DOMContentLoaded', function() {
    const deleteProductButton = document.getElementById('deleteProductButton');
    const filtrarInventario = document.getElementById('filtrarInventario');

    deleteProductButton.addEventListener('click', function(event) {
        event.preventDefault();
        var productId = event.target.getAttribute('data-id');
        eliminarProducto(productId);
    });

    filtrarInventario.addEventListener('click', function() {
        realizarFiltrado();
    });

    cargarProveedores(contactsData, 'contact_id');
});



// Función para filtrar los pedidos de los productos
function realizarFiltrado() {
    var referenciaFiltro = document.getElementById('referencia').value;
    var proveedorId = parseInt(document.getElementById('proveedor').value);

    var resultadosFiltrados = purchases.filter(function(purchase) {
        var referenciaCoincide = !referenciaFiltro || dato.reference.toLowerCase().includes(referenciaFiltro.toLowerCase());
        var proveedorFiltrar = isNaN(proveedorId) || purchase.contact_id === proveedorId;

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

