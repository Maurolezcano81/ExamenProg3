window.addEventListener('DOMContentLoaded', () => {


    const modal = document.getElementById("priceModal");
    const btn = document.getElementById("toggleModal");
    const span = document.getElementById("closeModal");

    btn.onclick = function () {
        modal.style.display = "block";
    }

    span.onclick = function () {
        modal.style.display = "none";
    }

    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }


})
