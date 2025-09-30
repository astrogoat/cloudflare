/** @type {import('tailwindcss').Config} */

module.exports = {
    prefix: 'cloudflare-',
    darkMode: false, // or 'media' or 'class',
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
    ],
}
