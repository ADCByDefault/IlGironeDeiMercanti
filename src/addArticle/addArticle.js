const errorContainer = document.getElementById("errorContainer");
const informationContainer = document.getElementById("informationContainer");
const addArticle = document.getElementById("addArticle");
const img = document.getElementById("img");

addArticle.addEventListener("submit", async (e) => {
    e.preventDefault();
    e.submitter.disabled = true;
    try {
        informationContainer.innerHTML = "<span class='loader'></span>";
        const form = document.getElementById("articleForm");
        const formData = new FormData(form);
        const response = await fetch("makeArticle.php", {
            method: "POST",
            body: formData,
        });
        const json = await response.json();
        console.log(json);
        // const article_id = json["data"]["article_id"];
        const article_id = json.data.article_id;
        console.log(article_id);
        errorContainer.innerHTML = "";
        informationContainer.innerHTML = "";
        if (json.status == 251) {
            window.location.replace(
                "../article/article.php?article_id=" + article_id
            );
            return;
        } else if (json.status == 451) {
            errorContainer.innerHTML = "Campi obbligatori non compilati";
        } else if (json.status == 452) {
            errorContainer.innerHTML = "Errore nell'inserimento dell'immagine";
        } else if (json.status == 453) {
            errorContainer.innerHTML =
                "L'estenzione del file non e' supportata";
        }else if (json.status == 553) {
            errorContainer.innerHTML = "Errore Interno al server";
        }
    } catch (e) {
        errorContainer.innerHTML = "";
        informationContainer.innerHTML = "";
        console.error(e);
        errorContainer.innerHTML = "Errore nella comunicazione col server";
    }
    e.submitter.disabled = false;
});
