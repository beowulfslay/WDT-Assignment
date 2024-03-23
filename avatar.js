function generateAvatar(foregroundColor, backgroundColor) {
    console.log("Generating avatar");
    var avatarSrc = localStorage.getItem('avatarSrc');
    if (!avatarSrc) {
        // https://dev.to/dcodeyt/build-a-user-profile-avatar-generator-with-javascript-436m
        var initials = document.getElementById("username").textContent.charAt(0).toUpperCase();
        const canvas = document.createElement("canvas");
        const context = canvas.getContext("2d");

        canvas.width = 200;
        canvas.height = 200;

        // Draw background
        context.fillStyle = backgroundColor;
        context.fillRect(0, 0, canvas.width, canvas.height);

        // Draw text
        context.font = "bold 100px arial, sans-serif";
        context.fillStyle = foregroundColor;
        context.textAlign = "center";
        context.textBaseline = "middle";
        context.fillText(initials, canvas.width / 2, canvas.height / 2);

        var avatarSrc = canvas.toDataURL("image/png");
        localStorage.setItem('avatarSrc', avatarSrc)
    }
    document.getElementById("avatar").src = avatarSrc;

}