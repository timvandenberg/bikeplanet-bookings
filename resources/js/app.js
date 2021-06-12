require('./bootstrap');
import $ from 'jquery'
import { initForm } from './form.js'

const initApp = function () {
  initSeasonSelect()
  initDiscountSelect()
  initBookPersons()
  initForm()
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
