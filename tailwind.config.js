import forms from '@tailwindcss/forms'
import typography from '@tailwindcss/typography'
import autoprefixer from 'autoprefixer'

export default {
    content: [
        './resources/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    darkMode: 'class',
    plugins: [
        forms,
        typography,
        autoprefixer,
    ],
}