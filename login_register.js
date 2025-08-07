// Password toggle
document.addEventListener("DOMContentLoaded", () => {
    const togglePassword = document.getElementById("togglePassword");
    const password = document.getElementById("password");

    if (togglePassword && password) {
        togglePassword.addEventListener("click", () => {
            const type = password.getAttribute("type") === "password" ? "text" : "password";
            password.setAttribute("type", type);
            togglePassword.textContent = type === "password" ? "👁️" : "🙈";
    //         togglePassword.addEventListener("click", () => {
    // const type = passwordInput.type === "password" ? "text" : "password";
    // passwordInput.type = type;

    // togglePassword.className = type === "password" ? "ri-eye-line" : "ri-eye-off-line";
        });
    }

    // Page load animation
    const authLeft = document.querySelector(".auth-left");
    const authRight = document.querySelector(".auth-right");

    if (authLeft) {
        authLeft.style.opacity = 0;
        authLeft.style.transform = "translateX(-50px)";
        setTimeout(() => {
            authLeft.style.transition = "all 0.8s ease";
            authLeft.style.opacity = 1;
            authLeft.style.transform = "translateX(0)";
        }, 200);
    }

    if (authRight) {
        authRight.style.opacity = 0;
        authRight.style.transform = "translateX(50px)";
        setTimeout(() => {
            authRight.style.transition = "all 0.8s ease";
            authRight.style.opacity = 1;
            authRight.style.transform = "translateX(0)";
        }, 300);
    }
});
