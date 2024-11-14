document.addEventListener("DOMContentLoaded", function () {
    const mainSection = document.querySelector(".main-section");
    setTimeout(() => {
        mainSection.classList.add("loaded");
    }, 500);
});

document.addEventListener("DOMContentLoaded", function () {
    const mailIcon = document.getElementById("mailIcon");
    const feedbackModal = document.getElementById("feedbackModal");
    const closeModal = document.querySelector(".close");

    mailIcon.addEventListener("click", () => {
        feedbackModal.style.display = "block";
    });

    closeModal.addEventListener("click", () => {
        feedbackModal.style.display = "none";
    });

    window.addEventListener("click", (event) => {
        if (event.target === feedbackModal) {
            feedbackModal.style.display = "none";
        }
    });
});

document.getElementById("feedbackForm").addEventListener("submit", function (event) {
    event.preventDefault();

    const name = document.getElementById("name").value;
    const email = document.getElementById("email").value;
    const message = document.getElementById("message").value;

    const formData = new FormData();
    formData.append("name", name);
    formData.append("email", email);
    formData.append("message", message);

    fetch("sendFeedback.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                alert(data.message);
                document.getElementById("feedbackForm").reset();
                feedbackModal.style.display = "none";
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error("Ошибка:", error);
            alert("Произошла ошибка при отправке обратной связи.");
        });
});
