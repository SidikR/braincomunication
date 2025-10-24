function generateToken() {
    var token = "";
    var characters =
        "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    var charactersLength = characters.length;
    for (var i = 0; i < 200; i++) {
        token += characters.charAt(
            Math.floor(Math.random() * charactersLength)
        );
    }
    return token;
}

document
    .getElementById("generateTokenButton")
    .addEventListener("click", function () {
        var generatedToken = generateToken();
        document.getElementById("token").value = generatedToken;
    });
