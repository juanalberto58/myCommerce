//Evento para los botones y las acciones de la vista de inicio
document.addEventListener('DOMContentLoaded', function() {

    const filterUsers = document.getElementById('filterUsers');

    filterUsers.addEventListener('click', function() {
        realizarFiltrado();
    });

    clearFiltersButton.addEventListener('click', function() {
        document.getElementById('name').value = '';
        document.getElementById('dni').value = '';
        cargarUsuarios(); 
    });

    cargarUsuarios();

});


document.addEventListener('click', function(event) {
    if (event.target.classList.contains('user-link')) {
        event.preventDefault();
        var userId = event.target.getAttribute('data-id');
        window.location.href = `/users/${userId}`;
    }
});

//Evento para los botones y las acciones de la vista de un usuario concreto
document.addEventListener('DOMContentLoaded', function() {
    const deleteUserButton = document.getElementById('deleteUserButton');

    deleteUserButton.addEventListener('click', function(event) {
        event.preventDefault();
        var userId = event.target.getAttribute('data-id');
        eliminarUsuario(userId);
    });
});



// Función para mostrar el listado de los pedidos de compra
function cargarUsuarios() {
    var UsuariosTableBody = document.getElementById('users-table-body');
    UsuariosTableBody.innerHTML = '';

    users.forEach(function(dato) {
        var row = document.createElement('tr');
        row.innerHTML = `
            <td><a class="user-link" data-id="${dato.id}" href="/users/${dato.id}">${dato.id}</a></td>
            <td>${dato.dni}</td>
            <td>${dato.name}</td>
            <td>${dato.lastname}</td>
            <td>${dato.email}</td>
        </tr>
    `;
    UsuariosTableBody.appendChild(row);
    });
    var usersLinks = document.querySelectorAll('.user-link');
    usersLinks.forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();
            var userId = link.getAttribute('data-id');
            mostrarDetallesUsuario(userId);
        });
    });
}

// Función para filtrar los usuarios
function realizarFiltrado(){
    var nombreFiltro = document.getElementById('name').value.trim();
    var dniFiltro = document.getElementById('dni').value.trim();

    var usuariosFiltrados = users.filter(function (dato) {
        var nombreCoincide = !nombreFiltro || dato.name.toLowerCase().includes(nombreFiltro.toLowerCase());
        var dniCoincide = !dniFiltro || dato.dni.toLowerCase().includes(dniFiltro.toLowerCase());
        return nombreCoincide && dniCoincide;
    });

    cargarUsuariosFiltrados(usuariosFiltrados);

};

// Función para mostrar los datos de un usuario
function mostrarDetallesUsuario(usersId) {
    $.ajax({
        type: 'GET',
        url: `/users/${usersId}`,
        success: function(data) {
            console.log(data);
        },
        error: function() {
            alert('Hubo un error al obtener los detalles del usuarios.');
        }
    });
}

// Función para cargar los usuarios filtrados
function cargarUsuariosFiltrados(usuarios) {
    var UsuariosTableBody = document.getElementById('users-table-body');
    UsuariosTableBody.innerHTML = '';
    usuarios.forEach(function (dato) {
        var row = document.createElement('tr');
        row.innerHTML = `
            <td><a class="user-link" data-id="${dato.id}" href="/users/${dato.id}">${dato.id}</a></td>
            <td>${dato.dni}</td>
            <td>${dato.name}</td>
            <td>${dato.lastname}</td>
            <td>${dato.email}</td>
        `;
        UsuariosTableBody.appendChild(row);
    });

    var usersLinks = document.querySelectorAll('.user-link');
    usersLinks.forEach(function (link) {
        link.addEventListener('click', function (event) {
            event.preventDefault();
            var userId = link.getAttribute('data-id');
            mostrarDetallesUsuario(userId);
        });
    });
}

// Función para eliminar un producto.
function eliminarUsuario(userId) {
    if (confirm("¿Estás seguro de que deseas eliminar este usuario?")) {
        $.ajax({
            type: 'DELETE',
            url: '/users/' + userId,
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                if (data.success) {
                    alert("Usuario eliminado exitosamente.");
                    window.location.href = '/users';
                } else {
                    alert("Hubo un error al eliminar el usuario. Por favor, intenta nuevamente.");
                }
            },
            error: function() {
                alert("Hubo un error al comunicarse con el servidor. Por favor, intenta nuevamente.");
            }
        });
    }
}