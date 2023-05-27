import { UAParser } from 'ua-parser-js'

const parser = new UAParser()
const parserResult = parser.getResult()

console.log(parserResult)

const data = {
    browser         : parserResult.browser ? parserResult.browser.name : null,
    os              : parserResult.os ? parserResult.os.name : null,
    device_vendor   : parserResult.device ? parserResult.device.vendor : null,
    device_model    : parserResult.device ? parserResult.device.model : null,
    device_type     :  parserResult.device ? parserResult.device.type : null
}

postData('/submit-user-agent', data)

async function postData(url = '', data = {}) {
    const response = await fetch(url, {
        method: 'POST', 
        mode: 'cors', 
        cache: 'no-cache',
        credentials: 'same-origin', 
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-Token': document.querySelector("meta[name='csrf-token']").content
        },
        redirect: 'follow', 
        referrerPolicy: 'no-referrer',
        body: JSON.stringify(data) 
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Jaringan sedang bermasalah, coba lagi nanti !')
        }else{
            return response.json()
        }
    })
    .then(response => {
        console.log(response)
    })
}