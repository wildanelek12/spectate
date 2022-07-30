/** @type {import('tailwindcss').Config} */
module.exports = {
    purge: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
      ],
  content: [],
  theme: {
    extend: {
        colors: {
            blueWhite: '#F4F6FA',
            teks: '#404040',
            ungu: '#8996B6',
            ungumuda: '#F0F5FD',
            kuning: '#ffc635',
            biru1: '#5B769B',
            biru2: '#385071',
            // grey: '#f9f9fa',
            // lightgrey: '#4F4F4F',
            // darkgrey: '#797979',
            // primary: {
            //   light: '#FA8561',
            //   DEFAULT: '#FF7900',
            // },
            // secondary: {
            //   light: '#2F4389',
            //   DEFAULT: '#182E7C',
            // },
            // error: {
            //   DEFAULT: '#F03738',
            // },
            // success: {
            //   DEFAULT: '#4FE34E',
            // },
          },
          height: {
            120: '26.4rem',
          },
    },
  },
  plugins: [],
}
