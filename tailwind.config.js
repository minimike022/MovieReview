/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/*.{html,js,php}"],
  theme: {
    extend: {
      fontFamily: {
        body: ["Poppins"]
      },
      backgroundImage: {
        'bgImage': "url('images/netflixlogo.webp')",
        'landingImage': "url('images/keannu-bg.jpg')"
      },
    },
  },
  plugins: [], 
}

