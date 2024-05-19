const errorContainer = document.getElementById("errorContainer");
const articleNameContainer = document.getElementById("name");
const articleUsernameContainer = document.getElementById("username");
const articleDescriptionContainer = document.getElementById("description");
const articleCreatedAtContainer = document.getElementById("created_at");
const articleImagesContainer = document.getElementById("imagesContainer");
const makeProposal = document.getElementById("makeProposal");
const proposalsContainer = document.getElementById("proposalsContainer");

window.addEventListener("load", () => {
    const article_id = new URLSearchParams(window.location.search).get(
        "article_id"
    );
    setPage(article_id);
});

async function setPage(article_id) {
    const res = await getArticle(article_id);
    if (res.status !== 251) {
        errorContainer.textContent = "error da settare";
        return;
    }
    const article = res.data;
    setArticle(article);
    console.log(article);
    if (article.request_username == null) {
        makeProposal.style.display = "none";
        proposalsContainer.style.display = "none";
        return;
    }
    if (article.username == article.request_username) {
        setProposals(article.proposals);
        makeProposal.style.display = "none";
        return;
    }
    proposalsContainer.style.display = "none";
}

async function getArticle(article_id) {
    const response = await fetch(`getArticle.php?article_id=${article_id}`);
    const article = await response.json();
    return article;
}

async function setArticle(article) {
    articleNameContainer.textContent = article.name;
    articleUsernameContainer.textContent = article.username;
    articleDescriptionContainer.textContent = article.description;
    articleCreatedAtContainer.textContent = article.created_at;
    setImages(article.images);
}

function setImages(images) {
    const pathToRoot = "../../";
    images.forEach((image) => {
        const imageElement = document.createElement("img");
        imageElement.classList.add("image");
        imageElement.src = pathToRoot + image;
        imageElement.alt = image.alt || "immagine non disponibile";
        imageElement.loading = "lazy";
        articleImagesContainer.appendChild(imageElement);
    });
}

function setProposals(proposals) {
    if (!proposals) {
        return;
    }
    proposals.forEach((proposal) => {
        const proposalElement = document.createElement("div");
        proposalElement.classList.add("proposal");
        const usernameElement = document.createElement("p");
        usernameElement.textContent = proposal.username;
        const priceElement = document.createElement("p");
        priceElement.textContent = proposal.price;
        const createdAtElement = document.createElement("p");
        createdAtElement.textContent = proposal.created_at;
        proposalElement.appendChild(usernameElement);
        proposalElement.appendChild(priceElement);
        proposalElement.appendChild(createdAtElement);
        proposalsContainer.appendChild(proposalElement);
    });
}
