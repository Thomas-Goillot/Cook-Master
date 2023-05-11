//add event listener on .close class

document.querySelectorAll(".close").forEach((element) => {
    element.addEventListener("click", function () {
        const id = this.dataset.id;
        deleteEquipmentInCart(id);
        this.parentNode.parentNode.remove();
    });
});

function deleteEquipmentInCart(id) {

    fetch("../shop/deleteProductInCart", {
        method: "POST",
        body: JSON.stringify({
            idEquipment: id,
        }),
        headers: {
            "Content-Type": "application/json",
        },
        }).then((response) => response.json())
        .then((data) => {
            sendAlert(data.title, data.message, data.type);

            if(data.redirect == true) {
                setTimeout(function () {
                    window.location.href = '../shop'
                }, 500);
            }

        }
    );

}