@extends('adminlte::page')

@section('title', 'MarketSoft - Pedidos')

@section('content_header')
    <h1>Proveedores - Pedidos</h1>
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

    <div class='card card-outline card-success'>

        <body>
            <div class="card-body">
                <div class="row">
                    <a class="btn btn-primary" href="javascript:void(0)" id="CrearNuevoPedido"> Registrar Pedido</a>
                </div>


            </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-hover table-bordered data-table">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>#</th>
                        <th>Fecha Entrega</th>
                        <th>Proveedor</th>
                        <th>Importe</th>
                        <th>Descripción</th>
                        <th width="200px">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>




    <div class="modal fade" id="ajaxModel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="modelHeading"></h3>
                </div>
                <div class="modal-body">
                    <form id="pedidoForm" name="pedidoForm" class="form-horizontal">
                        <input type="hidden" name="pedido_id" id="pedido_id">

                        <!-- Select de Proveedor -->
                        <div class="form-group">
                            <label for="name" class="col-sm-8 control-label">Proveedor</label>
                            <div class="col-sm-12">
                                <select class="form-control" id="proveedor_id" name="proveedor_id">
                                    @foreach ($providers as $provider)
                                        <option value="{{ $provider['id'] }}">{{ $provider['razon_social'] }} | RUC:
                                            {{ $provider['ruc'] }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="col-sm-2 control-label">Importe</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="importe" name="importe"
                                    placeholder="Ingresar Importe" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Descripción</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="descripcion" name="descripcion"
                                    placeholder="Ingresar descripción" value="" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-4 control-label">Fecha Entrega</label>
                            <div class="col-sm-12">
                                <input type="date" id="fecha" name="fecha" class="form-control"
                                    value="{{ old('inicia_en') }}">
                            </div>
                        </div>

                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Guardar
                            </button>
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

                ajax: "{{ route('pedidos.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'fecha_entrega',
                        name: 'fecha_entrega'
                    },
                    {
                        data: 'proveedor_id',
                        name: 'proveedor_id'
                    },
                    {
                        data: 'importe',
                        name: 'importe'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            $('#CrearNuevoPedido').click(function() {
                $('#saveBtn').val("create-book");
                $('#pedido_id').val('');
                $('#pedidoForm').trigger("reset");
                $('#modelHeading').html("Registrar Pedido");
                $('#ajaxModel').modal('show');
            });


            $('body').on('click', '.editPedido', function() {
                var pedido_id = $(this).data('id');
                $.get("{{ route('pedidos.index') }}" + '/' + pedido_id + '/edit', function(data) {
                    $('#modelHeading').html("Editar Pedido");
                    $('#saveBtn').val("edit-book");
                    $('#ajaxModel').modal('show');
                    $('#pedido_id').val(data.id);
                    $('#proveedor_id').val(data.proveedor_id);
                    $('#importe').val(data.importe);
                    $('#descripcion').val(data.descripcion);
                    $('#fecha').val(data.fecha_entrega)
                })
            });


            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Save');

                $.ajax({
                    data: $('#pedidoForm').serialize(),
                    url: "{{ route('pedidos.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#pedidoForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('No se pudo editar');
                    }
                });
            });


            $('body').on('click', '.deletePedido', function() {

                var pedido_id = $(this).data("id");

                var result = confirm("Eliminar Registro?");
                if (result) {

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('pedidos.store') }}" + '/' + pedido_id,
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
