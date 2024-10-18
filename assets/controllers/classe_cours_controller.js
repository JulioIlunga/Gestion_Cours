// assets/controllers/classe_cours_controller.js

import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['coursSelect'];

    updateCours(event) {
        const classId = event.target.value;
        const coursSelect = this.coursSelectTarget;

        fetch(`/evaluations/cours/${classId}`) // Remplacez par la route correcte
            .then(response => response.json())
            .then(cours => {
                coursSelect.innerHTML = ''; // Vider les options existantes

                cours.forEach(cours => {
                    const option = document.createElement('option');
                    option.value = cours.id;
                    option.text = cours.title;
                    coursSelect.appendChild(option);
                });
            });
    }
}