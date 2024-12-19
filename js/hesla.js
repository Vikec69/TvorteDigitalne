    /*===Zobrazení hesla===*/
    const showHiddenPass = (inputPass, inputIcon) => {
        const input = document.getElementById(inputPass),
                iconEye = document.getElementById(inputIcon)

        iconEye.addEventListener('click', () =>{
            //Změna se heslo na text
            if(input.type === 'password'){
                // Změna na text
                input.type = 'text'

                // Přidání ikonky
                iconEye.classList.add('ri-eye-off-line')

                // Odebrání ikonky
                iconEye.classList.remove('ri-eye-line')
            }else{
                // Změna na heslo
                input.type = 'password'

                // Odebrání ikonky
                iconEye.classList.remove('ri-eye-off-line')

                // Přidání ikonky
                iconEye.classList.add('ri-eye-line')
            }
        })
    }

    showHiddenPass('input-pass','input-icon')