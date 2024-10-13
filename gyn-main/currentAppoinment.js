document.getElementById("add-fields").addEventListener("click", function (event) {
    event.preventDefault(); // Prevent form submission

    // Get the form element
    const form = document.getElementById("dynamic-form");

    // Create new set of input fields (3 labels and 3 inputs)
    const newInputGroup1 = document.createElement("div");
    newInputGroup1.classList.add("input-group");
    newInputGroup1.innerHTML = `
        <label for="newField1">New Field 1:</label>
        <input type="text" name="newField1">
    `;

    const newInputGroup2 = document.createElement("div");
    newInputGroup2.classList.add("input-group");
    newInputGroup2.innerHTML = `
        <label for="newField2">New Field 2:</label>
        <input type="text" name="newField2">
    `;

    const newInputGroup3 = document.createElement("div");
    newInputGroup3.classList.add("input-group");
    newInputGroup3.innerHTML = `
        <label for="newField3">New Field 3:</label>
        <input type="text" name="newField3">
    `;

    // Append the new input fields to the form
    form.appendChild(newInputGroup1);
    form.appendChild(newInputGroup2);
    form.appendChild(newInputGroup3);
});