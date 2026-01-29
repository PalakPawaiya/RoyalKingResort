document.addEventListener("DOMContentLoaded", function () {
  const sidebar = document.getElementById("sidebar");
  const sidebarToggle = document.getElementById("sidebarToggle");
  const content = document.getElementById("content");

  sidebarToggle.addEventListener("click", () => {
    sidebar.classList.toggle("collapsed");
    content.classList.toggle("expanded");
  });
});
