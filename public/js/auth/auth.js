class Auth {
    constructor(loginUrl) {
        this.loginUrl = loginUrl;
        toastr.options = {
            progressBar: true,
        };
    }

    /**
     * Fungsi untuk memeriksa token dan apakah kadaluarsa atau tidak
     */
    checkToken() {
        const token = localStorage.getItem('access_token');

        if (!token) {
            this.redirectToLogin();
            return;
        }

        const tokenExpiry = this.getTokenExpiry(token);
        if (this.isTokenExpired(tokenExpiry)) {
            this.redirectToLogin();
        }
    }

    /**
     * Mengambil waktu kadaluarsa token dari payload JWT
     * @param {string} token
     * @returns {number} Waktu kadaluarsa dalam milidetik
     */
    getTokenExpiry(token) {
        const payload = this.decodeJwt(token);
        return payload.exp * 1000; // Mengembalikan waktu kadaluarsa dalam milidetik
    }

    /**
     * Memeriksa apakah token sudah kadaluarsa
     * @param {number} expiryTime
     * @returns {boolean}
     */
    isTokenExpired(expiryTime) {
        return Date.now() > expiryTime;
    }

    /**
     * Dekode JWT token
     * @param {string} token
     * @returns {Object} Payload dari token
     */
    decodeJwt(token) {
        const base64Url = token.split('.')[1];
        const base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
        const jsonPayload = decodeURIComponent(atob(base64).split('').map(function(c) {
            return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
        }).join(''));

        return JSON.parse(jsonPayload);
    }

    /**
     * Fungsi untuk mengarahkan ke halaman login
     */
    redirectToLogin() {
        // Hapus token dari localStorage
        localStorage.removeItem('access_token');
        
        // Tampilkan pesan dan arahkan ke halaman login
        toastr.error('Session Anda telah berakhir. Silakan login ulang.', 'Perhatian', {timeOut: 2100});
        setTimeout(() => {
            window.location.href = this.loginUrl;
        }, 2000);  // 2000 ms = 2 detik
    }
}

export default Auth;
