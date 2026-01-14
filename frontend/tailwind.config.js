/** @type {import('tailwindcss').Config} */
export default {
  content: ['./index.html', './src/**/*.{vue,js,ts,jsx,tsx}'],
  theme: {
    extend: {
      colors: {
        primary: '#059669',
        secondary: '#DC2626',
        accent: '#F59E0B',
      },
    },
  },
  plugins: [],
}
