const errorContainer = document.getElementById("errorContainer");
const informationContainer = document.getElementById("informationContainer");
const addArticle = document.getElementById("addArticle");
const img = document.getElementById("img");

addArticle.addEventListener("submit", async (e) => {
    e.preventDefault();
    e.submitter.disabled = true;
    const form = document.getElementById("articleForm");
    const formData = new FormData(form);
    formData.append("img", img.files[0]);
    const response = await fetch("makeArticle.php", {
        method: "POST",
        body: formData,
    });
    const json = await response.json();
    console.log(json);
    // const article_id = json["data"]["article_id"];
    const article_id = json.data.article_id;
    console.log(article_id);
    if (json.status == 251) {
        window.location.replace(
            "../article/article.php?article_id=" + article_id
        );
    } else if (json.status == 451) {
        errorContainer.textContent = "Campi obbligatori non compilati";
    } else if (json.status == 452) {
        errorContainer.textContent = "Errore nell'inserimento dell'immagine";
    } else if (json.status == 453) {
        errorContainer.textContent = "L'estenzione del file non e' supportata";
    }
    e.submitter.disabled = false;
});
