import Auth from '../auth/auth.js';  // Mengimpor Auth.js

// Inisialisasi Auth dengan URL login
const auth = new Auth('/login');

// Cek apakah token ada dan valid
auth.checkToken();