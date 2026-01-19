const getKlan = (k) => {
    if (k == "cien") return "Klan Cienia";
    if (k == "grom") return "Klan Gromu";
    if (k == "rzeka") return "Klan Rzeki";
    if (k == "wicher") return "Klan Wichru";
    if (k == "pnk") return "Plemię";
    if (k = "gk") return "Gwiezdny Klan";
    else return "inna :), skonkaktuj się na Nath";
}

const createCard = (e) => {
    const postac = document.createElement('postac');
    postac.style = `border: 3px solid var(--${e.klan}); border-radius: 26px;`;

    const avek = document.createElement('img');
    avek.src = e.avek;
    avek.style = `background-image: url(${e.avek}); width: 200px; height: auto; background-size: cover; background-position: center;`;

    const imie = document.createElement('staty');
    imie.innerHTML = `${e.imie}`;
    imie.style.width = '100%';
    imie.style = "text-align: center; text-transform: uppercase;";


    const staty = document.createElement('staty');

    const klan = document.createElement('klan');
    klan.classList.add(e.klan,"klany");
    const imieKlan = getKlan(e.klan);
    klan.style=`color: var(--${e.klan})`;
    klan.innerText = imieKlan;

    staty.append(imie, klan);
    postac.append(avek, staty);

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