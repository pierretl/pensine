let  form = document.getElementById('testForm');


async function getCurrentTab() {
    let queryOptions = { active: true, lastFocusedWindow: true };
    let [tab] = await chrome.tabs.query(queryOptions);
    return tab;
}



const convertToBase64 = file => new Promise((resolve, reject) => {
    const reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = () => resolve(reader.result);
    reader.onerror = reject;
});



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



async function submitForm() {

    let currentTabs = await getCurrentTab().then((currentTabs) => {
        return currentTabs;
    }).catch(err=>console.log(err));

    form.elements['titre'].value = currentTabs.title;
    form.elements['url'].value = currentTabs.url;
    form.elements['faviconUrl'].value = currentTabs.favIconUrl;

    let imageConvertis = await convertToBase64(form.elements['capture'].files[0]).then((test)=>{
        return test;
    }); 
    
    let data = new URLSearchParams({
        apikey: form.elements['apikey'].value,
        faviconUrl: currentTabs.favIconUrl,
        titre: 'test',
        titre: currentTabs.title,
        url: currentTabs.url,
        note: form.elements['note'].value,
        tag: form.elements['tag'].value,
        categories: form.elements['categories'].value,
        capture: imageConvertis
    });

    data = data.toString();

    await postData('http://localhost/pensine/api/post', data)
        .then(response => {
            console.log(response);
        })
        .catch(error => {
            console.log(error);
        });

}


form.addEventListener('submit', async function(e) {
    e.preventDefault();

    await submitForm();

});