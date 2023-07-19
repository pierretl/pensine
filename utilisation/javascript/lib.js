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
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: data
    });

    return response;
}



async function afficheLaListe(data) {

    let listeHtml = '';
    data.forEach(function(data) {
        listeHtml += `
        <li>
            <p><strong>${data.titre}</strong></p>
            <ul>`;
                if (data.url) {listeHtml += `<li><a href="${data.url}" target="_blank">${data.url}</a></li>`}
                if (data.note) {listeHtml += `<li>${data.note}</li>`}
                if (data.tag) {listeHtml += `<li>${data.tag}</li>`}
                if (data.categories) {listeHtml += `<li>${data.categories}</li>`}
                if (data.capture) {listeHtml += `<li>${data.capture}</li>`}
        listeHtml +=`
            </ul>
        </li>`;
    });
    liste.innerHTML = "";
    liste.insertAdjacentHTML('afterbegin', listeHtml);
}



async function filtreLaListe(categories) {
    let data = await getData('http://localhost/pensine/api/');
    data = JSON.parse(data);

    let dataFiltre = [];
    data.forEach(function(item, index) {
        if (item.categories === categories) {
            dataFiltre[index] = data[index];
        }
    });

    dataFiltre = dataFiltre.filter(e => String(e).trim()); // supprime la valeur vide
    console.log(dataFiltre);

    await afficheLaListe(dataFiltre);

}