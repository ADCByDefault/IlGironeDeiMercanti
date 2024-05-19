window.addEventListener("load", () => {
    const article_id = new URLSearchParams(window.location.search).get(
        "article_id"
    );
    getArticle(article_id);
});

async function getArticle(article_id) {
    const response = await fetch(`getArticle.php?article_id=${article_id}`);
    const article = await response.json();
    console.log(article);
}
