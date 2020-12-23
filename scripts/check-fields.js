const firstName = document.getElementById('firstName')
const lastName = document.getElementById('lastName')
const email = document.getElementById('email')
const birthdate = document.getElementById('birthdate')
const address = document.getElementById('address')
const city = document.getElementById('city')
const country = document.getElementById('country')
const postcode = document.getElementById('postcode')
const password = document.getElementById('password')
const passwordConfirm = document.getElementById('passwordConfirm')

form.addEventListener('submit', (e) => {
  let messages = [];
  if (firstName.value == '' || firstName.value == null){
    messages.push('Een voornaam is vereist')
  }
  if(lastName.value == '' || lastName.value == null){
    messages.push('Een achternaam is vereist')
  }
  if(email.value == '' || email.value == null){
    messages.push('Een email adres is vereist')
  }
  if(birthdate.value == '' || birthdate.value == null){
    messages.push('Een geboortedatum is vereist')
  }
  if(address.value == '' || address.value == null){
    messages.push('Een adres is vereist')
  }
  if(city.value == '' || city.value == null){
    messages.push('Een stad is vereist')
  }
  if(country.value == '' || country.value == null){
    messages.push('Een land is vereist')
  }
  if(postcode.value == '' || postcode.value == null){
    messages.push('Een postcode is vereist')
  }
  if(password.value == '' || password.value == null){
    messages.push('Een wachtwoord is vereist')
  }
  if(passwordConfirm.value == '' || passwordConfirm.value == null){
    messages.push('Een wachtwoord bevestiging is vereist')
  }
  if(passwordConfirm.value != password.value){
    messages.push('Wachtwoorden zijn niet gelijk.')
  }
  if (messages.length > 0)
  {
    errors.innerText = messages.join(', ')
    console.log(messages.join(', '))
    e.preventDefault()
  }
})