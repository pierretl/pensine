function listeDesCategories(data) {
    let categorie = [];
    data.forEach(function(data, index) {
        categorie[index] = data.categories;
    });

    categorie = categorie.filter(e => String(e).trim()); // supprime la valeur vide
    categorie = [...new Set(categorie)];// supprime les doublons
    
    let filtreHtml = '';
    categorie.forEach(function(cat) {
        filtreHtml += `
        <li class="nav-item">
            <button class="nav-link" type="button" onclick="filtreLaListe('${cat}')">${cat}</button>
        </li>`;
    });
    menuCategories.insertAdjacentHTML('beforeend', filtreHtml);
}



const convertToBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = reject;
});



async function init() {
    let 
        imgElement = document.getElementById('imgDisplay'),
        form = document.getElementById('testForm'),
        reloadImgBtn = document.getElementById('reloadImgBtn'),
        menuCategories = document.getElementById('menuCategories'),
        liste = document.getElementById('liste');

    async function loadImg() {
        imgElement.src = await getFile('http://localhost/pensine/api/data/img/ptl9.png')       
    }
  
    async function addData(e) {
        e.preventDefault();

        let data = new URLSearchParams({
            apikey: form.elements['apikey'].value,
            faviconUrl: form.elements['faviconUrl'].value,
            titre: form.elements['titre'].value,
            url: form.elements['url'].value,
            note: form.elements['note'].value,
            tag: form.elements['tag'].value,
            categories: form.elements['categories'].value,
            capture: await convertToBase64(form.elements['capture'].files[0]),
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
    listeDesCategories(data);


    // affiche la liste de tous les datas
    afficheLaListe(data);

    
    reloadImgBtn.onclick = loadImg;
    form.onsubmit = addData;

}

init();