document.addEventListener('DOMContentLoaded', function() {
    var elems = document.querySelectorAll('select');
    M.FormSelect.init(elems);
  });

 function validar(){

   let labs = document.getElementById("laboratorio");
   let stock = document.getElementById("stock");
   let precio = document.getElementById("precio");
   let detalle = document.getElementById("detalle");

   if(labs.selectedIndex == 0){
     console.log(labs.selectedIndex);
     alert("Debes seleccionar un laboratorio");
     return false;
   }

   if(stock.value == '' || stock.value <= 0){
     alert("El stock debe ser mayor a 0");
     return false;
   }
   if(precio.value == '' || precio.value <= 0){
     alert("El precio debe ser mayor a 0");
     return false;
   }

   if(detalle.value.length <= 0 || detalle.value.length > 250){
     alert("El detalle debe ser mayor a 0 y menor a 250 caracteres");
     return false;
   }

   return true;
}