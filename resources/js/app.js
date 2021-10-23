require('./bootstrap');
import $ from 'jquery'
import { initForm } from './form.js'

const initApp = function () {
  initSeasonSelect()
  initDiscountSelect()
  initPrefilPerson1()
  initBookPersons()
  initDifferentAddresses()
  initForm()
  initCoupledRoomsInput()
}

function initPrefilPerson1() {
  if (typeof(prefilledMame1) !== undefined && typeof(prefilledEmail1) !== undefined) {
    $('#first_name_person_1').val(prefilledFirstMame1)
    $('#last_name_person_1').val(prefilledLastMame1)
    console.log(prefilledBirthDate1)
    $('#birth_date_person_1').val(prefilledBirthDate1)
    $('#email_person_1').val(prefilledEmail1)
    $('#phone_person_1').val(prefilledPhone1)
    $('#street_person_1').val(prefilledStreet1)
    $('#postal_code_person_1').val(prefilledPostalCode1)
    $('#town_person_1').val(prefilledTown1)
    $('#country_person_1').val(prefilledCountry1)
  }
}

function initBookPersons() {
  const select = document.querySelector('#select_total_persons')
  if (!select)
    return

  select.addEventListener("change", function(e) {
      const extraPersonCount = parseInt(e.target.value)

      $('.person_row').hide()
      $('.input_person').val('0')
      for (var i = 1; i <= extraPersonCount; i++) {
        document.querySelector(`.person_row_${i}`).style.display = 'block'
        document.querySelector(`#input_person_${i}`).value = '1'
      }
  })
}

function initDifferentAddresses() {
  const checkboxes = document.querySelectorAll('.different_address_checkbox')
  for (var i = checkboxes.length - 1; i >= 0; i--) {
    checkboxes[i].addEventListener('change', function (e) {
      var nr = this.getAttribute('data-nr')
      if (this.checked) {
        $('.hidden_address_fields_'+nr).show()
      } else {
        $('.hidden_address_fields_'+nr).hide()
      }
    })
  }
}

function initCoupledRoomsInput() {
  const selects = document.querySelectorAll('.js_coupled_room_select')
  for (var i = selects.length - 1; i >= 0; i--) {
    selects[i].addEventListener('change', function (e) {
      var nr = parseInt(this.getAttribute('data-nr'))+1
      $('#coupled_cabin_person_'+nr).val(this.value)
    })
  }
}

function initSeasonSelect() {
  const select = document.querySelector('#select-season')
  if (select) {
    const seasonRows = document.querySelectorAll('.season-row')
    let seasonRowsCurrent

    select.addEventListener("change", function(e) {
      const season = e.target.value

      if (seasonRows) {
        for (var i = seasonRows.length - 1; i >= 0; i--) {
          seasonRows[i].style.display = 'none'
        }
      }

      if (seasonRowsCurrent = document.querySelectorAll(`.season-row.season-${season}`)) {
        for (var i = seasonRowsCurrent.length - 1; i >= 0; i--) {
          seasonRowsCurrent[i].style.display = 'table-row'
        }
      }
    })
  }
}

function initDiscountSelect() {
  const radios = document.querySelectorAll('.discount-radio')

  if (radios.length === 0)
    return

  let priceEl = document.querySelector('#booking-price')
  const originalPrice = parseInt(priceEl.getAttribute('data-original-price'))

  for (var i = radios.length - 1; i >= 0; i--) {
    const radio = radios[i]
    radios[i].addEventListener('click', function (e) {
      const discount = parseInt(e.target.value)

      priceEl.value = originalPrice - ( discount * originalPrice / 100)

      // buttons states
      for (var i = 0; i < radios.length; i++) {
        radios[i].parentNode.classList.remove('btn-active')
      }
      radio.parentNode.classList.add('btn-active')

    })
  }
}

document.addEventListener('DOMContentLoaded', initApp)
