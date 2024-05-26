const articlesContainer = document.getElementById("articlesContainer");
const errorContainer = document.getElementById("errorContainer");
window.addEventListener("load", () => {
    getAllArticles();
});

async function getAllArticles() {
    try {
        const response = await fetch("getAllArticles.php", {
            method: "GET",
        });
        const data = await response.json();
        console.log(response);
        console.log(data);
        if (data.status == "251") {
            data.data.forEach((article) => {
                const articleElement = createArticle(article);
                articlesContainer.appendChild(articleElement);
            });
            errorContainer.textContent = "";
            return;
        }
        if (data.status == "551") {
            errorContainer.textContent = "errore interno al server";
            return;
        }
        throw new Error("errore sconosciuto");
    } catch (error) {
        console.error(error);
        errorContainer.textContent = "errore nel fetch o nella risposta";
    }
}

function createArticle(article) {
    const articleElement = document.createElement("div");
    articleElement.id = article.article_id;
    articleElement.classList.add("article");
    const name = document.createElement("h3");
    name.classList.add("name");
    name.textContent = article.name;
    const description = document.createElement("p");
    description.classList.add("description");
    description.textContent = article.description;
    const type = document.createElement("p");
    type.classList.add("type");
    type.textContent = "categoria: " + article.type;
    const user = document.createElement("p");
    user.classList.add("user");
    user.textContent = article.username;
    const link = document.createElement("a");
    link.href = "article/article.php?article_id=" + article.article_id;
    link.innerHTML = "vai all'articolo &rarr;";
    link.classList.add("link");
    const images = createImages(article.images);
    // appending
    const contentContainer = document.createElement("div");
    contentContainer.classList.add("content");
    contentContainer.appendChild(name);
    contentContainer.appendChild(description);
    contentContainer.appendChild(type);
    contentContainer.appendChild(user);
    contentContainer.appendChild(link);
    articleElement.appendChild(images);
    articleElement.appendChild(contentContainer);
    return articleElement;
}

function createImages(images) {
    const pathToRoot = "../";
    const imagesContainer = document.createElement("div");
    imagesContainer.classList.add("images-container");
    images.forEach((image) => {
        const imageElement = document.createElement("img");
        imageElement.classList.add("image");
        imageElement.src = pathToRoot + image;
        imageElement.alt = image.alt || "immagine non disponibile";
        imageElement.loading = "lazy";
        imagesContainer.appendChild(imageElement);
    });
    return imagesContainer;
}
