<!doctype html>
<html lang="en">
<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-2.0.2/b-3.0.1/sl-2.0.0/datatables.min.css"/>
</head>
<body>

    @include('includes.navbar')



<main>
    <div class="container">
        <h1 class="text-center">Recordatorios</h1>
        <button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#agregarNuevoRecordatorioModal">
            Agregar Nuevo Recordatorio
        </button>
        <!-- Modal para agregar un nuevo recordatorio -->
    <div class="modal fade" id="agregarNuevoRecordatorioModal" tabindex="-1" aria-labelledby="agregarNuevoRecordatorioModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="agregarNuevoRecordatorioModalLabel">Agregar Nueva Consulta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="formAgregarNuevoRecordatorio" method="POST" action="{{ route('recordatorios.store') }}">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="fecha_new">Fecha</label>
                            <input type="date" class="form-control" id="fecha_new" name="fecha">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion_new">Descripción</label>
                            <input type="text" class="form-control" id="descripcion_new" name="descripcion">
                        </div>
                        <div class="mb-3">
                            <label for="recordatorio_new">Recordatorio</label>
                            <input type="text" class="form-control" id="recordatorio_new" name="recordatorio">
                        </div>
                        <div class="mb-3">
                            <label for="receptores_new">Receptores</label>
                            <input type="text" class="form-control" id="receptores_new" name="receptores">
                        </div>
                        <div class="mb-3">
                            <label for="fecha_recordar_new">Fecha de Recordar</label>
                            <input type="date" class="form-control" id="fecha_recordar_new" name="fecha_recordar">
                        </div>
                        <div class="mb-3">
                            <label for="estatus_new">Estatus</label>
                            <input type="text" class="form-control" id="estatus_new" name="estatus">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

        <div class="table-responsive">
            <table id="tablaRecordatorios" class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Recordatorio</th>
                        <th>Receptores</th>
                        <th>Fecha de Recordar</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

            </table>
        </div>
    </div>
</main>

<footer>
    <!-- Contenido del pie de página -->
</footer>
<div id="myModal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Recordatorio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="updateForm" action="{{ route('recordatorios.update', ['id' => 0]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Se ha eliminado el label y el campo para el ID -->
                    <input type="hidden" name="id" id="recordatorio_id">
                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input type="text" class="form-control" name="fecha" id="fecha">
                    </div>
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input type="text" class="form-control" name="descripcion" id="descripcion">
                    </div>
                    <div class="mb-3">
                        <label for="recordatorio" class="form-label">Recordatorio</label>
                        <input type="text" class="form-control" name="recordatorio" id="recordatorio">
                    </div>
                    <div class="mb-3">
                        <label for="receptores" class="form-label">Receptores</label>
                        <input type="text" class="form-control" name="receptores" id="receptores">
                    </div>
                    <div class="mb-3">
                        <label for="fecha_recordar" class="form-label">Fecha de Recordar</label>
                        <input type="text" class="form-control" name="fecha_recordar" id="fecha_recordar">
                    </div>
                    <div class="mb-3">
                        <label for="estatus" class="form-label">Estatus</label>
                        <input type="text" class="form-control" name="estatus" id="estatus">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" id="btnGuardarCambios">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>




<?php $viewData = json_encode($recordatorios); ?>
<script>
    let viewData = <?php echo $viewData; ?>;
</script>

<!-- Bootstrap JavaScript Libraries -->
<script src="https://cdn.jsdelivr.net/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

<!--DataTables JavaScript-->
<script src="https://cdn.datatables.net/v/dt/jqc-1.12.4/dt-2.0.2/b-3.0.1/sl-2.0.0/datatables.min.js"></script>
<script src="{{ asset('assets/script.js') }}"></script>


</body>
</html>
