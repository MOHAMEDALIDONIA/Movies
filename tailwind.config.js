/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/views/layouts/main.blade.php",
    "./resources/views/Frontend/welcome.blade.php",
    "./resources/views/Frontend/movie/show.blade.php",
    "./resources/views/Frontend/actor/show.blade.php",
    "./resources/views/Frontend/actor/index.blade.php",
    "./resources/views/Frontend/tv/index.blade.php",
    "./resources/views/Frontend/tv/index.blade.php",
    "./resources/views/Livewire/search-dropdown.blade.php",
  ],
  theme: {
    extend: {
      width:{
        '96':'24rem',
      }
    },
    spinner: (theme) => ({
      default: {
        color: '#dae1e7', // color you want to make the spinner
        size: '1em', // size of the spinner (used for both width and height)
        border: '2px', // border-width of the spinner (shouldn't be bigger than half the spinner's size)
        speed: '500ms', // the speed at which the spinner should rotate
      },
 
    }),
  },
  plugins: [
    require('tailwindcss-spinner')({ className: 'spinner', themeKey: 'spinner' })
  ],
}

