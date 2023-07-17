async function init() {
    let 
        displayElement = document.getElementById('displayResult'),
        imgElement = document.getElementById('imgDisplay'),
        form = document.forms['testForm'],
        reloadDataBtn = document.getElementById('reloadDataBtn'),
        reloadImgBtn = document.getElementById('reloadImgBtn'),
        alertStatut = document.getElementById('formStatut'),
        alertElement = document.getElementById('formAlert');

    async function loadData() {
        displayElement.textContent = await getData('http://localhost/pensine/api/');
    }

    async function loadImg() {
        imgElement.src = await getFile('http://localhost/pensine/api/img/ptl9.png')       
    }

    async function titre(ev) {
        ev.preventDefault();
        let data = {
            titre: form.elements['titre'].value,
            categories: form.elements['categories'].value,
        };

        postData('http://localhost/pensine/api/', data)
        .then(data => {
            alertElement.innerHTML = data.message;
            console.log(data);

            if (data.success) {
                alertStatut.innerText = 'success';
            } else {
                alertStatut.innerText = 'error';
            }
        })
    }
    
    reloadDataBtn.onclick = loadData;
    reloadImgBtn.onclick = loadImg;
    form.onsubmit = titre;
}

init();