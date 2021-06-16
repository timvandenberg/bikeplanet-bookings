module.exports = {
  purge: [
    './resources/views/**/*.blade.php',
    './resources/css/**/*.css',
  ],
  theme: {
    extend: {
      colors: {
        'orange': {
          DEFAULT: '#F19C26',
          '50': '#FFFEFE',
          '100': '#FDF3E6',
          '200': '#FADEB6',
          '300': '#F7C886',
          '400': '#F4B256',
          '500': '#F19C26',
          '600': '#D6820E',
          '700': '#A6650B',
          '800': '#764808',
          '900': '#462B05'
        },
        'blue': {
          DEFAULT: '#074161',
          '50': '#5ABDF3',
          '100': '#43B3F1',
          '200': '#13A0EE',
          '300': '#0E81C0',
          '400': '#0A6191',
          '500': '#074161',
          '600': '#042131',
          '700': '#000102',
          '800': '#000000',
          '900': '#000000'
        },
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
