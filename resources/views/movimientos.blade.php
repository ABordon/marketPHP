@extends('adminlte::page')

@section('title', 'MarketSoft - Movimientos')

@section('content_header')
    <h1>Caja - Movimientos</h1>
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
            <h1 class="card-title">Registrar Inicial de Caja</h1>
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
            <div class="col-12 col-sm-12">
                <div class="card card-gray card-tabs">
                    <div class="card-header p-0 pt-1">
                        <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill"
                                    href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home"
                                    aria-selected="true">Efectivo</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill"
                                    href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile"
                                    aria-selected="false">Telefonía</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-one-messages-tab" data-toggle="pill"
                                    href="#custom-tabs-one-messages" role="tab" aria-controls="custom-tabs-one-messages"
                                    aria-selected="false">Cuenta Bancaria</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-one-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel"
                                aria-labelledby="custom-tabs-one-home-tab">
                                <div class="card-body">
                                    <form id="reciboForm" name="reciboForm">
                                        <div class="row">
        
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <!-- ID oculto -->
                                                    <input type="hidden" name="recibo_id" id="recibo_id">
        
                                                    <!-- Input efectivo GS -->
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-6 control-label">Guaraníes (PYG)</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" id="pyg" name="pyg"
                                                                placeholder="Ingresar importe en Guaraníes" value="" maxlength="15"
                                                                required="">
                                                        </div>
                                                    </div>
        
        
                                                    <!-- Input efectivo ARS -->
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-6 control-label">Pesos (ARS)</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" id="ars" name="ars"
                                                                placeholder="Ingresar importe en Pesos Argentinos" value=""
                                                                maxlength="15" required="">
                                                        </div>
                                                    </div>
        
                                                    <!-- Input efectivo USD -->
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-6 control-label">Dólares (USD)</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" id="usd" name="usd"
                                                                placeholder="Ingresar importe en Dólares Americanos" value=""
                                                                maxlength="15" required="">
                                                        </div>
                                                    </div>
        
                                                    <!-- Input efectivo BRL -->
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-6 control-label">Reales (BRL)</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" id="brl" name="brl"
                                                                placeholder="Ingresar importe en Reales Brasileros" value=""
                                                                maxlength="15" required="">
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
        
        
                            <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel"
                                aria-labelledby="custom-tabs-one-profile-tab">
                                <div class="card-body">
                                    <form id="reciboForm" name="reciboForm">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <!-- ID oculto -->
                                                    <input type="hidden" name="recibo_id" id="recibo_id">
        
                                                    <!-- Input TIGO -->
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-6 control-label">Tigo</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" id="tigo" name="tigo"
                                                                placeholder="Ingresar importe de Tigo" value="" maxlength="15"
                                                                required="">
                                                        </div>
                                                    </div>
        
                                                    <!-- Input CLARO -->
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-6 control-label">Claro</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" id="claro" name="claro"
                                                                placeholder="Ingresar importe de Claro" value="" maxlength="15"
                                                                required="">
                                                        </div>
                                                    </div>
        
                                                    <!-- Input PERSONAL -->
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-6 control-label">Personal</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" id="personal"
                                                                name="personal" placeholder="Ingresar importe de Personal" value=""
                                                                maxlength="15" required="">
                                                        </div>
                                                    </div>
        
                                                </div>
                                            </div>
        
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <!-- ID oculto -->
                                                    <input type="hidden" name="recibo_id" id="recibo_id">
        
                                                    <!-- Input TIGO -->
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-6 control-label">Giros Tigo</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" id="tigo_giros"
                                                                name="tigo_giros" placeholder="Ingresar importe de Giros Tigo" value=""
                                                                maxlength="15" required="">
                                                        </div>
                                                    </div>
        
                                                    <!-- Input CLARO -->
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-6 control-label">Giros Claro</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" id="claro_giros"
                                                                name="claro_giros" placeholder="Ingresar importe de Giros Claro" value=""
                                                                maxlength="15" required="">
                                                        </div>
                                                    </div>
        
                                                    <!-- Input PERSONAL -->
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-6 control-label">Giros Personal</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" id="personal_giros"
                                                                name="personal_giros" placeholder="Ingresar importe de Giros Personal"
                                                                value="" maxlength="15" required="">
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
        
        
                            <div class="tab-pane fade" id="custom-tabs-one-messages" role="tabpanel"
                                aria-labelledby="custom-tabs-one-messages-tab">
                                <div class="card-body">
                                    <form id="reciboForm" name="reciboForm">
                                        <div class="row">
        
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <!-- ID oculto -->
                                                    <input type="hidden" name="recibo_id" id="recibo_id">
        
                                                    <!-- Select de Bancos -->
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-8 control-label">Banco</label>
                                                        <div class="col-sm-12">
                                                            <select class="form-control" id="banco_nombre" name="banco_nombre">
                                                                    <option value="value1">Banco Familiar</option>
                                                            </select>
                                                        </div>
                                                    </div>
        
                                                    <!-- Input Importe banco -->
                                                    <div class="form-group">
                                                        <label for="name" class="col-sm-6 control-label">Importe</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" class="form-control" id="banco_importe"
                                                                name="banco_importe"
                                                                placeholder="Ingresar importe de Cuenta Bancaria" value=""
                                                                maxlength="15" required="">
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
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>


    <div class="card card-default">

        <div class="card-header card-primary">
            <h1 class="card-title">Registrar Cierre de Caja</h1>
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
            <form id="cierreForm" name="cierreForm">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <!-- ID oculto -->
                            <input type="hidden" name="inicial_id" id="inicial_id">


                            <!-- Input de Guaranies -->
                            <div class="form-group">
                                <label class="col-sm-12 control-label">Guaraníes</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="gs" name="gs"
                                        placeholder="Ingresar importe en Guaraníes PYG" value="" maxlength="12"
                                        required="">
                                </div>
                            </div>

                            <!-- Input de Pesos -->
                            <div class="form-group">
                                <label class="col-sm-12 control-label">Pesos Argentinos</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="ps_arg" name="ps_arg"
                                        placeholder="Ingresar importe en Pesos ARS" value="" maxlength="12"
                                        required="">
                                </div>
                            </div>

                            <!-- Input de Dolares -->
                            <div class="form-group">
                                <label class="col-sm-12 control-label">Dólares Americanos</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="usd" name="usd"
                                        placeholder="Ingresar importe en Dólares USD" value="" maxlength="12"
                                        required="">
                                </div>
                            </div>

                            <!-- Input de Reales -->
                            <div class="form-group">
                                <label class="col-sm-12 control-label">Reales</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="rs" name="rs"
                                        placeholder="Ingresar importe en Reales BRL" value="" maxlength="12"
                                        required="">
                                </div>
                            </div>





                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-3">
                        
                        <!-- Input de Tigo -->
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Tigo</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="tigo" name="tigo"
                                    placeholder="Ingresar importe en saldo de TIGO" value="" maxlength="12"
                                    required="">
                            </div>
                        </div>

                        <!-- Input de Claro -->
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Claro</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="claro" name="claro"
                                    placeholder="Ingresar importe en saldo de TIGO" value="" maxlength="12"
                                    required="">
                            </div>
                        </div>

                        <!-- Input de Tigo -->
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Personal</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="personal" name="personal"
                                    placeholder="Ingresar importe en saldo de TIGO" value="" maxlength="12"
                                    required="">
                            </div>
                        </div>

                        
                    </div>


                    <div class="col-md-3">
                        
                        <!-- Input de Tigo -->
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Tigo</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="tigo" name="tigo"
                                    placeholder="Ingresar importe en saldo de TIGO" value="" maxlength="12"
                                    required="">
                            </div>
                        </div>

                        <!-- Input de Claro -->
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Claro</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="claro" name="claro"
                                    placeholder="Ingresar importe en saldo de TIGO" value="" maxlength="12"
                                    required="">
                            </div>
                        </div>

                        <!-- Input de Personal -->
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Personal</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="personal" name="personal"
                                    placeholder="Ingresar importe en saldo de TIGO" value="" maxlength="12"
                                    required="">
                            </div>
                        </div>

                        
                    </div>



                    <div class="col-md-3">
                        
                        <!-- Input de Banco -->
                        <div class="form-group">
                            <label class="col-sm-12 control-label">Banco</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="banco" name="banco"
                                    placeholder="Ingresar importe en gs de Banco" value="" maxlength="12"
                                    required="">
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



                ajax: "{{ route('movimientos.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'tipo_movimiento',
                        name: 'tipo_movimiento'
                    },
                    {
                        data: 'descripcion',
                        name: 'descripcion'
                    },
                    {
                        data: 'importe',
                        name: 'importe'
                    },
                    {
                        data: 'referencia',
                        name: 'referencia'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });


            $('#CrearNuevoMovimiento').click(function() {
                $('#saveBtn').val("create-book");
                $('#id_movimiento').val('');
                $('#movimientoForm').trigger("reset");
                $('#modelHeading').html("Registrar Movimiento");
                $('#ajaxModel').modal('show');
            });


            $('body').on('click', '.editMovimiento', function() {
                var id_movimiento = $(this).data('id');
                $.get("{{ route('movimientos.index') }}" + '/' + id_movimiento + '/edit', function(data) {
                    $('#modelHeading').html("Editar Pedido");
                    $('#saveBtn').val("edit-book");
                    $('#ajaxModel').modal('show');
                    $('#id_movimiento').val(data.id);
                    $('#tipo_movimiento').val(data.tipo_movimiento);
                    $('#descripcion').val(data.descripcion);
                    $('#referencia').val(data.referencia);
                    $('#importe').val(data.importe);
                })
            });


            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Save');

                $.ajax({
                    data: $('#movimientoForm').serialize(),
                    url: "{{ route('movimientos.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#movimientoForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        table.draw();

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#saveBtn').html('No se pudo editar');
                    }
                });
            });


            $('body').on('click', '.deleteMovimiento', function() {

                var id_movimiento = $(this).data("id");

                var result = confirm("Eliminar Registro?");
                if (result) {

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('movimientos.store') }}" + '/' + id_movimiento,
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
