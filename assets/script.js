// switching section
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();

        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// view recipe
function view_recipe(id) {
    $("#viewRecipeModal").modal("show");

    let viewRecipeName = $("#recipeName-" + id).text();
    let viewCategoryName = $("#categoryName-" + id).text();
    let viewRecipeImage = $("#recipeImage-" + id).find('img').attr('src');
    let viewRecipeIngredients = $("#recipeIngredients-" + id).text();
    let viewRecipeProcedure = $("#recipeProcedure-" + id).text();

    // Update the modal content with the fetched data
    $("#viewRecipeName").text(viewRecipeName);
    $("#viewCategoryName").text(viewCategoryName);
    $("#viewRecipeImage").attr('src', viewRecipeImage);
    $("#viewRecipeIngredients").text(viewRecipeIngredients);
    $("#viewRecipeProcedure").text(viewRecipeProcedure);
}


// updating recipe 
function update_recipe(id) {
    $("#updateRecipeModal").modal("show");

    let updateRecipeID = $("#recipeID-" + id).text();
    let updateCategoryName = $("#categoryName-" + id).text();
    let updateRecipeImage = $("#recipeImage-" + id).find('img').attr('src');
    let updateRecipeName = $("#recipeName-" + id).text();
    let updateRecipeIngredients = $("#recipeIngredients-" + id).text();
    let updateRecipeProcedure = $("#recipeProcedure-" + id).text();

    $("#updateRecipeID").val(updateRecipeID);
    $("#updateRecipeCategory option").each(function() {
        let category = $(this).text();
        if (category === updateCategoryName) {
            $(this).prop("selected", true);
            return false;
        }
    });
    $("#updateRecipeName").val(updateRecipeName);
    $("#updateRecipeIngredients").val(updateRecipeIngredients);
    $("#updateRecipeProcedure").val(updateRecipeProcedure);
    $("#updateRecipeImage").html(updateRecipeImage);
}

// delete recipe
function delete_recipe(id) {

    if (confirm("Deseas eliminar esta receta?")) {
        window.location = "endpoint/delete-recipe.php?recipe=" + id
    }
}

// search
function performSearch() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("searchInput");
    filter = input.value.toLowerCase();
    table = document.getElementById("foodListTable");
    tr = table.getElementsByTagName("tr");

    for (i = 0; i < tr.length; i++) {
        var nameColumn = tr[i].getElementsByTagName("td")[1]; // Column for Recipe Name
        var categoryColumn = tr[i].getElementsByTagName("td")[2]; // Column for Category

        if (nameColumn || categoryColumn) {
            var nameText = nameColumn.textContent || nameColumn.innerText;
            var categoryText = categoryColumn.textContent || categoryColumn.innerText;

            if (nameText.toLowerCase().indexOf(filter) > -1 || categoryText.toLowerCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
        }
    }
}

// Attach an event listener to the search input field
document.getElementById("searchInput").addEventListener("keyup", performSearch);
