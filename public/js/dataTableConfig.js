function datatable({
  id,
  props
}) {
  return $(id).DataTable({
    "language": {
      "lengthMenu": "Mostrar _MENU_ registros por pagina",
      "zeroRecords": "Nada encontrado",
      "info": "Mostrando la pagina _PAGE_ de _PAGES_",
      "infoEmpty": " No hay registros disponibles",
      "infoFiltered": "(Filtrado de _MAX_ registros totales)",
      "search": "Buscar",
      "paginate": {
        "next": "Siguiente",
        "previous": "Anterior"
      }
    },
    "dom": 'Bfrtip',
    "buttons": [{
      extend: 'pdf',
      text: 'PDF ',
      title: props.fileName,
      orientation: 'landscape',
      pageSize: 'LETTER',
      exportOptions: {
        columns: props.columns
      }
    }, {
      extend: 'excel',
      text: 'Excel ',
      title: props.fileName,
      exportOptions: {
        columns: props.columns
      }
    }],
    order: props.orderBy,
    scrollX: props.scroll,
  });
}
