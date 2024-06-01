const errorContainer = document.getElementById("errorContainer");
const informationContainer = document.getElementById("informationContainer");
const articleNameContainer = document.getElementById("name");
const articleUsernameContainer = document.getElementById("username");
const articleDescriptionContainer = document.getElementById("description");
const articleCreatedAtContainer = document.getElementById("created_at");
const articleImagesContainer = document.getElementById("imagesContainer");
const makeProposal = document.getElementById("makeProposal");
const proposalsContainer = document.getElementById("proposalsContainer");
const article_idContainer = document.getElementById("article_id");
const dots = document.getElementById("dots");
let cont = 1;
window.addEventListener("load", () => {
    const article_id = new URLSearchParams(window.location.search).get(
        "article_id"
    );
    setPage(article_id);
});

async function setPage(article_id) {
    const res = await getArticle(article_id);
    if (res.status == 451) {
        errorContainer.textContent = "errore generico";
        return;
    }
    const article = res.data;
    setArticle(article);
    article_idContainer.value = article.article_id;
    setProposals(article.proposals ? article.proposals : []);
    if (article.username == article.request_username) {
        makeProposal.style.display = "none";
    } else {
        const forms = Array.from(
            document.querySelectorAll("#proposalsContainer form")
        );
        forms.forEach((form) => {
            form.remove();
        });
    }
    const prop = Array.from(document.querySelectorAll(".declined form, .accepted from"));
    prop.forEach((p) => {
        p.remove();
    });
    informationContainer.textContent = "";
    console.log(article);
}

async function getArticle(article_id) {
    const response = await fetch(`getArticle.php?article_id=${article_id}`);
    const article = await response.json();
    console.log(article.data);
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
        const div = document.createElement("div");
        div.classList.add("slide");
        div.id = "image" + cont;
        div.style.backgroundImage = `url(${pathToRoot}${image})`;
        articleImagesContainer.appendChild(div);
        const dot = document.createElement("a");
        dot.href = "#image" + cont;
        dots.appendChild(dot);
        cont++;
    });
}

function setProposals(proposals) {
    if (!proposals || proposals.length == 0) {
        const p = document.createElement("p");
        p.textContent = "non ci sono proposte";
        proposalsContainer.appendChild(p);
        return;
    }
    proposals.forEach((proposal) => {
        const proposalElement = document.createElement("div");
        proposalElement.classList.add("proposal");
        if (proposal.status == 1) {
            proposalElement.classList.add("accepted");
        }
        if (proposal.status == -1) {
            proposalElement.classList.add("declined");
        }
        const usernameElement = document.createElement("p");
        usernameElement.textContent = proposal.username;
        const priceElement = document.createElement("p");
        priceElement.textContent = "prezzo: " + proposal.price + " fiorini";
        const createdAtElement = document.createElement("p");
        createdAtElement.textContent = proposal.created_at;

        const acceptForm = makeAcceptOrDeclineForms(
            proposal.proposal_id,
            "acceptProposal.php",
            proposal.status
        );
        addListenerToForm(acceptForm, "acceptProposal.php");
        const declineForm = makeAcceptOrDeclineForms(
            proposal.proposal_id,
            "declineProposal.php",
            proposal.status
        );
        addListenerToForm(declineForm, "declineProposal.php");
        const proposalContent = document.createElement("div");
        proposalContent.classList.add("proposal-content");
        proposalContent.appendChild(usernameElement);
        proposalContent.appendChild(priceElement);
        proposalContent.appendChild(createdAtElement);
        proposalElement.appendChild(proposalContent);
        proposalElement.appendChild(acceptForm);
        proposalElement.appendChild(declineForm);
        proposalsContainer.appendChild(proposalElement);
    });
}
function makeAcceptOrDeclineForms(proposal_id, action, status) {
    const form = document.createElement("form");
    form.method = "POST";
    form.action = action;
    const hiddenInput = document.createElement("input");
    hiddenInput.type = "hidden";
    hiddenInput.name = "proposal_id";
    hiddenInput.value = proposal_id;
    form.appendChild(hiddenInput);
    const button = document.createElement("button");
    button.classList.add("btn", "secondary");
    button.textContent = "rifiuta";
    if (action == "acceptProposal.php") {
        button.textContent = "accetta";
        button.classList.remove("secondary");
    }
    if (status != 0) {
        button.disabled = true;
    } else {
        form.appendChild(button);
    }
    return form;
}
function addListenerToForm(form, action) {
    form.addEventListener("submit", async (e) => {
        e.preventDefault();
        informationContainer.textContent = "Loading...";
        while (proposalsContainer.firstChild) {
            proposalsContainer.removeChild(proposalsContainer.firstChild);
        }
        proposalsContainer.textContent = "loading...";
        const buttons = Array.from(document.querySelectorAll("button"));
        buttons.forEach((button) => {
            button.disabled = true;
        });
        const formData = new FormData(form);
        const response = await fetch(action, {
            method: form.method,
            body: formData,
        });
        const json = await response.json();
        console.log(json);
        location.reload();
    });
}

makeProposal.addEventListener("submit", async (e) => {
    e.preventDefault();
    e.submitter.disabled = true;
    errorContainer.textContent = "";
    informationContainer.textContent = "Loading...";
    const form = document.getElementById("proposalForm");
    const formData = new FormData(form);
    const response = await fetch("makeProposal.php", {
        method: "POST",
        body: formData,
    });
    const json = await response.json();
    console.log(json);
    errorContainer.textContent = "";
    informationContainer.textContent = "";
    if (json.status == 251) {
        informationContainer.textContent = "proposta inviata con successo";
    } else if (json.status == 252) {
        informationContainer.textContent = "proposta aggiornata con successo";
    } else if (json.status == 451) {
        errorContainer.textContent = "non è stato inserito un prezzo";
    } else if (json.status == 452) {
        errorContainer.textContent = "non è stata scelta nessuna proposta";
    } else if (json.status == 454) {
        errorContainer.textContent = "una proposta è già stata accettata";
    }
    await sleep(3000);
    window.location.reload();
});

function sleep(ms) {
    return new Promise((resolve) => setTimeout(resolve, ms));
}
