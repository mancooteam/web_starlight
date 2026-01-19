const createCard = (e) => {
    const postac = document.createElement('postac');
    postac.style = `border: 1px solid var(--${e.klan})`;

    const avek = document.createElement('img');
    avek.src = e.avek;
    avek.style = `background-image: url(${e.avek}); width: 200px; height: auto; background-size: cover; background-position: center;`;

    const imie = document.createElement('staty');
    imie.innerHTML = `<span>Imię:</span> ${e.imie}`;


    const staty = document.createElement('staty');

    const klan = document.createElement('klan');
    klan.innerText = e.klan;
    klan.classList.add(e.klan,"klany");

    const toyhouse = document.createElement('toyhouse');
    toyhouse.innerText = e.toyhouse || '';
    staty.append(klan, toyhouse);
    postac.append(avek, imie, staty);

    document.getElementById('spis').appendChild(postac);
}

async function fetchData() {
    try {
        const response = await fetch('../api/api.php');
        if (!response.ok) {
            throw new Error(`HTTP error!`);
        }
        const data = await response.json();
        if (data.message) {
            data.message.forEach((e) => {
                createCard(e);
            });
        } else {
            console.error("No 'message' array found in response");
        }

    } catch (error) {
        console.log("Could not fetch data:" + error);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    fetchData();
});