import $ from 'jquery'

export const initForm = () => {
  initInputListener()
}

function initInputListener() {
  $('#name').on('keyup', function (e) {
    $('#name_person_1').val($('#name').val())
  })
  $('#email').on('keyup', function (e) {
    $('#email_person_1').val($('#email').val())
  })
}
