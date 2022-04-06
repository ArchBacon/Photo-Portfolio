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
            boxShadow: {
                'darker': '0 2px 3px rgb(0 0 0 / 20%)',
                'label': '1px 1px 1px rgb(0 0 0 / 10%), 5px 0 5px -3px rgb(0 0 0 / 40%), inset 0 0 5px rgb(0 0 0 / 4%)',
            }
        },
    },
    plugins: [],
}
