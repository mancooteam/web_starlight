const getKlan = (k) => {
    if (k == "cien") return "Klan Cienia";
    if (k == "grom") return "Klan Gromu";
    if (k == "rzeka") return "Klan Rzeki";
    if (k == "wicher") return "Klan Wichru";
    if (k == "samotnik") return "Samotnik";
    if (k == "pnk") return "Plemię";
    if (k == "gk") return "Gwiezdny Klan";
    else return "inna :), skonkaktuj się na Nath";
}

const createCard = (e) => {
    const postac = document.createElement('postac');
    postac.style = `border: 3px solid var(--${e.klan}); border-radius: 26px;`;

    const ranga = document.createElement('ranga');
    ranga.style = `text-align: center; font-size: 10px; text-transform: uppercase; color: var(--${e.klan}); border-top: 1px solid; margin-top: 5px; padding-top: 6px; margin-bottom: -5px;`;
    ranga.innerHTML = `${e.ranga}`;

    const avek = document.createElement('img');
    avek.src = e.avek;
    avek.style = `background-image: url(${e.avek}); width: 200px; height: auto; background-size: cover; background-position: center;`;

    const imie = document.createElement('staty');
    imie.innerHTML = `${e.imie}`;
    imie.style.width = '100%';
    imie.style = "text-align: center; text-transform: uppercase;";

    const link = document.createElement('a');
    link.href = "edit.html?id=" + e.id;

    const span = document.createElement('span');
    span.id = "buttons";

    const button = document.createElement('button')
    button.id = "mod";
    button.innerText = "modyfikuj";

    const profil = document.createElement('a');
    profil.href = `https://starlight-rp.pl/member.php?action=profile&uid=${e.id}`;
    const b_profil = document.createElement('button');
    b_profil.innerText = "profil"
    profil.appendChild(b_profil);

    span.appendChild(link, profil);

    link.appendChild(button);

    console.log(`Postać: ${e.imie} - ${e.klan}`)


    const staty = document.createElement('staty');

    const klan = document.createElement('klan');
    klan.classList.add(e.klan,"klany");
    const imieKlan = getKlan(e.klan);
    klan.style=`color: var(--${e.klan})`;
    klan.innerText = imieKlan;

    staty.append(imie, klan, ranga);
    postac.append(avek, staty, span);

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