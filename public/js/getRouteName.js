const ROUTES = {
  '/': 'Inicio',
  'acuerdos-cu': 'Acuerdos CU',
  'samaras': 'Samaras',
  'bitacoras': 'Reporte Bitacoras',
  'sesiones': 'Sesiones',
  'rectorados': 'Rectorados',
  'acuerdos': 'Acuerdos',
  'reportes': 'Reporte Acuerdos',
  'formato-911': 'Formato 911',
  'personal-administrativo': 'Personal Administrativo',
  'personal-docente': 'Personal Docente',
  'personal-docente-antiguedad': 'Personal Docente por Antguedad',
  'personal-docente-edad': 'Personal Docente por Edades',
  'infraestructuras': 'Infraestructuras',
  'unidades-academicas': 'Unidades Academicas',
}
function getRouteName() {
  let pathname = window.location.pathname
  routeSplit = pathname.split('/');
  routeName = routeSplit[2] ? routeSplit[2] : routeSplit[1];
  if (routeName) {
    routeSection = ROUTES[routeName]
    document.title = 'UAEM-' + routeSection;
  }
}
