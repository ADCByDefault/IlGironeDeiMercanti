const informationContainer = document.getElementById("informationContainer");
const username = document.getElementById("username");
const user_image = document.getElementById("user_image");
const first_name = document.getElementById("first_name");
const last_name = document.getElementById("last_name");
const articlesContainer = document.getElementById("articlesContainer");
let cont = 1;
window.addEventListener("load", async () => {
    const user_id = new URLSearchParams(window.location.search).get("user_id");
    setPage(user_id).catch((error) => {
        console.log(error);
        informationContainer.classList.add("error");
        informationContainer.innerHTML = "Errore nel caricamento della pagina";
        const p = document.createElement("p");
        const link = document.createElement("a");
        link.classList.add("link");
        link.href = "../index.php";
        link.textContent = "🏠 Torna alla home";
        p.appendChild(link);
        informationContainer.appendChild(p);
    });
});
async function setPage(user_id) {
    const response = await fetch(`getUser.php?user_id=${user_id}`);
    const json = await response.json();
    console.log(json);
    const status = json?.status ? json.status : 550;
    const data = json.data;
    switch (status) {
        case 550:
            informationContainer.innerHTML =
                "Errore nella comunicazione con il server";
            break;
        case 451:
        case 452:
            informationContainer.innerHTML = "Utente non trovato";
            break;
        case 250:
            username.textContent = data.username;
            user_image.src = "../../"+data.image_url;
            first_name.textContent = data.first_name;
            last_name.textContent = data.last_name;
            if (data.articles.length == 0) {
                const p = document.createElement("p");
                p.classList.add("error");
                p.textContent = "Nessun articolo pubblicato";
                articlesContainer.after(p);
            } else {
                data.articles.forEach((article) => {
                    const articleElement = createArticle(article);
                    articlesContainer.appendChild(articleElement);
                });
            }
            informationContainer.innerHTML = "";
            return;
            break;
        default:
            informationContainer.innerHTML = "Errore sconosciuto";
            break;
    }
    const link = document.createElement("a");
    const p = document.createElement("p");
    link.classList.add("link");
    link.href = "../index.php";
    link.textContent = "🏠 Torna alla home";
    p.appendChild(link);
    informationContainer.appendChild(p);
    informationContainer.classList.add("error");
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
    link.href = "../article/article.php?article_id=" + article.article_id;
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
    const pathToRoot = "../../";
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
