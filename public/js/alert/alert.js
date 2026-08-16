// File: notifikasi.js
export async function  showSuccessAlert(message = 'Data berhasil disimpan.') {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: message,
        showConfirmButton: false,
        timer: 2000
    });
}

export async function  showErrorAlert(message = 'Terjadi kesalahan saat menyimpan data.') {
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: message,
        showConfirmButton: true
    });
}

export async function  showWarningAlert(message = 'Apakah Anda yakin ingin melanjutkan?') {
    Swal.fire({
        icon: 'warning',
        title: 'Peringatan!',
        text: message,
        showConfirmButton: true
    });
}

export async function  showInfoAlert(message = 'Proses sedang berjalan, silakan tunggu.') {
    Swal.fire({
        icon: 'info',
        title: 'Informasi',
        text: message,
        showConfirmButton: true
    });
}

export async function showLoadingToast(title, text = '') {
    const swalInstance = Swal.fire({
        title: title,
        text: text,
        icon: 'info',
        showConfirmButton: false,
        allowOutsideClick: false,
        allowEscapeKey: false,
        allowEnterKey: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    return {
        close: () => Swal.close()
    };
}


export const showAlertDialog = async (
  title = "Email Sudah Terkirim!", 
  text = "Silakan periksa email Anda untuk melanjutkan proses. Jika tidak ada di inbox, cek folder spam. Pilih 'Ya' untuk membuka email, atau 'Kembali' untuk menuju halaman loading."
) => {
  const result = await Swal.fire({
    title: title,
    text: text,
    icon: 'success',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya',
    cancelButtonText: 'Kembali'
  });

  if (result.isConfirmed) {
    window.location.href = 'https://mail.google.com'; 
  } else {
    // Perbaikan di sini untuk navigasi ke halaman login
    window.location.href = `${window.location.origin}/login`; // Mengarahkan ke /login
    setTimeout(() => {
      window.location.reload(); 
    }, 1000); 
  }
};

export async function showConfirmationAlert(title, message) {
    const result = await Swal.fire({
        title: title,
        text: message,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    });

    // Mengembalikan true jika pengguna menekan tombol "Ya", false jika menekan "Batal"
    return result.isConfirmed;
}

