//add event listener on button id searchIngredient
document.getElementById("searchIngredient").addEventListener("click", function () {
    console.log("test");
    fetch(
      "https://api.spoonacular.com/food/ingredients/search?apiKey=7c54efd616d54ef88364d744339b3601&query=apple&number=2&sort=calories&sortDirection=desc"
    )
        .then((response) => response.json())
        .then((data) => {
            console.log(data);
        });
});

