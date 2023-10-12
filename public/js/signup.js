const signupEmailInput = document.getElementById('signup-email')
const signupUsernameInput = document.getElementById('signup-username')
const signupPasswordInput = document.getElementById('signup-password')

const deleteError = (e) => { 
    const errorParagraph = e.target.nextElementSibling

    if (errorParagraph && errorParagraph.classList.contains('error')) {
      errorParagraph.remove() 
    } 
 }

 signupEmailInput.addEventListener('input', deleteError)
 signupUsernameInput.addEventListener('input', deleteError)
 signupPasswordInput.addEventListener('input', deleteError)

