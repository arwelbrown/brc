import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";
import autoprefixer from "autoprefixer";

export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./vendor/filament/**/*.blade.php",
    "./vendor/filament/**/*.php",
  ],
  darkMode: "class",
  plugins: [forms, typography, autoprefixer],
};
