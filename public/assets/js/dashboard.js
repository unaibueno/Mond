//PONE EL CONTADOR A 0
var count_click = 0;

//AÑADE UN CLICK AL EJECUTAR LA FUNCIÓN
function count_click_add() {
  count_click += 1;
}

//MUESTRA CUANTOS CLICK LLEVAMOS
$("#count_click").text(count_click);

//AÑADE A TODOS LOS BOTONES CON EL NAME count_click QUE AL SER PULSADOS EJECUTEN EL CONTADOR
$(document).ready(function () {
  $("button[name='count_click']").click(function () {
    count_click_add();
  });
});
