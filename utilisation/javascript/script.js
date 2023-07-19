async function init() {
    let 
        imgElement = document.getElementById('imgDisplay'),
        form = document.getElementById('testForm'),
        reloadImgBtn = document.getElementById('reloadImgBtn'),
        filtre = document.getElementById('filtre'),
        liste = document.getElementById('liste');

    async function loadImg() {
        imgElement.src = await getFile('http://localhost/pensine/api/img/ptl9.png')       
    }
  
    async function addData(e) {
        e.preventDefault();

        let data = new URLSearchParams({
            titre: form.elements['titre'].value,
            url: form.elements['url'].value,
            note: form.elements['note'].value,
            tag: form.elements['tag'].value,
            categories: form.elements['categories'].value,
            capture: form.elements['capture'].value,
        });

        data = data.toString();

        postData('http://localhost/pensine/api/post', data)
        .then(response => {
            console.log(response);
            location.reload(); // recharge la page
            form.reset(); //vide le formulaire
        });
    }

    //recup data
    let data = await getData('http://localhost/pensine/api/');
    data = JSON.parse(data);

    //affiche la liste des categories
    let categorie = [];
    data.forEach(function(data, index) {
        categorie[index] = data.categories;
    });
    categorie = categorie.filter(e => String(e).trim()); // supprime la valeur vide
    categorie = [...new Set(categorie)];// supprime les doublons
    //
    let filtreHtml = `<li><a href="./">Tout</a></li>`;
    categorie.forEach(function(cat) {
        filtreHtml += `<li><button type="button" onclick="filtreLaListe('${cat}')">${cat}</button></li>`;
    });
    filtre.insertAdjacentHTML('afterbegin', filtreHtml);


    // affiche la liste de tous les datas
    afficheLaListe(data);

    
    reloadImgBtn.onclick = loadImg;
    form.onsubmit = addData;

}

init();