@extends('adminlte::page')

@section('title', 'MarketSoft - Proveedores')

@section('content_header')
    <h1>Proveedores - Registro</h1>
@stop



@section('content')
    <!DOCTYPE html>
    <html>

    <head>

        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
        <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    </head>


    <!-- Card de Boton Registrar Proveedor -->
    <div class='card card-outline card-success'>

        <body>
            <div class="card-body">
                <div class="row">
                    <a class="btn btn-primary" href="javascript:void(0)" id="CrearNuevoProveedor"> Registrar Proveedor</a>
                </div>


            </div>
    </div>


    <div class="card">
        <div class="card-body">
            <table class="table table-hover table-bordered data-table">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>#</th>
                        <th>RUC</th>
                        <th>Razón Social</th>
                        <th>Actividad</th>
                        <th>Telefono</th>
                        <th>Vendedor</th>
                        <th width="200px">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>




    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modelHeading"></h3>
                </div>
                <div class="modal-body">
                    <form id="proveedorForm" name="proveedorForm" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!-- ID oculto -->
                                    <input type="hidden" name="proveedor_id" id="proveedor_id">


                                    <!-- Input de numero de RUC -->
                                    <div class="form-group">
                                        <label for="name" class="col-sm-8 control-label">Nro. RUC</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="ruc" name="ruc"
                                                placeholder="Ingresar número de RUC" value="" maxlength="12" required="">
                                        </div>
                                    </div>

                                    <!-- Input de Razón Social -->
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label">Razón Social</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="razon_social" name="razon_social"
                                                placeholder="Ingresar razón social" value="" maxlength="50" required="">
                                        </div>
                                    </div>

                                    <!-- Input de Titular -->
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label">Titular</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="titular" name="titular"
                                                placeholder="Ingresar nombre de titular" value="" maxlength="60"
                                                required="">
                                        </div>
                                    </div>

                                    <!-- Input de Actividad -->
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label">Actividad</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="actividad" name="actividad"
                                                placeholder="Ingresar datos de actividad" value="" maxlength="70"
                                                required="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">

                                    <!-- Input de Telefono -->
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label">Nro. de teléfono</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" id="telefono" name="telefono"
                                                placeholder="Ingresar número de telefono" value="" maxlength="30"
                                                required="">
                                        </div>
                                    </div>

                                    <!-- Input de Email -->
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label">Email</label>
                                        <div class="col-sm-12">
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Ingresar dirección de email" value="" maxlength="30"
                                                required="">
                                        </div>
                                    </div>

                                    <!-- Input de Direccion -->
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label">Dirección</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="direccion" name="direccion"
                                                placeholder="Ingresar dirección" value="" maxlength="50" required="">
                                        </div>
                                    </div>

                                    <!-- Input de Vendedor -->
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label">Datos del Vendedor</label>
                                        <div class="col-sm-12">
                                            <input type="textarea" class="form-control" id="vendedor" name="vendedor"
                                                placeholder="Ingresar datos del vendedor" value="" maxlength="100"
                                                required="">
                                        </div>
                                    </div>


                                    
                                </div>
                            </div>
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Guardar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
        $(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                autoWidth: false,
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No existen registros",
                    "info": "Mostrando página _PAGE_ de _PAGES_",
                    "infoEmpty": "No existen registros",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },

                ajax: "{{ route('proveedores.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'ruc',
                        name: 'ruc'
                    },
                    {
                        data: 'razon_social',
                        name: 'razon_social'
                    },
                    {
                        data: 'actividad',
                        name: 'actividad'
                    },
                    {
                        data: 'telefono',
                        name: 'telefono'
                    },
                    {
                        data: 'vendedor',
                        name: 'vendedor'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            $('#CrearNuevoProveedor').click(function() {
                $('#saveBtn').val("create-book");
                $('#proveedor_id').val('');
                $('#proveedorForm').trigger("reset");
                $('#modelHeading').html("Registrar Proveedor");
                $('#ajaxModel').modal('show');
            });


            $('body').on('click', '.editProveedor', function() {
                var proveedor_id = $(this).data('id');
                $.get("{{ route('proveedores.index') }}" + '/' + proveedor_id + '/edit', function(data) {
                    $('#modelHeading').html("Editar Proveedor");
                    $('#saveBtn').val("edit-book");
                    $('#ajaxModel').modal('show');
                    $('#proveedor_id').val(data.id);
                    $('#ruc').val(data.ruc);
                    $('#razon_social').val(data.razon_social);
                    $('#titular').val(data.titular);
                    $('#actividad').val(data.actividad);
                    $('#telefono').val(data.telefono);
                    $('#email').val(data.email);
                    $('#direccion').val(data.direccion);
                    $('#vendedor').val(data.vendedor);
                })
            });


            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Save');

                $.ajax({
                    data: $('#proveedorForm').serialize(),
                    url: "{{ route('proveedores.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#proveedorForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('No se pudo editar');
                    }
                });
            });


            $('body').on('click', '.deleteProveedor', function() {

                var proveedor_id = $(this).data("id");

                var result = confirm("Eliminar Registro?");
                if (result) {

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('proveedores.store') }}" + '/' + proveedor_id,
                        success: function(data) {
                            table.draw();
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                } else {
                    return false;
                }
            });

        });
    </script>
    </body>


    </html>
@endsection
