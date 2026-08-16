toastr.options = {
    positionClass: "toast-top-right",
    progressBar: true,
    closeButton: true,
    newestOnTop: true,
    timeOut: 2000,
    extendedTimeOut: 1000,
    showEasing: "swing",
    hideEasing: "linear",
    showMethod: "fadeIn",
    hideMethod: "fadeOut",
    tapToDismiss: false,
    opacity: 1
};

document.getElementById("logoutBtn").addEventListener("click", async function () {
    const language = localStorage.getItem("locale") || "id";

    try {
        const response = await fetch("/api/v1/auth/logout", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                // Jika pakai token:
                // "Authorization": "Bearer YOUR_TOKEN_HERE"
            },
            credentials: "include" // untuk cookie-based auth
        });

        if (response.ok) {
            toastr.success(
                language === 'en' ? "You will be redirected to the login page" : "Anda akan dialihkan ke halaman login",
                language === 'en' ? "Successfully logged out" : "Berhasil logout"
            );
            setTimeout(() => window.location.href = '/login', 2200);
        } else {
            toastr.error(language === 'en' ? "Logout failed" : "Gagal logout");
        }
    } catch (error) {
        console.error("Logout error:", error);
        toastr.error(language === 'en' ? "An error occurred while logging out" : "Terjadi kesalahan saat logout");
    }
});
