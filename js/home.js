console.log('Hello World');

const userRecipesContainer = document.querySelectorAll(".user-recipe");
userRecipesContainer.forEach(userRecipe => {
    /* Adjust the title */
    if (userRecipe.value.length > 14) {
        userRecipe.value = user.Recipe.value.slice(0, 13) + "...";
    } 
})