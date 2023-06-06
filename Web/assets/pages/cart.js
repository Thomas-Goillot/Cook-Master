//add event listener on .close class


function addVaucher(idVaucher, idCart){
    console.log(idVaucher);
    console.log(idCart);
    fetch("../shop/addVaucher", {
        method: "POST",
        body: JSON.stringify({
            idVaucher: idVaucher,
            idCart: idCart,
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


document.querySelectorAll(".close").forEach((element) => {
    element.addEventListener("click", function () {
        const id = this.dataset.id;
        deleteEquipmentInCart(id);
        this.parentNode.parentNode.remove();
    });
});

function incrementQuantity(id, idCart) {
    fetch("../shop/incrementQuantity", {
        method: "POST",
        body: JSON.stringify({
            idEquipment: id,
            idCart : idCart,
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

function decrementQuantity(id, idCart) {
    fetch("../shop/decrementQuantity", {
        method: "POST",
        body: JSON.stringify({
            idEquipment: id,
            idCart: idCart,
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