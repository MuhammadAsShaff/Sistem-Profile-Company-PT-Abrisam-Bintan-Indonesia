module.exports = {
    content: [
        "./node_modules/flowbite/**/*.js",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        // Jika Anda menggunakan file HTML di luar resource, tambahkan direktori berikut
        "./public/**/*.html",
        "./src/**/*.{html,js}", // Sesuaikan jika menggunakan direktori src
    ],
    theme: {
        extend: {
            fontFamily: {
                telkomsel: ["TelkomselBatikSans", "sans-serif"], // Menambahkan font custom Telkomsel
            },
        },
    },
    plugins: [
        require("flowbite/plugin")({
        }),
    ],
};
