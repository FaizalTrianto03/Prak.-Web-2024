document.addEventListener("DOMContentLoaded", () => {
    // Seleksi elemen preloader
    const preloader = document.getElementById("preloader");

    // Sembunyikan preloader setelah halaman selesai dimuat
    window.addEventListener("load", () => {
        preloader.style.opacity = "0";
        preloader.style.visibility = "hidden";
    });
});
