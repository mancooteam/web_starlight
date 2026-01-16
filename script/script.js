async function obtenerDatos() {
    try {
        let res = await fetch("../api.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify(datos)
        });

        if(!res.ok) {
            throw new Error("Error con el servidor");
        }
        let info = await res.json();
        console.log("info");
    } catch (e) {
        console.error("Error: " + e);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    obtenerDatos();
});