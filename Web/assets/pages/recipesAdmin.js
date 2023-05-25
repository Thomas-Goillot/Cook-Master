//add event listener on button id searchIngredient
document.getElementById("searchIngredient").addEventListener("click", function () {

    event.preventDefault();

    if (document.getElementById("ingredient").value == "") {
      sendAlert("Erreur", "Veuillez saisir un ingrédient", "error");
      return;
    }

    let ingredient = document.getElementById("ingredient").value;
    let number = document.getElementById("numberOutput").value;
    const table = document.getElementById("tableIngredients");

    fetch(
      "https://api.spoonacular.com/food/ingredients/search?apiKey=7c54efd616d54ef88364d744339b3601&query="+ingredient+"&number="+number+"&sort=calories&sortDirection=desc"
    )
      .then((response) => response.json())
      .then((data) => {
        if (data.results.length == 0) {
          sendAlert("Erreur", "Aucun ingrédient trouvé", "error");
          return;
        }

        for (let i = table.rows.length - 1; i > 0; i--) {
          table.deleteRow(i);
        }
        
        for (let i = 0; i < data.results.length; i++) {
          let row = table.insertRow(i + 1);
          let cell1 = row.insertCell(0);
          let cell2 = row.insertCell(1);

          cell1.innerHTML = data.results[i].name;
          //add a button to add to the table recipeTable
          cell2.innerHTML =
            '<button type="button" class="btn btn-primary addIngredient" data-name="' +
            data.results[i].name +
            '" data-id="' +
            data.results[i].id +
            '">Ajouter</button>';
        }

        document.querySelectorAll(".addIngredient").forEach((element) => {
          element.addEventListener("click", function () {
            let name = this.dataset.name;
            let id = this.dataset.id;

            let table = document.getElementById("recipeTable");
            let row = table.insertRow(1);
            let cell1 = row.insertCell(0);
            let cell2 = row.insertCell(1);
            let cell3 = row.insertCell(2);

            cell1.innerHTML = '<input type="text" name="ingredients[]" class="form-control" value="' + name + '">';
            cell2.innerHTML = '<input type="text" name="quantities[]" class="form-control" value="1">';
            cell3.innerHTML =
              '<a class="btn btn-link btn-lg text-primary" data-id="' +
              id +
              '" onclick="deleteIngredient(this)"><i class="mdi mdi-delete"></i></a>';
          });
        });

      });
  });

function deleteIngredient(e) {
  let table = document.getElementById("recipeTable");
  e.parentNode.parentNode.remove();
}
