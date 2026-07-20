document.addEventListener("DOMContentLoaded", function () {
    var sidebar = document.getElementById("appSidebar");
    var backdrop = document.getElementById("appSidebarBackdrop");
    var toggleBtn = document.getElementById("sidebarToggle");

    function openSidebar() {
        sidebar.classList.add("is-open");
        backdrop.classList.add("is-open");
    }

    function closeSidebar() {
        sidebar.classList.remove("is-open");
        backdrop.classList.remove("is-open");
    }

    if (toggleBtn && sidebar && backdrop) {
        toggleBtn.addEventListener("click", function () {
            if (sidebar.classList.contains("is-open")) {
                closeSidebar();
            } else {
                openSidebar();
            }
        });

        backdrop.addEventListener("click", closeSidebar);
    }

    // Auto-dismiss flash alerts after a while.
    document.querySelectorAll(".alert[data-autohide]").forEach(function (alert) {
        setTimeout(function () {
            alert.style.transition = "opacity 0.4s ease";
            alert.style.opacity = "0";
            setTimeout(function () {
                alert.remove();
            }, 400);
        }, 4000);
    });
});
