const addButton=document.getElementById('addButton');
const deleteButtonButton=document.getElementById('deleteButton');
const addForm=document.getElementById('add_item');
const deleteForm=document.getElementById('delete_item');
 


deleteButton.addEventListener('click', function () {
    addForm.style.display="none";
    deleteForm.style.display="block";
});
addButton.addEventListener('click', function () {
  addForm.style.display="block";
    deleteForm.style.display="none";
});


