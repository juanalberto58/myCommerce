document.addEventListener('DOMContentLoaded', function() {
    const deleteProductButton = document.getElementById('deleteProductButton');

    deleteProductButton.addEventListener('click', function(event) {
        event.preventDefault();
        var productId = event.target.getAttribute('data-id');
        eliminarProducto(productId);
    });
});

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