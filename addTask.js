document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector(".add_task_form");
    const inputs = form.querySelectorAll(".form_item");

    const successMsg = document.createElement("div");
    successMsg.className = "success-message";
    successMsg.innerText = "✅ Task added successfully!";
    successMsg.style.display = "none";
    form.after(successMsg);

    form.addEventListener("submit", function (e) {
        e.preventDefault(); // Stop default form submission

        let hasError = false;
        const formData = new FormData(form);

        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.classList.add("shake");
                hasError = true;

                setTimeout(() => {
                    input.classList.remove("shake");
                }, 300);
            }
        });

        if (!hasError) {
            // Send form data to PHP via AJAX (fetch)
            fetch("add_task_process.php", {
                method: "POST",
                body: formData,
            })
            .then(res => res.text())
            .then(data => {
                // Show success message only if PHP confirms success
                if (data.includes("success") || data.trim() === "") {
                    successMsg.style.display = "block";
                    form.reset();

                    setTimeout(() => {
                        successMsg.style.display = "none";
                    }, 3000);
                } else {
                    alert("❌ Task add failed: " + data);
                }
            })
            .catch(err => {
                alert("❌ Error sending task: " + err.message);
            });
        }
    });
});
