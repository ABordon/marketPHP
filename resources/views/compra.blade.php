@extends('adminlte::page')

@section('title', 'MarketSoft - Compras')

@section('content_header')
    <h1>Compras - Registro</h1>
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

        <link href="https://cdn.datatables.net/buttons/1.10.16/css/buttons.dataTables.min.css" rel="stylesheet">
    </head>




    <!-- Card de Formulario estático de Registro de Compra -->

    <!-- Header -->
    <div class="card card-default">
        <div class="card-header card-primary">
            <h1 class="card-title">Registrar Compra</h1>

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
            <form id="compraForm" name="compraForm">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- ID oculto -->
                            <input type="hidden" name="compra_id" id="compra_id">


                            <!-- Input de fecha emision -->
                            <div class="form-group">
                                <label class="col-sm-4 control-label">Fecha de Emisión</label>
                                <div class="col-sm-12">
                                    <input type="date" id="fecha_emision" name="fecha_emision" class="form-control"
                                        value="{{ old('inicia_en') }}">
                                </div>
                            </div>


                            <!-- Select de Proveedor -->
                            <div class="form-group" data-select2-id="29">
                                <label for="name" class="col-sm-8 control-label">Proveedor</label>
                                <div class="col-sm-12">
                                    <select class="form-control select2-container--focus" id="proveedor_id"
                                        name="proveedor_id">
                                        @foreach ($providers as $provider)
                                            <option value="{{ $provider['id'] }}">{{ $provider['razon_social'] }} | RUC:
                                                {{ $provider['ruc'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>



                            <!-- Select de Tipo de Factura -->
                            <div class="form-group">
                                <label for="name" class="col-sm-8 control-label">Tipo de Compra</label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="tipo_id" name="tipo_id">
                                        @foreach ($tipos as $tipo)
                                            <option value="{{ $tipo['id'] }}">{{ $tipo['descripcion'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <!-- Select de condicion de compra -->
                            <div class="form-group">
                                <label for="name" class="col-sm-8 control-label">Condición de Compra</label>
                                <div class="col-sm-12">
                                    <select class="form-control" id="condicion_id" name="condicion_id">
                                        @foreach ($condiciones as $condicion)
                                            <option value="{{ $condicion['id'] }}">{{ $condicion['descripcion'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <!-- Input numero de factura -->
                            <div class="form-group">
                                <label for="name" class="col-sm-8 control-label">Número de Factura</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="nro_factura" name="nro_factura"
                                        placeholder="Ingresar número de factura" value="" maxlength="15" required="">
                                </div>
                            </div>


                            <!-- Input de timbrado -->
                            <div class="form-group">
                                <label for="name" class="col-sm-8 control-label">Número de Timbrado</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="timbrado" name="timbrado"
                                        placeholder="Ingresar número de Timbrado" value="" maxlength="8" required="">
                                </div>
                            </div>



                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <!-- Input de Importe Cinco -->
                            <div class="form-group">
                                <label class="col-sm-12 control-label">Importe 5%</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="cinco" name="cinco"
                                        placeholder="Ingresar importe del 5%" value="" maxlength="10" required="">
                                </div>
                            </div>


                            <!-- Input de Importe Diez -->
                            <div class="form-group">
                                <label class="col-sm-8 control-label">Importe 10%</label>
                                <div class="col-sm-12">
                                    <input type="number" class="form-control" id="diez" name="diez"
                                        placeholder="Ingresar importe del 10%" value="" maxlength="10" required="">
                                </div>
                            </div>


                            <!-- Input de Total -->
                            <div class="form-group">
                                <label class="col-sm-8 control-label">Importe Total</label>
                                <div class="col-sm-12">
                                    <input type="hidden" type="number" readonly class="form-control" id="total"
                                        name="total" placeholder="0" value="" maxlength="10" required="">
                                </div>
                                <div class="col-sm-12">
                                    <input type="text" readonly class="form-control" id="totalv" name="totalv"
                                        placeholder="0" value="" maxlength="10" required="">
                                </div>
                            </div>


                            <!-- Input de Iva cinco -->
                            <div class="form-group">
                                <label class="col-sm-8 control-label">Importe IVA 5%</label>
                                <div class="col-sm-12">
                                    <input type="hidden" readonly class="form-control" id="iva_cinco" name="iva_cinco"
                                        placeholder="0" value="" maxlength="10" required="">
                                </div>
                                <div class="col-sm-12">
                                    <input type="number" type="number" readonly class="form-control" id="iva_cincov"
                                        name="iva_cincov" placeholder="0" value="" maxlength="10" required="">
                                </div>
                            </div>


                            <!-- Input de Iva diez -->
                            <div class="form-group">
                                <label class="col-sm-8 control-label">Importe IVA 10%</label>
                                <div class="col-sm-12">
                                    <input type="hidden" readonly class="form-control" id="iva_diez" name="iva_diez"
                                        placeholder="0" value="" maxlength="10" required="">
                                </div>
                                <div class="col-sm-12">
                                    <input type="number" type="number" readonly class="form-control" id="iva_diezv"
                                        name="iva_diezv" placeholder="0" value="" maxlength="10" required="">
                                </div>
                            </div>


                            <!-- Input de Iva Total -->
                            <div class="form-group">
                                <label class="col-sm-8 control-label">Importe IVA Total</label>
                                <div class="col-sm-12">
                                    <input type="hidden" readonly class="form-control" id="iva_total" name="iva_total"
                                        placeholder="0" value="" maxlength="10" required="">
                                </div>
                                <div class="col-sm-12">
                                    <input type="number" type="number" readonly class="form-control" id="iva_totalv"
                                        name="iva_totalv" placeholder="0" value="" maxlength="10" required="">
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


    <!-- Tabla 0 -->
    <div class="card">
        <div class="card-body">
            <table id="example" class="display data-table" style="width:100%">
                <div class="row">

                </div>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Condicion</th>
                        <th>Proveedor</th>
                        <th>Nro Factura</th>
                        <th>Importe 5%</th>
                        <th>Importe 10%</th>
                        <th>Total</th>
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>


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



                ajax: "{{ route('compras.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'fecha_emision',
                        name: 'fecha_emision'
                    },
                    {
                        data: 'condicion_id',
                        name: 'condicion_id'
                    },
                    {
                        data: 'razon_social',
                        name: 'razon_social'
                    },
                    {
                        data: 'nro_factura',
                        name: 'nro_factura'
                    },
                    {
                        data: 'cinco',
                        name: 'cinco'
                    },
                    {
                        data: 'diez',
                        name: 'diez'
                    },
                    {
                        data: 'total',
                        name: 'total'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]


            });

            //focus a proveedor al cargar la pagina
            document.getElementById("fecha_emision").focus();


            //Funcion formula para IVA 5
            document.getElementById("cinco").addEventListener("input",
                function funcionCinco() {
                    sumatotal();
                    var x = parseFloat(document.getElementById("cinco").value);
                    var y = (x / 21).toFixed(0);
                    document.getElementById("iva_cinco").value = y;
                    document.getElementById("iva_cincov").value = formatNumber.new(y);
                    sumaiva();
                });


            //Funcion formula para IVA 10
            document.getElementById("diez").addEventListener("input",
                function funcionDiez() {
                    sumatotal();
                    var x = parseFloat(document.getElementById("diez").value)
                    var c = (x / 11).toFixed(0);
                    document.getElementById("iva_diez").value = c;
                    document.getElementById("iva_diezv").value = formatNumber.new(c);
                    sumaiva();
                });


            //Funcion formula para sumatoria de subtotales
            function sumatotal() {
                var sumadiez = parseFloat(document.getElementById("diez").value);
                var sumacinco = parseFloat(document.getElementById("cinco").value);
                var tt = sumadiez + sumacinco;
                document.getElementById("total").value = tt;
                document.getElementById("totalv").value = formatNumber.new(tt);
            }


            //Funcion formula para sumatoria de IVA
            function sumaiva() {
                var sumaivadiez = parseFloat(document.getElementById("iva_cinco").value);
                var sumaivacinco = parseFloat(document.getElementById("iva_diez").value);
                document.getElementById("iva_total").value = sumaivadiez + sumaivacinco;
                document.getElementById("iva_totalv").value = formatNumber.new(sumaivadiez + sumaivacinco);
            }


            //Aplicar separados de miles
            var formatNumber = {
                separador: ".", // separador para los miles
                formatear: function(num) {
                    num += '';
                    var splitStr = num.split('.');
                    var splitLeft = splitStr[0];
                    var splitRight = splitStr.length > 1 ? splitStr[1] : '';
                    var regx = /(\d+)(\d{3})/;
                    while (regx.test(splitLeft)) {
                        splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
                    }
                    return splitLeft + splitRight;
                },
                new: function(num) {
                    return this.formatear(num);
                }
            }




            $('body').on('click', '.editCompra', function() {
                var compra_id = $(this).data('id');
                $.get("{{ route('compras.index') }}" + '/' + compra_id + '/edit', function(data) {
                    $('#modelHeading').html("Editar Compra");
                    $('#saveBtn').val("edit-book");
                    //$('#ajaxModel').modal('show');
                    $('#compra_id').val(data.id);
                    $('#proveedor_id').val(data.proveedor_id)
                    $('#tipo_id').val(data.tipo_id);
                    $('#condicion_id').val(data.condicion_id);
                    $('#nro_factura').val(data.nro_factura);
                    $('#timbrado').val(data.timbrado);
                    $('#fecha_emision').val(data.fecha_emision);
                    $('#cinco').val(data.cinco);
                    $('#diez').val(data.diez);
                    $('#total').val(data.total);
                    $('#iva_cinco').val(data.iva_cinco);
                    $('#iva_diez').val(data.iva_diez);
                    $('#iva_total').val(data.iva_total);
                })
            });


            $('#saveBtn').click(function(e) {
                e.preventDefault();
                $(this).html('Guardar');

                $.ajax({
                    data: $('#compraForm').serialize(),
                    url: "{{ route('compras.store') }}",
                    type: "POST",
                    dataType: 'json',
                    success: function(data) {

                        $('#compraForm').trigger("reset");
                        $('#ajaxModel').modal('hide');
                        alert("Guardado con éxito.");
                        table.draw();
                        //focus a proveedor al cargar la pagina
                        document.getElementById("fecha_emision").focus();

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        alert("Guardado sin éxito.", data);
                    }
                });
            });


            $('body').on('click', '.deleteCompra', function() {

                var compra_id = $(this).data("id");

                var result = confirm("Eliminar Registro?");
                if (result) {

                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('compras.store') }}" + '/' + compra_id,
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
