

function openView(index) {
    let book = document.getElementsByClassName("caption")[index];
    book.style.display = "inline";
}

function closeView(index) {
    let book = document.getElementsByClassName("caption")[index];
    book.style.display = "none";
}