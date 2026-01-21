let showProfile = (p) => {
    if(document.getElementById("imie")) document.getElementById("imie").value = p.imie || '';
    if(document.getElementById("klan")) document.getElementById("klan").value = p.klan || 'cien';
    if(document.getElementById("ranga")) document.getElementById("ranga").value = p.ranga || '';
    if(document.getElementById("avek")) document.getElementById("avek").value = p.avek || '';
    if(document.getElementById("toyhouse")) document.getElementById("toyhouse").value = p.toyhouse || '';
    if(document.getElementById("id")) document.getElementById("id").value = p.id;
}
async function fetchData() {
    try {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const id = urlParams.get('id');

        document.getElementById("id").value = id;

        if (!id) {
            console.error("No id found");
            document.getElementById("header").innerHTML = "<h2>Wystąpił błąd - nie ma postaci o takiej ID</h2>";
        } else {
            const response = await fetch('../api/consult.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id: id }) // This populates php://input
            });
            if (!response.ok) {
                throw new Error(`HTTP error!`);
            }
            const data = await response.json();
            console.log(data);
            if (data.message) {
                data.message.forEach((e) => {
                    showProfile(e);
                });
            } else {
                console.log("Recieved: " + data);
                console.error("No 'message' array found in response");
            }
        }

    } catch (error) {
        console.log("Could not fetch data:" + error);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    fetchData();
    document.getElementById("btnGuardar").addEventListener("click", (e) => {
        e.preventDefault();
        const imie = document.getElementById("imie").value;
        const klan = document.getElementById("klan").value;
        const ranga = document.getElementById("ranga").value;
        const avek = document.getElementById("avek").value;
        const toyhouse = document.getElementById("toyhouse").value;
        const id = document.getElementById("id").value;

    if (imie != "" && klan != "" && ranga != "" && avek != "" && toyhouse != "" && id != "") {
        fetch("../api/modify.php",
            {
                method: "POST",
                headers: {"Content-Type": "application/json"},
                body: JSON.stringify({id,imie,klan,ranga,avek, toyhouse})
            })
        .then(res => res.json())
    } else {
        alert ("Nie wypełniono wszystkich pól");
    }
    })
});