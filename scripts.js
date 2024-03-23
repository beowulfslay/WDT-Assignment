document.addEventListener("DOMContentLoaded", function () {
    document.getElementById('signout').addEventListener('click', function () {
        localStorage.removeItem('avatarSrc');
    });
});

