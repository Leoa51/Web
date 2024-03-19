function validateForm() {
    var companyName = document.getElementById('company_name').value.trim();
    var skills = document.getElementById('skills').value.trim();
    var location = document.getElementById('location').value.trim();
    var promotions = document.getElementById('promotions').value.trim();
    var duration = document.getElementById('duration').value.trim();
    var remuneration = document.getElementById('remuneration').value.trim();
    var publicationDate = document.getElementById('publication_date').value.trim();
    var availablePlaces = document.getElementById('available_places').value.trim();
    var motivationLetter = document.getElementById('motivationLetter').value.trim();


    if (companyName === '' || skills === '' || location === '' || promotions === '' || duration === '' || remuneration === '' || publicationDate === '' || availablePlaces === '' || motivationLetter === '') {
    alert('Veuillez remplir tous les champs.');
    return false;
}

    // Autres validations éventuelles peuvent être ajoutées ici

    return true;
}

