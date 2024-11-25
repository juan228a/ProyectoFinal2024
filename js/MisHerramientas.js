function confirmDelete() {
    document.getElementById("delete-modal").style.display = "flex";
  }
  
  function closeModal() {
    document.getElementById("delete-modal").style.display = "none";
  }
  
  function deleteTool() {
    alert("La herramienta ha sido eliminada.");
    closeModal();
  }
  
  function editTool() {
    window.open("formulario_editar.html", "_blank");
  }