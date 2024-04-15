$(document).ready(function() {
    console.log(viewData);
    let tablaDatos = $('#tablaRecordatorios').DataTable({
        data: viewData,
        "paging": false,
        "ordering": false,
        "info": false,
        "columnDefs": [{
            "targets": "_all",
            "editable": true // Habilitar la edición para todas las columnas
        }],
        columns:[
            {'data':'recordatorio_id'},
            {'data':'fecha'},
            {'data':'descripcion'},
            {'data':'recordatorio'},
            {'data':'receptores'},
            {'data':'fecha_recordar'},
            {'data':'estatus'},
            {'render': function(a,b,row){
                let result=`
                <button type="button" class="btn btn-primary btnEditar" data-bs-toggle="modal" data-bs-target="#myModal" data-id="${row.recordatorio_id}">Editar</button>
                `;
                return (result);
            }}
        ]
    });
    const myModal = document.getElementById('myModal');
    const myInput = document.getElementById('myInput');

    // Manejar el evento de clic en el botón de edición
    $('#tablaRecordatorios').on('click', '.btnEditar', function() {
        var fila = $(this).closest('tr');
        let rowData = tablaDatos.row(fila).data();
        console.log (rowData);
        $('#recordatorio_id').val(rowData.recordatorio_id);
        $('#fecha').val(rowData.fecha);
        $('#descripcion').val(rowData.descripcion);
        $('#recordatorio').val(rowData.recordatorio);
        $('#receptores').val(rowData.receptores);
        $('#fecha_recordar').val(rowData.fecha_recordar);
        $('#estatus').val(rowData.estatus);
        $('#recordatorio_id').attr('data-id', rowData.recordatorio_id);
    });

    // Agregar un evento submit al formulario de actualización
    $('#updateForm').submit(function(e) {
        e.preventDefault();
        let id = $('#recordatorio_id').attr('data-id');
        let formData = $(this).serialize();

        $.ajax({
            url: `recordatorios/${id}`,
            type: 'PUT',
            data: formData,
            success: function(response) {
                console.log(response);
                $('#myModal').modal('hide');

                // Recargar la página después de que se complete la actualización
                location.reload();
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText,this.url);
            }
        });
    });

    $('#formAgregarNuevoRecordatorio').submit(function(e) {
        e.preventDefault(); // Evitar el comportamiento predeterminado del formulario

        let formData = $(this).serialize();
        // Enviar los datos al controlador para agregar un nuevo recordatorio
        $.ajax({
            url: $(this).attr('action'), // Obtener la URL del atributo action del formulario
            type: 'POST', // Utilizar el método POST para enviar datos
            data: formData, // Pasar los datos del formulario
            success: function(response) {
                console.log(response); // Mostrar la respuesta del servidor en la consola

                // Cerrar el modal después de agregar el nuevo recordatorio
                $('#agregarNuevoRecordatorioModal').modal('hide');

                // Recargar la página después de agregar el nuevo recordatorio
                location.reload();

            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText, this.url); // Mostrar error en la consola

                // Mostrar el mensaje de error al usuario
                alert('Error: No se pudo guardar el recordatorio. ' + xhr.responseText);
            }
        });
    });

});
