// Define data atual no campo de data
  document.addEventListener("DOMContentLoaded", function () {
    const dataInput = document.getElementById('dataReuniao');
    if (dataInput) {
      dataInput.value = new Date().toISOString().split('T')[0];
    }
  });