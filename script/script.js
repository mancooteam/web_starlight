async function fetchData() {
    try {
        const response = await fetch('http://localhost:8000/api.php');
        if (!response.ok) {
            throw new Error(`HTTP error!`);
        }
        const data = await response.json();
        console.log("Data received:" + data);
        document.body.innerHTML = `<h1>${data.message}</h1>`;
        
    } catch (error) {
        console.log("Could not fetch data:" + error);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    fetchData();
});