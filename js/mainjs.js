;(function () {
 // Obtener elementos del DOM
 const modal = document.getElementById("myModal");
 const openModalBtn = document.getElementById("openModalBtn");
 const closeModalBtn = document.getElementById("closeModalBtn");
 
 // Cuando se hace clic en el botón "+" abre el modal
 openModalBtn.addEventListener("click", function() {
     modal.style.display = "block";
 });
 
 // Cuando se hace clic en el botón "x" cierra el modal
 closeModalBtn.addEventListener("click", function() {
    closeModalBtn.onclick = function() {
        modal.style.display = "none";
     
 }});

 
 // Cuando se hace clic fuera del contenido del modal, también se cierra
 window.addEventListener("click", function(event) {
     if (event.target === modal) {
         modal.style.display = "none";
     }
 });

}());

$('.owl-carousel').owlCarousel({
    loop: true,
    margin: 30,
    nav: true,
    responsive: {
        0: {
            items: 1
        },
        600: {
            items: 2
        },
        1000: {
            items: 3
        }
    }
});