let showProfile = (p) => {

}
async function fetchData() {
    try {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);

        const id = urlParams.get('id');

        if (!id) {
            console.error("No id found");
            document.getElementById("card").innerText = "Wystąpił błąd - nie ma postaci o takiej ID";
        }

        const response = await fetch('../api/modify.php?id=' + id);
        if (!response.ok) {
            throw new Error(`HTTP error!`);
        }
        const data = await response.json();
        if (data.message) {
            data.message.forEach((e) => {
                showProfile(e);
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