// Script for button

import ready from 'domready';

function loadMore(e) {
  e.preventDefault()
  const component = this.getAttribute('data-component')
  const page = parseInt(this.getAttribute('data-page'))
  let total;
  let res = new XMLHttpRequest()
  res.open('GET', `/load_more/${component}/${page}/`)
  res.send()
  res.onload = () => {
    this.insertAdjacentHTML('beforebegin', res.responseText)


    const total = parseInt(res.getResponseHeader('X-Total-Count'))
    const nextPage = page + 1;
    this.setAttribute('data-page', nextPage)
    if(this.hasAttribute('data-exhausted')) {
      this.parentNode.removeChild(this)
    }
    if((nextPage + 3) >= total) {
      this.setAttribute('data-exhausted')
    }
  }
}

ready(() => {
  if(!document.querySelector('.button--load-more')) {
    return
  }
  Array
    .from(document.querySelectorAll('.button--load-more'))
    .forEach(btn => {
      btn.addEventListener('click', loadMore, false)
    })
})
