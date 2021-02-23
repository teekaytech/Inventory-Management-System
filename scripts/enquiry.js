const categories = document.getElementsByName('category');
const startDate = document.querySelector(".start-date");
const endDate = document.querySelector(".end-date");
const submitForm = document.querySelector('.fetch-data');

startDate.style.display = 'none';
endDate.style.display = 'none';
submitForm.style.display = 'none';

categories.forEach(function(category) {
    category.addEventListener('click', function() {
        startDate.style.display = 'block';
        endDate.style.display = 'block';
        submitForm.style.display = 'block';
    });
})