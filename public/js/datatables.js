function datatable(id) {
  $(id).DataTable({
    "language": {
      "lengthMenu": "Mostrar _MENU_ registros por pagina",
      "zeroRecords": "Nada encontrado",
      "info": "Mostrando la pagina _PAGE_ de _PAGES_",
      "infoEmpty": "No records available",
      "infoFiltered": "(Filtrado de _MAX_ registros totales)",
      "search": "Buscar",
      "paginate": {
        "next": "Siguiente",
        "previous": "Anterior"
      }
    },
    "dom": 'Bfrtip',
    "buttons": [
      'excel', {
        extend: 'pdf',
        text: 'PDF ',
        orientation: 'landscape',
        pageSize: 'LETTER',
      }
    ]
  });
}
