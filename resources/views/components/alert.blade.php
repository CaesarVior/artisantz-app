@if (session('success') || session('error') || $errors->any())
    <div id="toast-container"
        style="position: fixed !important; top: 24px !important; right: 24px !important; z-index: 999999 !important; display: flex !important; flex-direction: column !important; gap: 12px !important; pointer-events: none !important;">

        {{-- Toast Sukses --}}
        @if (session('success'))
            <div id="toast-success"
                style="pointer-events: auto !important; display: flex !important; align-items: center !important; width: 400px !important; min-width: 400px !important; max-width: 400px !important; padding: 16px 20px !important; background-color: #ffffff !important; border-radius: 16px !important; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15) !important; border: 1px solid #e5e7eb !important; transform: translateX(120%); transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important; box-sizing: border-box !important;">

                {{-- Icon Lingkaran --}}
                <div
                    style="width: 42px !important; height: 42px !important; min-width: 42px !important; max-width: 42px !important; border-radius: 50% !important; background-color: #d1fae5 !important; color: #059669 !important; display: flex !important; align-items: center !important; justify-content: center !important; margin-right: 14px !important; flex-shrink: 0 !important;">
                    <svg style="width: 24px !important; height: 24px !important;" fill="none" stroke="currentColor"
                        stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"></path>
                    </svg>
                </div>

                {{-- Teks Pesan --}}
                <div style="flex: 1 1 auto !important; min-width: 0 !important; width: 270px !important;">
                    <p
                        style="margin: 0 0 3px 0 !important; font-size: 12px !important; font-weight: 800 !important; color: #059669 !important; letter-spacing: 0.05em !important; text-transform: uppercase !important; line-height: 1 !important; word-break: normal !important; word-wrap: normal !important;">
                        BERHASIL</p>
                    <p
                        style="margin: 0 !important; font-size: 14px !important; font-weight: 600 !important; color: #1f2937 !important; line-height: 1.4 !important; word-break: normal !important; word-wrap: normal !important; white-space: normal !important;">
                        {{ session('success') }}
                    </p>
                </div>

                {{-- Tombol Close --}}
                <button type="button" onclick="closeToast('toast-success')"
                    style="width: 28px !important; height: 28px !important; min-width: 28px !important; background: transparent !important; border: none !important; padding: 0 !important; color: #9ca3af !important; cursor: pointer !important; display: flex !important; align-items: center !important; justify-content: center !important; margin-left: 10px !important; flex-shrink: 0 !important;">
                    <svg style="width: 18px !important; height: 18px !important;" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @endif

        {{-- Toast Error --}}
        @if (session('error') || $errors->any())
            <div id="toast-error"
                style="pointer-events: auto !important; display: flex !important; align-items: center !important; width: 400px !important; min-width: 400px !important; max-width: 400px !important; padding: 16px 20px !important; background-color: #ffffff !important; border-radius: 16px !important; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.15) !important; border: 1px solid #e5e7eb !important; transform: translateX(120%); transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1) !important; box-sizing: border-box !important;">

                {{-- Icon Lingkaran --}}
                <div
                    style="width: 42px !important; height: 42px !important; min-width: 42px !important; max-width: 42px !important; border-radius: 50% !important; background-color: #ffe4e6 !important; color: #e11d48 !important; display: flex !important; align-items: center !important; justify-content: center !important; margin-right: 14px !important; flex-shrink: 0 !important;">
                    <svg style="width: 24px !important; height: 24px !important;" fill="none" stroke="currentColor"
                        stroke-width="2.5" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </div>

                {{-- Teks Pesan --}}
                <div style="flex: 1 1 auto !important; min-width: 0 !important; width: 270px !important;">
                    <p
                        style="margin: 0 0 3px 0 !important; font-size: 12px !important; font-weight: 800 !important; color: #e11d48 !important; letter-spacing: 0.05em !important; text-transform: uppercase !important; line-height: 1 !important; word-break: normal !important; word-wrap: normal !important;">
                        GAGAL</p>
                    <p
                        style="margin: 0 !important; font-size: 14px !important; font-weight: 600 !important; color: #1f2937 !important; line-height: 1.4 !important; word-break: normal !important; word-wrap: normal !important; white-space: normal !important;">
                        @if (session('error'))
                            {{ session('error') }}
                        @else
                            {{ $errors->first() == 'auth.failed' ? 'Email atau password yang Anda masukkan salah.' : $errors->first() }}
                        @endif
                    </p>
                </div>

                {{-- Tombol Close --}}
                <button type="button" onclick="closeToast('toast-error')"
                    style="width: 28px !important; height: 28px !important; min-width: 28px !important; background: transparent !important; border: none !important; padding: 0 !important; color: #9ca3af !important; cursor: pointer !important; display: flex !important; align-items: center !important; justify-content: center !important; margin-left: 10px !important; flex-shrink: 0 !important;">
                    <svg style="width: 18px !important; height: 18px !important;" fill="none" stroke="currentColor"
                        stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        @endif

    </div>
@endif

<script>
    function closeToast(id) {
        const toast = document.getElementById(id);
        if (toast) {
            toast.style.setProperty('transform', 'translateX(120%)', 'important');
            setTimeout(() => toast.remove(), 400);
        }
    }

    document.addEventListener("DOMContentLoaded", () => {
        const toastSuccess = document.getElementById("toast-success");
        const toastError = document.getElementById("toast-error");

        const showToast = (toast) => {
            if (!toast) return;
            setTimeout(() => {
                toast.style.setProperty('transform', 'translateX(0)', 'important');
            }, 100);

            setTimeout(() => {
                closeToast(toast.id);
            }, 4000);
        };

        showToast(toastSuccess);
        showToast(toastError);
    });
</script>
