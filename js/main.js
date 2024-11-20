/*=====EMAIL=======*/

const contactForm = document.getElementById('contact-form'),
    contactMessage = document.getElementById('contact-message')

    const sendEmail = (e) => {
        e.preventDefault()

        //serviceID - templateID - #form - publicKey
        emailjs.sendForm('service_hxucsdk','template_hwkiuvq','#contact-form','FCvEIeoBh_AxGm3ur')

        .then(() => {
            //Zpráva se poslala
            contactMessage.textContent = 'Zpráva byla úspěšně odeslána ✅'

            //Odebrání úspěšně poslané zprávy po 5 sekundách
            setTimeout(() => {
                contactMessage.textContent = ''
            }, 5000)

            //Vymazání polí
            contactForm.reset()
        }, () => {

            //Ukázaní Error zprávy
            contactMessage.textContent = 'Zpráva neodeslána, (Chyba služby) ❌'
        })
    }
    contactForm.addEventListener('submit', sendEmail)

    ScrollReveal().reveal('.profil, contact__form', {delay: 200 });
    ScrollReveal().reveal('.info', { origin: 'left', delay: 400 });
    ScrollReveal().reveal('.skills', { origin: 'left', delay: 600 });
    ScrollReveal().reveal('.about', { origin: 'right', delay: 800 });
    ScrollReveal().reveal('.projects__card, .knowledge__card, experience__card',{ interval: 100});
