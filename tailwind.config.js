export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                montserrat: ['Montserrat', 'ui-sans-serif', 'system-ui']
            }
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
    ],
}
