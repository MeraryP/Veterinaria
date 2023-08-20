

$(document).ready(function() {
    $('#mitabla').DataTable({
        dom: 'lBfrtip',
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
        rowCallback: function(row, data, index) {
        // Agregue el índice autoincrementable a la primera celda de la fila
        $('td:eq(0)', row).html(index + 1);
        },       
language: {
            "lengthMenu": "Mostrar _MENU_ resultados",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay resultados disponibles",
            "infoFiltered": "(filtrado de _MAX_ total registros)",
            "search": '<i class="fa fa-search" aria-hidden="true" style="color:grey;"></i> Buscar',
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    });


});
