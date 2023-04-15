

const generateLinkButton = document.getElementById('generate-link-button')

if(generateLinkButton) {

    generateLinkButton.addEventListener('click', () => {
        const appointmentId = generateLinkButton.getAttribute('data-appointmentid')

        const jitsiDomain = 'meet.jit.si' // Change this to your JITSI domain
        const jitsiOptions = 'config.disableDeepLinking=true&config.toolbar.hide=true' // Customize the JITSI options as needed
        const jitsiRoomName = encodeURIComponent(Math.random().toString(36).substring(2, 8))
        const jitsiLink = `https://${jitsiDomain}/${jitsiRoomName}?${jitsiOptions}`

        // Effectue une requête POST à votre contrôleur Laravel pour enregistrer le lien dans la base de données
        axios.post('/generatelinkforvideoconference', {
            appointmentid: appointmentId,
            url: jitsiLink
        })
        .then(response => {
            console.log(response.data)
        })
        .catch(error => {
            console.log(error)
        })

        // Recharge la page actuelle
        location.reload()
    })
}