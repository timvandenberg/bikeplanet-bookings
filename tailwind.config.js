module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {
      colors: {
        'primary': {
          500: '#f19c26'
        }
      },
      width: {
        '32': '32.5%',
        '49': '49.5%'
      }
    }
  },
  variants: {},
  plugins: [
    require('@tailwindcss/ui'),
  ]
}
