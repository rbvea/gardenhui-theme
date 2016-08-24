import ready from 'domready'

ready(() => {
  const slider = document.querySelector('.slider')
  if(!slider) {
    return
  }
  require(['Flickity'], (Flickity) => {
    new Flickity(slider)
  })
})
