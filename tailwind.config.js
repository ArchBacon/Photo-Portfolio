module.exports = {
    content: [
        "./assets/**/*.js",
        "./templates/**/*.twig",
    ],
    theme: {
        fontFamily: {
            'montserrat': ['"Montserrat"', 'sans-serif'],
        },
        extend: {
            rotate: {
                '4': '4deg',
            },
            spacing: {
                '5/6': '83.333333%',
            }
        },
    },
    plugins: [],
}
