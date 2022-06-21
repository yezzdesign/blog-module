module.exports = {
    content: [
        "./Resources/views/**/*.blade.php",
        "./Resources/**/*.js",
        "./Resources/**/*.vue",
    ],
    theme: {

        extend: {
            colors: {
                // Frontend Design Settings
                prime_bg: '#212529',
                prime_brand: '#FF7F50',
                prime_font_color: '#FFF',

                // Backend Design Settings
                main_bg: '#FFF',
                main_brand: '#FF7F50',
                main_brand_success: '#7EC179',
                main_brand_error: '#9A1D21',
                main_brand_inform: '#28A69D',
                main_font: '#565454',

            },
            fontFamily: {
                // Frontend Font Settings
                prime_font: ['Yanone Kaffeesatz', 'sans-serif'],

                // Backend Font Settings
                main_font: ['Roboto', 'sans-serif']

            },
            transitionDuration: {
                '0': '0ms',
                '3000': '3000ms',
            }
        },
    },
    plugins: [require('@tailwindcss/forms')],
}
