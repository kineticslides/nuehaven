document.addEventListener('DOMContentLoaded', () => {
    const bookingForm = document.querySelector('[data-booking-form]');
    const checkInInput = document.querySelector('[data-check-in]');
    const checkOutInput = document.querySelector('[data-check-out]');
    const statusMessage = document.querySelector('[data-booking-status]');
    const bookingPanel = document.querySelector('#booking');
    const bookingLinks = document.querySelectorAll('a[href="#booking"]');

    if (!(bookingForm instanceof HTMLFormElement)
        || !(checkInInput instanceof HTMLInputElement)
        || !(checkOutInput instanceof HTMLInputElement)) {
        return;
    }

    bookingLinks.forEach((bookingLink) => {
        bookingLink.addEventListener('click', (event) => {
            event.preventDefault();

            if (!(bookingPanel instanceof HTMLElement)) {
                return;
            }

            const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            bookingPanel.scrollIntoView({
                behavior: prefersReducedMotion ? 'auto' : 'smooth',
                block: 'center',
            });

            window.history.replaceState(null, '', '#booking');
        });
    });

    const formatDate = (date) => date.toISOString().split('T')[0];
    const today = new Date();
    const defaultCheckIn = new Date(today);
    const defaultCheckOut = new Date(today);

    defaultCheckIn.setDate(today.getDate() + 7);
    defaultCheckOut.setDate(today.getDate() + 9);

    checkInInput.min = formatDate(today);
    checkInInput.value ||= formatDate(defaultCheckIn);
    checkOutInput.value ||= formatDate(defaultCheckOut);

    const updateCheckOutMinimum = () => {
        const nextDay = new Date(`${checkInInput.value}T00:00:00`);

        nextDay.setDate(nextDay.getDate() + 1);
        checkOutInput.min = formatDate(nextDay);

        if (!checkOutInput.value || checkOutInput.value <= checkInInput.value) {
            checkOutInput.value = formatDate(nextDay);
        }
    };

    checkInInput.addEventListener('change', updateCheckOutMinimum);
    updateCheckOutMinimum();

    bookingForm.addEventListener('submit', (event) => {
        event.preventDefault();

        const formData = new FormData(bookingForm);
        const guests = formData.get('guests');
        const checkoutUrl = bookingForm.dataset.checkoutUrl;

        if (statusMessage instanceof HTMLElement) {
            statusMessage.textContent = 'Opening secure checkout…';
        }

        if (checkoutUrl) {
            const query = new URLSearchParams({
                check_in: checkInInput.value,
                check_out: checkOutInput.value,
                guests: String(guests),
            });

            window.location.href = `${checkoutUrl}?${query.toString()}`;
        }
    });
});
