document.addEventListener("DOMContentLoaded", () => {
  const contenedor = document.querySelector(".container");

  if (contenedor) {
    contenedor.style.opacity = 0;
    contenedor.style.transform = "translateY(20px)";
    setTimeout(() => {
      contenedor.style.transition = "all 0.6s ease";
      contenedor.style.opacity = 1;
      contenedor.style.transform = "translateY(0)";
    }, 100);
  }
});
