

function openView(index) {
    console.log(document.getElementsByClassName('caption')[index])
    let book = document.getElementsByClassName("caption")[index];
    book.style.display = "inline";
}

function closeView(index) {
    let book = document.getElementsByClassName("caption")[index];
    book.style.display = "none";
}