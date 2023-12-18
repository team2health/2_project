document.getElementById('categoryDropdownButton').addEventListener('click', function() {
    var categoryDropdown = document.getElementById('categoryDropdown');
    categoryDropdown.style.display = (categoryDropdown.style.display === 'none' || categoryDropdown.style.display === '') ? 'block' : 'none';
});