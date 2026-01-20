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
            const response = await fetch('../api/modify.php?id=' + id);
            if (!response.ok) {
                throw new Error(`HTTP error!`);
            }
            const text = await response.json();
            if (data.message) {
                data.message.forEach((e) => {
                    showProfile(e);
                });
            } else {
                console.error("No 'message' array found in response");
            }
        }

    } catch (error) {
        console.log("Could not fetch data:" + error);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    fetchData();
});