document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('[data-booking-details-form]');

    if (!(form instanceof HTMLFormElement)) {
        return;
    }

    const params = new URLSearchParams(window.location.search);
    const checkIn = parseDate(params.get('check_in')) || addDays(new Date(), 7);
    const checkOut = parseDate(params.get('check_out')) || addDays(checkIn, 2);
    const nights = Math.max(2, differenceInDays(checkIn, checkOut));
    const guests = params.get('guests') === '1 adult' ? '1 adult (Solo Traveller)' : '2 adults (Max Capacity)';
    const parking = params.get('parking') === '1' ? nights * 350 : 0;
    const welcomeSet = params.get('welcome_set') === '1' ? 1200 : 0;
    const total = (nights * 2000) + 400 + parking + welcomeSet;
    const payInFull = params.get('payment') === 'full';
    const dueNow = payInFull ? total : Math.round(total * 0.3);
    const balance = total - dueNow;

    setText('[data-stay-dates]', `${formatDate(checkIn)} – ${formatDate(checkOut)} (${nights} nights)`);
    setText('[data-guest-summary]', guests);
    setText('[data-reservation-total]', formatMoney(total));
    setText('[data-reservation-deposit]', formatMoney(dueNow));
    setText('[data-reservation-balance]', formatMoney(balance));
    setText('[data-deposit-inline]', formatMoney(dueNow));
    setText('[data-payment-plan-label]', payInFull ? 'Pay in full' : '30% deposit');
    setText('[data-due-label]', payInFull ? 'Due now (full payment)' : 'Due now (30% deposit)');

    const proofInput = document.querySelector('[data-proof-input]');
    const reserveButton = document.querySelector('[data-reserve-button]');
    const proofName = document.querySelector('[data-proof-name]');

    proofInput?.addEventListener('change', () => {
        if (!(proofInput instanceof HTMLInputElement)) return;

        const file = proofInput.files?.[0];
        const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
        const valid = Boolean(file && allowedTypes.includes(file.type) && file.size <= 5 * 1024 * 1024);

        proofInput.setCustomValidity(valid ? '' : 'Please select a JPG, PNG, or WebP image up to 5 MB.');

        if (proofName instanceof HTMLElement) {
            proofName.textContent = valid && file ? file.name : 'Please select a valid payment screenshot.';
        }

        if (reserveButton instanceof HTMLButtonElement) {
            reserveButton.disabled = !valid;
        }

        setText('[data-submit-label]', valid ? 'Reserve' : 'Upload Proof to Reserve');
    });

    form.addEventListener('submit', (event) => {
        const status = document.querySelector('[data-form-status]');
        if (!(status instanceof HTMLElement)) return;

        if (!form.checkValidity()) {
            event.preventDefault();
            form.reportValidity();
            status.textContent = 'Please complete the required details, upload your GCash receipt, and accept the house rules.';
            status.className = 'mt-3 min-h-5 text-center text-xs text-red-700';
            return;
        }

        status.textContent = 'Submitting your reservation for payment verification…';
        status.className = 'mt-3 min-h-5 text-center text-xs font-semibold text-brand';

        if (reserveButton instanceof HTMLButtonElement) reserveButton.disabled = true;
    });

    function setText(selector, value) {
        const element = document.querySelector(selector);
        if (element instanceof HTMLElement) element.textContent = value;
    }

    function parseDate(value) {
        if (!value || !/^\d{4}-\d{2}-\d{2}$/.test(value)) return null;
        const [year, month, day] = value.split('-').map(Number);
        const date = new Date(year, month - 1, day);
        return Number.isNaN(date.getTime()) ? null : date;
    }

    function addDays(date, days) { const copy = new Date(date); copy.setDate(copy.getDate() + days); return copy; }
    function differenceInDays(start, end) { return Math.round((end - start) / 86400000); }
    function formatDate(date) { return date.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }); }
    function formatMoney(value) { return `₱${value.toLocaleString('en-US')}`; }
});
