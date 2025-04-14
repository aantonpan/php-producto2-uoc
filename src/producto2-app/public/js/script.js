document.addEventListener("DOMContentLoaded", function () {
    const helloText = document.getElementById("hello-text");

    if (helloText) {
        const languages = ["Hola Mundo", "Hello World", "Hola Món"];
        let index = 0;

        setInterval(() => {
            // Efecto de desvanecimiento
            helloText.style.opacity = 0;

            setTimeout(() => {
                // Cambiar texto
                index = (index + 1) % languages.length;
                helloText.textContent = languages[index];
                helloText.style.opacity = 1;
            }, 500);
        }, 3000);
    }

    // Otro elemento opcional
    const el = document.getElementById("algo");
    if (el) {
        el.style.color = "red";
    }
});
