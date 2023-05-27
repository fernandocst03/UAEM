function countStaff(hombres, mujeres, spanTotal) {
  let total = parseInt(hombres.value | 0) + parseInt(mujeres.value | 0);
  document.getElementById(spanTotal).innerHTML = total;
}
