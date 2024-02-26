document.getElementById("switch").addEventListener("click", function () {
    document.getElementById("seeTopics").classList.toggle("d-none");
    document.getElementById("newTopic").classList.toggle("d-none");
    const switchButton = document.getElementById("switch");
    const switchText = document.getElementById("switchText");
    if (switchText.innerText === "Create a new topic") {
        switchText.innerText = "Stop creating new topic";
        switchButton.classList.remove("btn-primary");
        switchButton.classList.add("btn-danger");
        document.getElementById("plusIcon").classList.toggle("d-none");
        document.getElementById("minusIcon").classList.toggle("d-none");

    } else {
        switchText.innerText = "Create a new topic";
        switchButton.classList.remove("btn-danger");
        switchButton.classList.add("btn-primary");
        document.getElementById("plusIcon").classList.toggle("d-none");
        document.getElementById("minusIcon").classList.toggle("d-none");
    }
});
