@extends('adminlte::page')

@section('title', 'MarketSoft - Clientes')

@section('content_header')
    <h1>Clientes - Registro</h1>
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


    <!-- Card de Boton Registrar Cliente -->
    <div class='card card-outline card-success'>

        <body>
            <div class="card-body">
                <div class="row">
                    <a class="btn btn-primary" href="javascript:void(0)" id="CrearNuevoCliente"> Registrar Cliente</a>
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
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Telefono</th>
                        <th>Email</th>
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
                    <form id="clienteForm" name="clienteForm" class="form-horizontal">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <!-- ID oculto -->
                                    <input type="hidden" name="cliente_id" id="cliente_id">


                                    <!-- Input numero de documento de identidad -->
                                    <div class="form-group">
                                        <label for="name" class="col-sm-10 control-label">Nro. Documento de
                                            Identidad</label>
                                        <div class="col-sm-12">
                                            <input type="number" class="form-control" id="nro_documento"
                                                name="nro_documento" placeholder="Ingresar número de documento" value=""
                                                maxlength="10" required="">
                                        </div>
                                    </div>

                                    <!-- Input de numero de RUC -->
                                    <div class="form-group">
                                        <label for="name" class="col-sm-8 control-label">Nro. RUC</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="nro_ruc" name="nro_ruc"
                                                placeholder="Ingresar número de RUC" value="" maxlength="12">
                                        </div>
                                    </div>

                                    <!-- Input de fecha emision -->
                                    <div class="form-group">
                                        <label class="col-sm-10 control-label">Fecha de Nacimiento</label>
                                        <div class="col-sm-12">
                                            <input type="date" id="fecha_nac" name="fecha_nac" class="form-control"
                                                value="{{ old('inicia_en') }}">
                                        </div>
                                    </div>

                                    <!-- Input de Nombre -->
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label">Nombre</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="nombre" name="nombre"
                                                placeholder="Ingresar nombre" value="" maxlength="40" required="">
                                        </div>
                                    </div>

                                    <!-- Input de Apellido -->
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label">Apellido</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="apellido" name="apellido"
                                                placeholder="Ingresar apellido" value="" maxlength="60" required="">
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
                                                placeholder="Ingresar número de telefono" value="" maxlength="30">
                                        </div>
                                    </div>

                                    <!-- Input de Email -->
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label">Email</label>
                                        <div class="col-sm-12">
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Ingresar dirección de email" value="" maxlength="100">
                                        </div>
                                    </div>

                                    <!-- Input de Direccion -->
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label">Dirección</label>
                                        <div class="col-sm-12">
                                            <input type="text" class="form-control" id="direccion" name="direccion"
                                                placeholder="Ingresar dirección" value="" maxlength="50">
                                        </div>
                                    </div>

                                    <!-- Input de Referencia -->
                                    <div class="form-group">
                                        <label class="col-sm-8 control-label">Referencia</label>
                                        <div class="col-sm-12">
                                            <input type="textarea" class="form-control" id="referencia" name="referencia"
                                                placeholder="Ingresar referencia" value="" maxlength="300">
                                        </div>
                                    </div>

                                    <!-- Select de Categoria -->
                                    <div class="form-group">
                                        <label for="name" class="col-sm-8 control-label">Categoría</label>
                                        <div class="col-sm-12">
                                            <select class="form-control" id="categoria" name="categoria">
                                                @foreach ($tipos as $tipo)
                                                    <option value="{{ $tipo['id'] }}">{{ $tipo['descripcion'] }}
                                                    </option>
                                                @endforeach
                                            </select>
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

                ajax: "{{ route('clientes.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'nro_ruc',
                        name: 'nro_ruc'
                    },
                    {
                        data: 'nombre',
                        name: 'nombre'
                    },
                    {
                        data: 'apellido',
                        name: 'apellido'
                    },
                    {
                        data: 'telefono',
                        name: 'telefono'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            $('#CrearNuevoCliente').click(function() {
                $('#saveBtn').val("create-book");
                $('#cliente_id').val('');
                $('#clienteForm').trigger("reset");
                $('#modelHeading').html("Registrar Cliente");
                $('#ajaxModel').modal('show');
            });


            $('body').on('click', '.editCliente', function() {
                var cliente_id = $(this).data('id');
                $.get("{{ route('clientes.index') }}" + '/' + cliente_id + '/edit', function(data) {
                    $('#modelHeading').html("Editar Cliente");
                    $('#saveBtn').val("edit-book");
                    $('#ajaxModel').modal('show');
                    $('#cliente_id').val(data.id);
                    $('#nro_documento').val(data.nro_documento)
                    $('#nro_ruc').val(data.nro_ruc);
                    $('#nombre').val(data.nombre);
                    $('#apellido').val(data.apellido);
                    $('#fecha_nac').val(data.fecha_nac);
                    $('#telefono').val(data.telefono);
                    $('#email').val(data.email);
                    $('#direccion').val(data.direccion);
                    $('#referencia').val(data.referencia);
                    $('#categoria').val(data.categoria);
                })
            });


            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Save');

                $.ajax({
                    data: $('#clienteForm').serialize(),
                    url: "{{ route('clientes.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#clienteForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('No se pudo guardar');
                    }
                });
            });


            $('body').on('click', '.deleteCliente', function() {

                var cliente_id = $(this).data("id");

                var result = confirm("Eliminar Registro?");
                if (result) {

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('clientes.store') }}" + '/' + cliente_id,
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
