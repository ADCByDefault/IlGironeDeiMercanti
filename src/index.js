const articlesContainer = document.getElementById("articlesContainer");
const typeSelect = document.getElementById("typeSelect");
const errorContainer = document.getElementById("errorContainer");
let cont = 1;
window.addEventListener("load", () => {
    getAllArticles();
});
typeSelect.addEventListener("change", () => {
    const type_id = typeSelect.value;
    window.location.replace("index.php?type_id=" + type_id);
});
async function getAllArticles() {
    const urlParams = new URLSearchParams(window.location.search);
    let type_id = urlParams.get("type_id");
    if (!["0", "1", "2", "3", "4", "5", "6"].includes(type_id)) {
        type_id = "0";
    }
    typeSelect.value = type_id;
    try {
        const response = await fetch(`getAllArticles.php?type_id=${type_id}`, {
            method: "GET",
        }).catch((error)=>{
            console.error(error);
            errorContainer.textContent = "Errore nella comunicazione con il server";
            return;
        });
        const data = await response.json();
        console.log(response);
        console.log(data);

        const status = data?.status ? data.status : "";
        switch (status) {
            case "251":
                    data.data.forEach((article) => {
                    const articleElement = createArticle(article);
                    articlesContainer.appendChild(articleElement);
                });
                errorContainer.textContent = "";
                break;
            case "551":
                errorContainer.textContent = "Nessun Articolo Trovato";
                break;
            default:
                errorContainer.textContent = "Errore sconosciuto";
                break;
        }
    } catch (error) {
        console.error(error);
        errorContainer.textContent = "Errore nel fetch della risposta";
    }
}

function createArticle(article) {
    const articleElement = document.createElement("div");
    articleElement.id = article.article_id;
    articleElement.classList.add("article");
    const name = document.createElement("h3");
    name.classList.add("name");
    name.textContent = article.name;
    // const description = document.createElement("p");
    // description.classList.add("description");
    // description.textContent = article.description;
    const type = document.createElement("p");
    type.classList.add("type");
    type.textContent = article.type;
    // const user = document.createElement("p");
    // user.classList.add("user");
    // user.textContent = article.username;
    const link = document.createElement("a");
    link.href = "article/article.php?article_id=" + article.article_id;
    link.innerHTML = "vai all'articolo &rarr;";
    link.classList.add("link");
    const images = createImages(article.images);
    // appending
    const contentContainer = document.createElement("div");
    contentContainer.classList.add("content");
    contentContainer.appendChild(name);
    // contentContainer.appendChild(description);
    contentContainer.appendChild(type);
    // contentContainer.appendChild(user);
    contentContainer.appendChild(link);
    articleElement.appendChild(images);
    articleElement.appendChild(contentContainer);
    return articleElement;
}

function createImages(images) {
    const wrapper = document.createElement("div");
    wrapper.classList.add("slider-wrapper");
    const slider = document.createElement("div");
    slider.classList.add("slider");
    const dots = document.createElement("div");
    dots.classList.add("dots");
    wrapper.append(slider, dots);
    const pathToRoot = "../";
    images.forEach((image) => {
        const div = document.createElement("div");
        div.classList.add("slide");
        div.id = "image" + cont;
        div.style.backgroundImage = `url(${pathToRoot}${image})`;
        slider.appendChild(div);
        const dot = document.createElement("a");
        dot.href = "#image" + cont;
        dots.appendChild(dot);
        cont++;
    });
    if (images.length == 0) {
        const div = document.createElement("div");
        div.classList.add("slide");
        div.classList.add("default-image");
        slider.appendChild(div);
    }
    return wrapper;
}
