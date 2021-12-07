@extends('adminlte::page')

@section('title', 'MarketSoft - Artículos')

@section('content_header')
    <h1>Artículos - Registro</h1>
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



    <!-- Header -->
    
    <div class="card card-default">

        <div class="card-header card-primary">
            <h1 class="card-title">Registrar Artículo</h1>

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
            <form id="articleForm" name="articleForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- ID oculto -->
                            <input type="hidden" name="article_id" id="article_id">


                            <!-- Input de Codigo -->
                            <div class="form-group">
                                <label class="col-sm-8 control-label">Código de Barras o Genérico</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="codigo" name="codigo"
                                        placeholder="Ingresar código de Barras o Genérico" value="" maxlength="50"
                                        required="">
                                </div>
                            </div>

                            <!-- Input de Descripcion -->
                            <div class="form-group">
                                <label class="col-sm-8 control-label">Descripción</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="descripcion" name="descripcion"
                                        placeholder="Ingresar descripción del artículo: Marca+Producto+Modelo+UDM" value=""
                                        maxlength="200" required="">
                                </div>
                            </div>

                            <!-- Input de Precio Costo -->
                            <div class="form-group">
                                <label class="col-sm-8 control-label">Precio Costo</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="costo" name="costo"
                                        placeholder="Ingresar precio de costo" value="" maxlength="10" required="">
                                </div>
                            </div>

                            <!-- Input de Precio Venta -->
                            <div class="form-group">
                                <label class="col-sm-8 control-label">Precio Venta</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="venta" name="venta"
                                        placeholder="Ingresar precio de venta" value="" maxlength="10" required="">
                                </div>
                            </div>




                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- Input de Stock Minimo -->
                            <div class="form-group">
                                <label class="col-sm-8 control-label">Stock Mínimo</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="stock_minimo" name="stock_minimo"
                                        placeholder="Ingresar cantidad mínima de stock" value="" maxlength="10" required="">
                                </div>
                            </div>


                            <!-- Select de IVA -->
                            <div class="form-group">
                                <label for="name" class="col-sm-8 control-label">IVA</label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="iva_id" name="iva_id">
                                        @foreach ($ivas as $iva)
                                            <option value="{{ $iva['id'] }}">{{ $iva['descripcion'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

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
                        </div>
                    </div>
                    <!-- /.col -->


                    <!-- Boton Guardar -->
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="button" class="btn btn-primary" id="saveBtn" value="create">Guardar
                        </button>
                    </div>
                </div>
            </form>
            <!-- /.row -->
        </div>
    </div>




    <div class="card">
        <div class="card-body">
            <table class="table table-hover table-bordered data-table">
                <thead class="bg-secondary text-white">
                    <tr>
                        <th>#</th>
                        <th>Código</th>
                        <th>Descripción</th>
                        <th>Precio Venta</th>
                        <th>Proveedor</th>
                        <th>IVA</th>
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

                ajax: "{{ route('articles.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'codigo',
                        name: 'codigo'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    },
                    {
                        data: 'venta',
                        name: 'venta'
                    },
                    {
                        data: 'proveedor_id',
                        name: 'proveedor_id'
                    },
                    {
                        data: 'iva_id',
                        name: 'iva_id'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            $('#CrearNuevoArticulo').click(function() {
                $('#saveBtn').val("create-book");
                $('#article_id').val('');
                $('#articleForm').trigger("reset");
                $('#modelHeading').html("Registrar Artículo");
                $('#ajaxModel').modal('show');
            });


            $('body').on('click', '.editArticle', function() {
                var article_id = $(this).data('id');
                $.get("{{ route('articles.index') }}" + '/' + article_id + '/edit', function(data) {
                    $('#modelHeading').html("Editar Artículo");
                    $('#saveBtn').val("edit-book");
                    $('#ajaxModel').modal('show');
                    $('#article_id').val(data.id);
                    $('#codigo').val(data.codigo)
                    $('#descripcion').val(data.descripcion);
                    $('#costo').val(data.costo);
                    $('#venta').val(data.venta);
                    $('#stock_minimo').val(data.stock_minimo);
                    $('#iva_id').val(data.iva_id);
                    $('#proveedor_id').val(data.proveedor_id);
                })
            });


            $('#buscarBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Buscar');

                $.ajax({
                    data: $('#articleForm').serialize(),
                    url: "{{ route('articles.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#articleForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('No se pudo editar');
                    }
                });
            });


            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Guardar');

                $.ajax({
                    data: $('#articleForm').serialize(),
                    url: "{{ route('articles.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#articleForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('No se pudo editar');
                    }
                });
            });


            $('body').on('click', '.deleteArticle', function() {

                var article_id = $(this).data("id");

                var result = confirm("Eliminar Registro?");
                if (result) {

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('articles.store') }}" + '/' + article_id,
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
