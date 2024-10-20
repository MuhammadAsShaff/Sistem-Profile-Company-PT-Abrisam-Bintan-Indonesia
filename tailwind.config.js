module.exports = {
    content: [
        "./node_modules/flowbite/**/*.js",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontFamily: {
                telkomsel: ["TelkomselBatikSans", "sans-serif"], // Menambahkan font custom
            },
        },
    },
    plugins: [
        require("flowbite/plugin"), // Memanggil plugin utama Flowbite
    ],
};
