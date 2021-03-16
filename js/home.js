$(document).ready(function() {
    $(document).on("click", "#sidebarToggleTop", function() {
        $("#page-top").toggleClass("sidebar-toggled");
        $("#accordionSidebar").toggleClass("toggled");
    });
    $(document).on("click", "#sidebarToggle", function() {
        $("#page-top").toggleClass("sidebar-toggled");
        $("#accordionSidebar").toggleClass("toggled");
    });
});