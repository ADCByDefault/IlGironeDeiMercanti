const errorContainer = document.getElementById("errorContainer");
const articles = document.getElementById("articles");
const proposals = document.getElementById("proposals");
let cont = 1;
window.addEventListener("load", (event) => {
    getArticles();
    //getProposals();
});

async function getArticles() {
    const response = await fetch("getDashboardArticles.php", {
        method: "POST",
    });
    const data = await response.json();
    console.log(data);
    if (!data.status == "251") {
        const error = document.createElement("p");
        error.textContent = "Errore";
        errorContainer.appendChild(error);
        return;
    }
    if (data.data.length == 0) {
        const error = document.createElement("p");
        error.textContent = "non hai alcun articolo nel girone";
        errorContainer.appendChild(error);
        return;
    }
    data.data.forEach((article) => {
        const articleElement = createArticle(article);
        articles.appendChild(articleElement);
    });
    errorContainer.textContent = "";
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

async function getProposals() {
    const response = await fetch("getDashboardProposals.php", {
        method: "POST",
    });
    const data = await response.json();
    console.log(data);
    if (!data.status == "251") {
        const error = document.createElement("p");
        error.textContent = "Error";
        errorContainer.appendChild(error);
        return;
    }
    if (data.data.length == 0) {
        const error = document.createElement("p");
        error.textContent = "non hai effettuato 0 proposta";
        errorContainer.appendChild(error);
        return;
    }
    data.data.forEach((proposal) => {
        const proposalElement = createProposal(proposal);
        proposals.appendChild(proposalElement);
    });
}

function createProposal(proposal) {
    const proposalElement = document.createElement("div");
    proposalElement.classList.add("proposal");
    const proposal_id = document.createElement("h3");
    proposal_id.classList.add("proposal_id");
    proposal_id.textContent = "id proposta: " + proposal.proposal_id;
    const article_id = document.createElement("p");
    article_id.classList.add("article_id");
    article_id.textContent = "id articolo: " + proposal.article_id;
    const price = document.createElement("p");
    price.classList.add("price");
    price.textContent = "prezzo: " + proposal.price;
    const created_at = document.createElement("p");
    created_at.classList.add("created_at");
    created_at.textContent = proposal.created_at;
    const link = document.createElement("a");
    link.textContent = "vai al articolo";
    link.href = "../article/article.php?article_id=" + proposal.article_id;
    proposalElement.appendChild(proposal_id);
    proposalElement.appendChild(article_id);
    proposalElement.appendChild(price);
    proposalElement.appendChild(created_at);
    proposalElement.appendChild(link);
    return proposalElement;
}
