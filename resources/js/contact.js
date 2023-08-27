document.addEventListener('DOMContentLoaded', function() {

    const filtrarContactos = document.getElementById('filtrarContactos');
    const limpiarFiltro = document.getElementById('limpiarFiltro');

    filtrarContactos.addEventListener('click', function() {
        realizarFiltrado();
    });

    limpiarFiltro.addEventListener('click', function() {
        cargarContactos(); // Llama a la función cargarCompras para mostrar todos los pedidos nuevamente
        limpiarCamposFiltro(); // Limpia los campos de filtro
    });

    cargarContactos();
});

document.addEventListener('click', function(event) {
    if (event.target.classList.contains('contact-link')) {
        event.preventDefault();
        var contactId = event.target.getAttribute('data-id');
        window.location.href = `/contacts/${contactId}`;
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const deleteContactButton = document.getElementById('deleteContactButton');

    deleteContactButton.addEventListener('click', function(event) {
        event.preventDefault();
        var contactId = event.target.getAttribute('data-id');
        eliminarContacto(contactId);
    });
});

// Función para mostrar el listado de los pedidos de compra
function cargarContactos() {
    var contactosTableBody = document.getElementById('contacts-table-body');
    contactosTableBody.innerHTML = '';
    contacts.forEach(function(dato) {
        var row = document.createElement('tr');
        row.innerHTML = `
            <td><a class="contact-link" data-id="${dato.id}" href="/contacts/${dato.id}">${dato.id}</a></td>
            <td>${dato.name}</td>
            <td>${dato.lastname}</td>
            <td>${dato.email}</td>
        </tr>
    `;
    contactosTableBody.appendChild(row);
    });
    var contactsLinks = document.querySelectorAll('.contact-link');
    contactsLinks.forEach(function(link) { // Cambia "contacstLinks" a "contactsLinks"
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Evita la acción de navegación por defecto
            var contactId = link.getAttribute('data-id'); // Cambia "contactsId" a "contactId"
            mostrarDetallesContacto(contactId);
        });
    });
}

function mostrarDetallesContacto(contactsId) {
    $.ajax({
        type: 'GET',
        url: `/contacts/${contactsId}`,
        success: function(data) {
            console.log(data);
        },
        error: function() {
            alert('Hubo un error al obtener los detalles del pedido.');
        }
    });
}

// Función para filtrar los contactos
function realizarFiltrado() {
    var name = document.getElementById('name').value;
    var dni = document.getElementById('dni').value;
    var isProveedorChecked = document.getElementById('proveedorCheck').checked;
    var isClienteChecked = document.getElementById('clienteCheck').checked;

    var resultadosFiltrados = contacts.filter(function(contact) {
        var matchName = (!name || contact.name.toLowerCase().includes(name.toLowerCase()));
        var matchDNI = (!dni || contact.dni.toLowerCase().includes(dni.toLowerCase()));
        var matchTipo = (isProveedorChecked && contact.type === 'proveedor') ||
                        (isClienteChecked && contact.type === 'cliente');

        return matchName && matchDNI && matchTipo;
    });

    actualizarTabla(resultadosFiltrados);
}

// Función para actualizar la tabla de los pedidos de venta
function actualizarTabla(resultados) {
    var tbody = document.getElementById('contacts-table-body');
    tbody.innerHTML = '';

    resultados.forEach(function(contact) {
        var row = document.createElement('tr');
        row.innerHTML = `
        <td><a class="contact-link" data-id="${contact.id}" href="/contacts/${contact.id}">${contact.id}</a></td>
            <td>${contact.name}</td>
            <td>${contact.lastname}</td>
            <td>${contact.email}</td>
        `;
        tbody.appendChild(row);
    });
}

// Función para limpiar los campos de filtro
function limpiarCamposFiltro() {
    document.getElementById('name').value = '';
    document.getElementById('dni').value = '';
    document.getElementById('proveedorCheck').checked = false;
    document.getElementById('clienteCheck').checked = false;
}


// Función para eliminar un contacto.
function eliminarContacto(contactId) {
    if (confirm("¿Estás seguro de que deseas eliminar este contacto?")) {
        $.ajax({
            type: 'DELETE',
            url: '/contacts/' + contactId,
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if (data.success) {
                    alert("Contacto eliminado exitosamente.");
                    window.location.href = '/contacts';
                } else {
                    alert("Hubo un error al eliminar el contacto. Por favor, intenta nuevamente.");
                }
            },
            error: function() {
                alert("Hubo un error al comunicarse con el servidor. Por favor, intenta nuevamente.");
            }
        });
    }
}
