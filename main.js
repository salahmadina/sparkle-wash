document.addEventListener('DOMContentLoaded', function () {
    var services = {
        basic:   { name: 'Basic Wash',   price: '50 EGP',  details: 'Exterior wash, windows cleaned, tires rinsed, and full drying.' },
        premium: { name: 'Premium Wash', price: '100 EGP', details: 'Exterior wash, interior vacuum, dashboard polish, glass cleaning, and tire shine.' },
        full:    { name: 'Full Service', price: '150 EGP', details: 'Exterior wash, interior clean, tire shine, glass cleaning, and dashboard polish.' }
    };

    document.querySelectorAll('input[name="service_type"]').forEach(function (input) {
        input.addEventListener('change', function () {
            var s = services[input.value];
            if (!s) return;
            document.getElementById('summary-service').textContent = s.name;
            document.getElementById('summary-price').textContent   = s.price;
            document.getElementById('summary-details').textContent = s.details;
        });
    });

    var timeSelect = document.querySelector('select[name="time_slot"]');
    if (timeSelect) {
        timeSelect.addEventListener('change', function () {
            document.getElementById('summary-time').textContent = timeSelect.value;
        });
    }

    var dateInput = document.querySelector('input[name="booking_date"]');
    if (dateInput) {
        dateInput.addEventListener('change', function () {
            document.getElementById('summary-date').textContent = dateInput.value;
        });
    }
});
