/** @type {import('tailwindcss').Config} config */
const config = {
  content: [
    './app/**/*.php',
    './resources/js/*.{php,vue,js}',
    './resources/views/**/*.{php,vue,js}',
    './resources/blocks/src/**/*.{php,vue,js}',
  ],
  theme: {
    extend: {
      container: {
        center: true,
        padding: {
          DEFAULT: '1rem',
        },
      },
      fontFamily: {
        garamond: ['EB Garamond', 'serif'],
      },
      colors: {}, // Extend Tailwind's default colors
    },
  },
  plugins: [],
};

export default config;
