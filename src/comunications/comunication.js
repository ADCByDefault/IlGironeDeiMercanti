const errorContainer = document.getElementById("errorContainer");
const informationContainer = document.getElementById("informationContainer");

window.addEventListener("load", (event) => {
    showStatusArticles();
});


async function showStatusArticles(){
    const response = await fetch("getComunications.php", {
        method: "POST",
    });
    const json = await response.json();
    console.log(json);
    if (json.status == 251) {
        errorContainer.textContent = "ciao";       
    } else if (json.status == 451) {
        errorContainer.textContent = "non hai ancora fatto proposte per nessun'articolo";
        return;
    }
}
