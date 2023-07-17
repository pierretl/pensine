async function getData(url) {
    let res = await fetch(url)
    .then(async (reponse) => {
        if (!reponse.ok) {
            throw new Error('Error getting data');
        }

        return reponse.text().then((data) => {
            return data;
        })
    })
    .catch((error) => {
        console.log(error);
    })

    return res;
}



async function getFile(url) {
    let res = await fetch(url)
    .then(async (reponse) => {
        if (!reponse.ok) {
            throw new Error('Error getting File');
        }

        return reponse.blob().then((data) => {
            return URL.createObjectURL(data);
        })
    })
    .catch((error) => {
        console.log(error);
    })

    return res;
}



async function postData(url = '', data = {}) {
    const response = await fetch(url, {
        method: 'POST',
        //mode: 'cors',
        //cache: 'no-cache',
        //credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json'
            // 'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: JSON.stringify(data)
    });

    return response.json();
}