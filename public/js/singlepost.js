document.getElementById("switch").addEventListener("click", function () {
    document.getElementById("post").classList.toggle("d-none");
    document.getElementById("delete").classList.toggle("d-none");
    document.getElementById("editPost").classList.toggle("d-none");
    const switchButton = document.getElementById("switch");
    const switchText = document.getElementById("switchText");
    if (switchText.innerText === "Edit post") {
        switchText.innerText = "Stop editing post";
        switchButton.classList.remove("btn-warning");
        switchButton.classList.add("btn-danger");
        document.getElementById("editIcon").classList.toggle("d-none");
        document.getElementById("stopIcon").classList.toggle("d-none");

    } else {
        switchText.innerText = "Edit post";
        switchButton.classList.remove("btn-danger");
        switchButton.classList.add("btn-warning");
        document.getElementById("editIcon").classList.toggle("d-none");
        document.getElementById("stopIcon").classList.toggle("d-none");
    }
});
