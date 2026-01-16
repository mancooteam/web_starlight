let obtenerDatos = () =>{
    try {
        let res = await fetch("../api.php");

        if(!res.ok) {
            throw new Error("Error con el servidor");
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    obtenerDatos();
});