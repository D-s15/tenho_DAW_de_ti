import './bootstrap';

document.addEventListener('DOMContentLoaded', function () {
    const password = document.getElementById('password');
    const confirm = document.getElementById('password_confirmation');
    const message = document.getElementById('message');

    if (password && confirm && message) {
        confirm.addEventListener('input', function () {
            if (password.value !== confirm.value) {
                message.textContent = "Passwords do not match";
                message.style.color = "red";
            } else {
                message.textContent = "";
            }
        });
    }
});