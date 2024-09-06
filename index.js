document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');
    const responseDiv = document.getElementById('formResponse');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting the traditional way

        const formData = new FormData(form);

        fetch('send_message.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (response.ok) {
                return response.text();
            } else {
                throw new Error('Network response was not ok.');
            }
        })
        .then(data => {
            responseDiv.textContent = data;
            form.reset(); // Clear the form
        })
        .catch(error => {
            responseDiv.textContent = 'There was a problem with your submission.';
        });
    });
});
