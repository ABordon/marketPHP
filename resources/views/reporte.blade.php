

@section('title', 'MarketSoft - Compras')

@section('content_header')
    <h1>Compras - Reporte</h1>
@stop


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Compras - Reporte</title>
        <link rel="stylesheet" type="test/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
        <link rel="stylesheet" type="test/css"
            href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    </head>

    <body>

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
                            <th>Proveedor</th>
                            <th>Nro Factura</th>
                            <th>Timbrado</th>
                            <th>Importe 5%</th>
                            <th>Importe 10%</th>
                            <th>Total</th>
                        </tr>
                    </thead>

                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>

        </table>


        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>



        <script type="text/javascript">
            $(document).ready(function() {

                $('#example').DataTable({

                    dom: 'lBfrtip',
                    buttons: [
                        'copy', 'csv', 'excel', 'pdf', 'print'
                    ],

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
                            data: 'razon_social',
                            name: 'razon_social'
                        },
                        {
                            data: 'nro_factura',
                            name: 'nro_factura'
                        },
                        {
                            data: 'timbrado',
                            name: 'timbrado'
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
                    ]


                });


            });
        </script>

    </body>

    </html>
