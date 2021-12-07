@extends('adminlte::page')

@section('title', 'MarketSoft - Caja')

@section('content_header')
    <h1>Caja - Recibo</h1>
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




    <!-- Card de Formulario estático de Registro de Compra -->

    <!-- Header -->
    <div class="card card-default">
        <div class="card-header card-primary">
            <h1 class="card-title">Registrar Recibo de Dinero</h1>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <!-- Formulario -->
        <!-- /.card-header -->
        <div class="card-body">
            <form id="reciboForm" name="reciboForm">
                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- ID oculto -->
                            <input type="hidden" name="recibo_id" id="recibo_id">


                            <!-- Select de Clientes -->
                            <div class="form-group">
                                <label for="name" class="col-sm-8 control-label">Cliente</label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="cliente_id" name="cliente_id">
                                        @foreach ($clientes as $cliente)
                                            <option value="{{ $cliente['id'] }}">{{ $cliente['nombre'] }} 
                                                {{ $cliente['apellido'] }}
                                                | CI: 
                                                {{ $cliente['nro_documento'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <!-- Input de fecha emision -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Fecha de Emisión</label>
                                <div class="col-sm-12">
                                    <input type="date" id="fecha_entrega" name="fecha_entrega" class="form-control"
                                        value="{{ old('inicia_en') }}">
                                </div>
                            </div>


                            <!-- Input numero de recibo -->
                            <div class="form-group">
                                <label for="name" class="col-sm-8 control-label">Número de Recibo</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="numero" name="numero"
                                        placeholder="Ingresar número de recibo" value="" maxlength="15" required="">
                                </div>
                            </div>


                            <!-- Input de Importe -->
                            <div class="form-group">
                                <label for="name" class="col-sm-8 control-label">Importe</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="importe" name="importe"
                                        placeholder="Ingresar importe" value="" maxlength="9" required="">
                                </div>
                            </div>

                            <!-- Input de Concepto -->
                            <div class="form-group">
                                <label for="name" class="col-sm-8 control-label">Concepto</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="concepto" name="concepto"
                                        placeholder="Ingresar concepto de recibo" value="" maxlength="150" required="">
                                </div>
                            </div>


                        </div>
                    </div>
                    <!-- /.col -->


                    <!-- Boton Guardar -->
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Guardar
                        </button>

                    </div>
                </div>
            </form>
            <!-- /.row -->
        </div>
    </div>

    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modelHeading"></h3>
                </div>
                <div class="modal-body">
                    <form id="reciboFormM" target="_blank" action="{{ route('descargarPDF') }}" target="_blank"
                        method="get" name="reciboFormM" class="form-horizontal">

                        <!-- ID oculto -->
                        <input type="hidden" name="recibo_idM" id="recibo_idM" value="1">

                        <!-- Input numero de recibo -->
                        <div class="form-group">
                            <label for="name" class="col-sm-8 control-label">Número de Recibo</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="numeroM" name="numeroM"
                                    placeholder="Ingresar número de recibo" value="" maxlength="15" required="">
                            </div>
                        </div>

                        <!-- Boton Guardar -->
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success" id="saveBtnM" value="create">Imprimir PDF
                            </button>

                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Tabla -->
    <div class="card">
        <div class="card-body">
            <table class="table table-hover table-bordered data-table">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Cliente</th>
                        <th>Importe</th>
                        <th>Concepto</th>
                        <th width="200px">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
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

                ajax: "{{ route('recibos.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'fecha_entrega',
                        name: 'fecha_entrega'
                    },
                    {
                        data: 'cliente_id',
                        name: 'cliente_id'
                    },
                    {
                        data: 'importe',
                        name: 'importe'
                    },
                    {
                        data: 'concepto',
                        name: 'concepto'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });





            $('body').on('click', '.editRecibo', function() {
                var recibo_id = $(this).data('id');
                $.get("{{ route('recibos.index') }}" + '/' + recibo_id + '/edit', function(data) {
                    $('#modelHeading').html("Editar Compra");
                    $('#saveBtn').val("edit-book");
                    $('#recibo_id').val(data.id);
                    $('#cliente_id').val(data.cliente_id)
                    $('#fecha_entrega').val(data.fecha_entrega);
                    $('#numero').val(data.numero);
                    $('#importe').val(data.importe);
                    $('#concepto').val(data.concepto);
                })
            });





            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Save');

                $.ajax({
                    data: $('#reciboForm').serialize(),
                    url: "{{ route('recibos.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#reciboForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('No se pudo editar');
                    }
                });
            });






            $('body').on('click', '.printRecibo', function() {

                var recibo_id = $(this).data('id');

                $.get("{{ route('recibos.index') }}" + '/' + recibo_id + '/edit', function(data) {
                    $('#modelHeading').html("Imprimir Recibo");
                    $('#saveBtn').val("Imprimir");
                    $('#ajaxModel').modal('show');
                    $('#recibo_idM').val(data.id);
                    $('#numeroM').val(data.numero);
                })

            });





            $('body').on('click', '.deleteRecibo', function() {

                var recibo_id = $(this).data("id");

                var result = confirm("Eliminar Registro?");
                if (result) {

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('recibos.store') }}" + '/' + recibo_id,
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
