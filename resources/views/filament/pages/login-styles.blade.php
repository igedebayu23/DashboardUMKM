<style>
    /* Semua aturan diawali .fi-simple-layout agar HANYA berlaku di halaman login */
    .fi-simple-layout {
        background: linear-gradient(135deg, #05080f 0%, #0a1020 55%, #0d1730 100%) !important;
        min-height: 100vh;
    }

    .fi-simple-layout .fi-simple-main {
        width: 100% !important;
        max-width: 38rem !important;
        border-radius: 1.25rem !important;
        padding: 2.5rem !important;
        background-color: rgba(16, 21, 33, 0.92) !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        box-shadow: 0 8px 40px rgba(0, 0, 0, 0.5) !important;
        backdrop-filter: blur(6px);
    }

    .fi-simple-layout .fi-simple-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
    }

    .fi-simple-layout .fi-simple-header .fi-logo {
        height: 6.5rem !important;
        max-width: 100%;
        object-fit: contain;
    }

    .fi-simple-layout .fi-simple-header-heading {
        text-align: center !important;
        font-size: 1.6rem !important;
        font-weight: 700 !important;
        color: rgba(255, 255, 255, 0.95) !important;
        margin-top: 0.75rem !important;
    }

    .fi-simple-layout .fi-simple-header-subheading {
        text-align: center !important;
        font-size: 1.25rem !important;
        font-weight: 700 !important;
        color: rgba(255, 255, 255, 0.92) !important;
        width: 100% !important;
        margin-top: 0.875rem !important;
        padding-top: 0.875rem !important;
        border-top: 1px solid rgba(255, 255, 255, 0.18) !important;
    }

    .fi-simple-layout .fi-input-wrp {
        border-radius: 0.6rem !important;
        overflow: hidden;
        background-color: rgba(22, 27, 39, 0.9) !important;
        border-color: rgba(255, 255, 255, 0.12) !important;
    }

    .fi-simple-layout .fi-input-wrp input,
    .fi-simple-layout .fi-input {
        min-height: 3.25rem !important;
        border-radius: 0.6rem !important;
        background-color: rgba(22, 27, 39, 0.9) !important;
        border-color: rgba(255, 255, 255, 0.12) !important;
        color: rgba(255, 255, 255, 0.92) !important;
        padding-top: 0.75rem !important;
        padding-bottom: 0.75rem !important;
    }

    .fi-simple-layout .fi-input-wrp input::placeholder {
        color: rgba(255, 255, 255, 0.35) !important;
    }

    /* Tombol lihat/sembunyikan password menyatu dengan area input. */
    .fi-simple-layout .fi-input-wrp-suffix,
    .fi-simple-layout .fi-input-wrp-actions,
    .fi-simple-layout .fi-input-wrp-suffix button {
        background: transparent !important;
        border: 0 !important;
        box-shadow: none !important;
    }

    .fi-simple-layout .fi-input-wrp-suffix button {
        color: rgba(255, 255, 255, 0.8) !important;
    }

    .fi-simple-layout .fi-input-wrp-suffix button svg {
        color: currentColor !important;
    }

    .fi-simple-layout .fi-btn-primary,
    .fi-simple-layout button[type="submit"].fi-btn {
        background-color: #ff8a00 !important;
        border-color: #ff8a00 !important;
        color: #1a0e00 !important;
        font-weight: 700 !important;
        min-height: 3.25rem !important;
        border-radius: 0.6rem !important;
        width: 100% !important;
        font-size: 1rem !important;
    }

    .fi-simple-layout .fi-btn-primary:hover,
    .fi-simple-layout button[type="submit"].fi-btn:hover {
        background-color: #ff9d2e !important;
        border-color: #ff9d2e !important;
    }

    .fi-simple-layout .fi-fo-field-wrp-label label,
    .fi-simple-layout .fi-label,
    .fi-simple-layout form label,
    .fi-simple-layout .fi-fo-field-label,
    .fi-simple-layout .fi-fo-field-label-content {
        color: #fff !important;
    }

    @media (max-width: 480px) {
        .fi-simple-layout .fi-simple-main {
            padding: 1.5rem !important;
            border-radius: 0.875rem !important;
        }

        .fi-simple-layout .fi-simple-header .fi-logo {
            height: 5rem !important;
        }
    }

</style>
