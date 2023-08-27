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

        let hrefCapture = data.capture ? `http://localhost/pensine/api/${data.capture}` : 'https://place-hold.it/300x500';

        let templateFavicon = '';
        if (data.faviconUrl) {
            templateFavicon = `
                <img src="${data.faviconUrl}" alt="" width="32">
            `;
        }

        let templateCategorie = '';
        if (data.categories) {
            templateCategorie = `
                <span class="h6">
                    <span class="badge bg-primary">${data.categories}</span>
                </span>
            `;
        }

        let templateUrl = '';
        if (data.url) {
            templateUrl = `<a class="card-link" href="${data.url}" target="_blank">${data.url}</a>`;
        }

        let templateNote = '';
        if (data.note) {
            templateNote = `<p class="card-text">${data.note}</p>`;
        }

        let templateTag = '';
        if (data.tag) {

            templateTag = '<ul class="list-unstyled d-flex flex-wrap">';

            data.tag.forEach(function(tagName) {
                templateTag += `
                    <li>
                        <span class="badge rounded-pill text-bg-secondary">${tagName}</span>
                    </li>
                `;
            })
            
            templateTag += '</ul>';
        }

        listeHtml += `
        <li class="card" style="width:400px;">
            <div class="d-flex">
                <div class="flex-shrink-1">
                    <img width="150" src="${hrefCapture}" class="img-fluid rounded-start" alt="">
                </div>
                <div class="p-2">
                    <p class="h4 card-title">
                        ${templateFavicon}
                        ${data.titre}
                        ${templateCategorie}
                    </p>
                    ${templateUrl}
                    ${templateNote}
                    ${templateTag}
                </div>
            </div>
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