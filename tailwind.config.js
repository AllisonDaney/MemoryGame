/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        genoa: {
          50: '#f0fdfc',
          100: '#ccfbf7',
          200: '#99f6ef',
          300: '#5eeadf',
          400: '#2dd4c7',
          500: '#14b8ab',
          600: '#0d948a',
          700: '#0f766e',
          800: '#115e58',
          900: '#134e49',
          950: '#042f2c',
        },
        masala: {
          50: '#f6f6f6',
          100: '#e7e7e7',
          200: '#d1d1d1',
          300: '#b0b0b0',
          400: '#888888',
          500: '#6d6d6d',
          600: '#5d5d5d',
          700: '#4f4f4f',
          800: '#454545',
          900: '#404040',
          950: '#262626',
        },
      },
      fontFamily: {
        sans: "Noto Sans, Arial, sans-serif",
        title: "Audiowide, Arial, sans-serif",
      },
    },
    plugins: [],


  }
}
