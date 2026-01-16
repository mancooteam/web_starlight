async function fetchData() {
    try {
        const response = await fetch('api.php');
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

// Call the function
fetchData();

document.addEventListener("DOMContentLoaded", () => {
    obtenerDatos();
});