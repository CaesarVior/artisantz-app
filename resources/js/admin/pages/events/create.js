document.addEventListener("DOMContentLoaded", () => {
  // 1. Inisialisasi Quill JS
  const quill = new Quill("#quillContent", {
    theme: "snow",
    placeholder: "Tulis deskripsi event di sini...",
  });

  // Ambil elemen form (Mendukung ID eventForm maupun eventEditForm)
  const form = document.getElementById("eventForm");
  const hiddenContentInput = document.getElementById("description");
  const photosInput =
    document.getElementById("photos") || document.getElementById("photo");
  const previewGrid = document.getElementById("previewGrid");
  const eventDateInput = document.getElementById("event_date");

  if (eventDateInput && !eventDateInput.value) {
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    eventDateInput.value = now.toISOString().slice(0, 16);
  }

  // Load konten awal Quill jika ada (misal dari old value / data edit)
  if (hiddenContentInput && hiddenContentInput.value) {
    quill.root.innerHTML = hiddenContentInput.value;
  }

  // B. Set default tanggal jika kosong
  if (eventDateInput && !eventDateInput.value) {
    const today = new Date().toISOString().split("T")[0];
    eventDateInput.value = today;
  }

  // C. Handle Multiple Image Preview
  if (photosInput && previewGrid) {
    photosInput.addEventListener("change", (e) => {
      const files = Array.from(e.target.files);

      if (files.length > 0) {
        // Bersihkan preview lama saat user memilih sekumpulan foto baru
        previewGrid.innerHTML = "";

        files.forEach((file) => {
          if (file.type.startsWith("image/")) {
            const reader = new FileReader();

            reader.onload = (event) => {
              // Buat card preview untuk tiap foto
              const imgWrapper = document.createElement("div");
              imgWrapper.className =
                "w-24 h-24 rounded-lg border border-gray-200 bg-white shadow-sm overflow-hidden relative";

              const img = document.createElement("img");
              img.src = event.target.result;
              img.className = "w-full h-full object-cover";
              img.alt = file.name;

              imgWrapper.appendChild(img);
              previewGrid.appendChild(imgWrapper);
            };

            reader.readAsDataURL(file);
          }
        });
      }
    });
  }

  // D. Handle Submit Form
  if (form) {
    form.addEventListener("submit", (e) => {
      const rawText = quill.getText().trim();

      // Sinkronkan data Quill ke hidden input 'description'
      if (rawText.length === 0) {
        hiddenContentInput.value = "";
      } else {
        hiddenContentInput.value = quill.root.innerHTML;
      }

      // Validasi tanggal sederhana di sisi client
      if (eventDateInput && !eventDateInput.value) {
        e.preventDefault();
        alert("Harap pilih tanggal event terlebih dahulu!");
      }
    });
  }
});
