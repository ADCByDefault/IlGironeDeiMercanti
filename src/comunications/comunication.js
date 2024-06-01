const errorContainer = document.getElementById("errorContainer");
const informationContainer = document.getElementById("informationContainer");
const proposals = document.getElementById("proposals");



window.addEventListener("load", (event) => {
    getProposals();
});


async function getProposals() {
    const response = await fetch("getComunications.php", {
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
    const status = document.createElement("p");
    let stato = "";
    if(proposal.status == 1){
        stato = "accettato";
        status.classList.add("accettato");
    }
    if(proposal.status == -1){
        stato = "rifiutato";
        status.classList.add("rfiustato");
    }
    if(proposal.status == 0){
        stato = "in analisi";
    status.classList.add("analisi");
    }
    status.textContent = "stato: " + stato;
    const link = document.createElement("a");
    link.textContent = "vai al articolo";
    link.href = "../article/article.php?article_id=" + proposal.article_id;
    proposalElement.appendChild(proposal_id);
    proposalElement.appendChild(article_id);
    proposalElement.appendChild(price);
    proposalElement.appendChild(status);
    proposalElement.appendChild(link);
    return proposalElement;
}
