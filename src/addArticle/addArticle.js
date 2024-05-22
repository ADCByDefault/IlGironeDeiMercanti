const errorContainer = document.getElementById("errorContainer");
const informationContainer = document.getElementById("informationContainer");
const addArticle = document.getElementById("addArticle");
const img = document.getElementById("img");

addArticle.addEventListener("submit", async (e) => {
    e.preventDefault();
    const form = document.getElementById("articleForm");
    const formData = new FormData(form);
    formData.append("img", img.files[0]);
    const response = await fetch("makeArticle.php", {
        method: "POST",
        body: formData,
    });
    const json = await response.text();
    console.log(json);
    return;
    if (json.status == 251) {
        informationContainer.textContent =
            "articolo agginto alla listacon successo";
    } else if (json.status == 451) {
        errorContainer.textContent = "riempi tutti i campi";
        return;
    } else if (json.status == 452) {
        errorContainer.textContent = "errore nell'inserimento dell'immagine";
        return;
    }
});
