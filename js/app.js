const createCard = (e) => {
    const postac = document.createElement('postac');
    const avek = document.createElement('img');
    avek.src = e.avek;
    const imie = document.createElement('staty');
    imie.innerText = e.imie
    const staty = document.createElement('staty');
    const klan = document.createElement('klan');
    klan.innerText = e.klan;
    klan.classList.add(e.klan);
    const toyhouse = document.createElement('toyhouse');
    toyhouse.innerText = e.toyhouse;

    staty.appendChild(klan, toyhouse);
    postac.appendChild(avek, imie,staty);

    document.getElementById('spis').appendChild(postac);
}

async function fetchData() {
    try {
        const response = await fetch('../api/api.php')
        if (!response.ok) {
            throw new Error(`HTTP error!`);
        }
        const data = await response.json();
        console.log("Data received:", data);
        const postacie = JSON.parse(data);
        postacie.forEach((element) => {
            createCard(element);
        })
        
    } catch (error) {
        console.log("Could not fetch data:" + error);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    fetchData();
});