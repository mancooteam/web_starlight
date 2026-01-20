let showProfile = (p) => {

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
            const data = JSON.parse(text);
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