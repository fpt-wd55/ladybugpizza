/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            keyframes: {
                slideOutRight: {
                    "0%": { transform: "translateX(100%)" },
                    "100%": { transform: "translateX(-2px)" },
                },
            },
            animation: {
                "slide-out-right": "slideOutRight 0.6s ease-in-out forwards",
            },
        },
    },
    plugins: [
        require("flowbite/plugin")({
            charts: true,
        }),
    ],
};
