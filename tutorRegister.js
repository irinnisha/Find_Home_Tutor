document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('multiStepForm');
    const formSteps = document.querySelectorAll('.form-step');
    const progressBar = document.querySelector('.progress-bar');

    form.addEventListener('click', function (e) {
        if (e.target.classList.contains('next-btn') || e.target.classList.contains('prev-btn')) {
            e.preventDefault();
            const currentStep = e.target.closest('.form-step');
            const nextStep = e.target.dataset.step;

            updateProgressBar(nextStep);

            currentStep.style.display = 'none';
            formSteps[nextStep - 1].style.display = 'block';
        }
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        alert('Form submitted successfully!');
    });

    function updateProgressBar(step) {
        const steps = Array.from(document.querySelectorAll('.form-step'));

        steps.forEach((stepElem) => {
            const stepNumber = stepElem.dataset.step;
            stepElem.classList.remove('completed');
            if (stepNumber <= step) {
                stepElem.classList.add('completed');
            }
        });
    }
});
