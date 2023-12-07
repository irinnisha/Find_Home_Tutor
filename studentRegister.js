document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('multiStepForm');
    const formSteps = document.querySelectorAll('.form-step');
    const progressBar = document.querySelector('.progress-bar');

    form.addEventListener('click', function (e) {
        if (e.target.classList.contains('next-btn') || e.target.classList.contains('prev-btn')) {
            e.preventDefault();
            if (validateCurrentStep()) {
                const currentStep = e.target.closest('.form-step');
                const nextStep = e.target.dataset.step;

                updateProgressBar(nextStep);

                currentStep.style.display = 'none';
                formSteps[nextStep - 1].style.display = 'block';
            }
        }
    });

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        if (validateForm()) {
            // Get form data
            const formData = new FormData(form);

            // Make an AJAX request
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'process_registration.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 400) {
                    // Success
                    console.log(xhr.responseText);

                    // Optionally, you can redirect or perform other actions based on the response
                    // window.location.href = 'success_page.html';
                } else {
                    // Error
                    console.error('Request failed with status:', xhr.status);
                }
            };

            xhr.onerror = function () {
                console.error('Request failed');
            };

            // Send the form data
            xhr.send(new URLSearchParams(formData));
        }
    });

    function updateProgressBar(step) {
        const steps = Array.from(document.querySelectorAll('.step'));

        steps.forEach((stepElem) => {
            const stepNumber = stepElem.dataset.step;
            stepElem.classList.remove('completed');
            if (stepNumber <= step) {
                stepElem.classList.add('completed');
            }
        });
    }

    function validateCurrentStep() {
        const currentStep = form.querySelector('.form-step:not([style="display: none;"])');
        const requiredFields = currentStep.querySelectorAll('input[required], select[required]');

        for (const field of requiredFields) {
            if (!field.value.trim()) {
                alert('Please fill out all required fields.');
                return false;
            }
        }

        return true;
    }

    function validateForm() {
        const allSteps = Array.from(formSteps);
        const requiredFields = allSteps.reduce((fields, step) => {
            const stepFields = step.querySelectorAll('input[required], select[required]');
            fields.push(...stepFields);
            return fields;
        }, []);

        for (const field of requiredFields) {
            if (!field.value.trim()) {
                alert('Please fill out all required fields.');
                return false;
            }
        }

        return true;
    }
});
