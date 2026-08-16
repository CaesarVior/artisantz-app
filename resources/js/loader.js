window.addEventListener("load", function () {
    const loading = document.getElementById("loadingOverlay");
    loading.classList.add("fade-out");
    setTimeout(() => loading.remove(), 600);
});
