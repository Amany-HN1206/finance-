/** @type {import('tailwindcss').Config} */
const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],
    theme: {
        extend: {
            colors: {
                // === Design Tokens dari tokens.json ===
                "ink-black": "#17191c",
                "paper-white": "#ffffff",
                "mist-gray": "#f2f2f3",
                "fog-white": "#fafafb",
                "slate-gray": "#777b86",
                "ash-gray": "#979799",
                "smoke-gray": "#a3a6af",
                "dusty-mauve": "#e6d8dc",
                "deep-plum": "#4a2c3a",
                error: "#ba1a1a",

                // Surface levels
                surface: {
                    canvas: "#ffffff",
                    "card-mist": "#f2f2f3",
                    "section-fog": "#fafafb",
                    "accent-mauve": "#e6d8dc",
                    "elevated-white": "#ffffff",
                },
            },
            fontFamily: {
                signifier: ["Source Serif 4", "ui-serif", "Georgia", "serif"],
                sohne: ["Inter", "ui-sans-serif", "system-ui", "sans-serif"],
                body: ["Inter", ...defaultTheme.fontFamily.sans],
                display: ["Source Serif 4", ...defaultTheme.fontFamily.serif],
            },
            fontSize: {
                // Type scale dari DESIGN (1).md
                caption: ["15px", { lineHeight: "1.5", fontWeight: "400" }],
                body: ["17px", { lineHeight: "1.35", fontWeight: "400" }],
                "body-lg": ["20px", { lineHeight: "1.35", fontWeight: "430" }],
                subheading: ["22px", { lineHeight: "1.5", fontWeight: "450" }],
                "heading-sm": [
                    "26px",
                    {
                        lineHeight: "1.18",
                        letterSpacing: "-0.23px",
                        fontWeight: "480",
                    },
                ],
                heading: [
                    "44px",
                    {
                        lineHeight: "1.3",
                        letterSpacing: "-0.66px",
                        fontWeight: "400",
                    },
                ],
                "heading-lg": [
                    "64px",
                    {
                        lineHeight: "1.3",
                        letterSpacing: "-0.96px",
                        fontWeight: "400",
                    },
                ],
                display: [
                    "90px",
                    {
                        lineHeight: "1.3",
                        letterSpacing: "-2.25px",
                        fontWeight: "400",
                    },
                ],
            },
            borderRadius: {
                cards: "24px",
                inputs: "16px",
                buttons: "9999px",
                elevated: "20px",
                small: "16px",
            },
            boxShadow: {
                subtle: "oklab(0 0 0 / 0.05) 0px 0px 0px 1px, rgba(0, 0, 0, 0.08) 0px 4px 24px 0px",
                "subtle-2":
                    "oklab(0 0 0 / 0.05) 0px 0px 0px 1px, rgba(0, 0, 0, 0.1) 0px 8px 40px 0px",
                "subtle-3":
                    "rgba(4, 23, 43, 0.05) 0px 0px 0px 1px, rgba(0, 0, 0, 0.1) 0px 20px 25px -5px, rgba(0, 0, 0, 0.1) 0px 8px 10px -6px",
            },
            spacing: {
                "section-gap": "80px",
            },
        },
    },
    plugins: [],
};
