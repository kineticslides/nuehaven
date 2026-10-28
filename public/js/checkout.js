document.addEventListener('DOMContentLoaded', () => {
    const calendars = document.querySelector('[data-calendars]');

    if (!(calendars instanceof HTMLElement)) {
        return;
    }

    const params = new URLSearchParams(window.location.search);
    const today = startOfDay(new Date());
    const requestedCheckIn = parseDate(params.get('check_in'));
    const requestedCheckOut = parseDate(params.get('check_out'));
    let checkIn = requestedCheckIn && requestedCheckIn >= today ? requestedCheckIn : addDays(today, 7);
    let checkOut = requestedCheckOut && requestedCheckOut >= addDays(checkIn, 2) ? requestedCheckOut : addDays(checkIn, 2);
    let visibleMonth = new Date(checkIn.getFullYear(), checkIn.getMonth(), 1);

    const guestSelect = document.querySelector('[data-guests]');
    const guestValue = params.get('guests');

    if (guestSelect instanceof HTMLSelectElement && guestValue) {
        guestSelect.value = guestValue;
    }

    document.querySelector('[data-calendar-previous]')?.addEventListener('click', () => {
        const previous = new Date(visibleMonth.getFullYear(), visibleMonth.getMonth() - 1, 1);

        if (previous >= new Date(today.getFullYear(), today.getMonth(), 1)) {
            visibleMonth = previous;
            renderCalendars();
        }
    });

    document.querySelector('[data-calendar-next]')?.addEventListener('click', () => {
        visibleMonth = new Date(visibleMonth.getFullYear(), visibleMonth.getMonth() + 1, 1);
        renderCalendars();
    });

    document.querySelectorAll('[data-addon], [data-payment]').forEach((input) => {
        input.addEventListener('change', updateSummary);
    });

    document.querySelector('[data-proceed]')?.addEventListener('click', () => {
        const proceedButton = document.querySelector('[data-proceed]');
        const status = document.querySelector('[data-checkout-status]');

        if (status instanceof HTMLElement) {
            status.textContent = 'Saving your selection…';
        }

        if (proceedButton instanceof HTMLElement && checkOut) {
            const query = new URLSearchParams({
                check_in: toDateInput(checkIn),
                check_out: toDateInput(checkOut),
                guests: guestSelect instanceof HTMLSelectElement ? guestSelect.value : '2 adults',
                parking: document.querySelector('[data-addon="parking"]')?.checked ? '1' : '0',
                welcome_set: document.querySelector('[data-addon="romance"]')?.checked ? '1' : '0',
                payment: document.querySelector('[data-payment="full"]')?.checked ? 'full' : 'deposit',
            });

            window.location.href = `${proceedButton.dataset.detailsUrl}?${query.toString()}`;
        }
    });

    function renderCalendars() {
        calendars.replaceChildren(createMonth(visibleMonth), createMonth(new Date(visibleMonth.getFullYear(), visibleMonth.getMonth() + 1, 1)));

        const rangeLabel = document.querySelector('[data-calendar-range]');
        if (rangeLabel instanceof HTMLElement) {
            const secondMonth = new Date(visibleMonth.getFullYear(), visibleMonth.getMonth() + 1, 1);
            rangeLabel.textContent = `${formatMonth(visibleMonth)} – ${formatMonth(secondMonth)}`;
        }

        updateSummary();
    }

    function createMonth(month) {
        const section = document.createElement('section');
        const title = document.createElement('h3');
        title.className = 'calendar-month-title';
        title.textContent = month.toLocaleDateString('en-US', { month: 'long', year: 'numeric' });
        section.append(title);

        const grid = document.createElement('div');
        grid.className = 'calendar-grid';
        ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'].forEach((weekday) => {
            const label = document.createElement('span');
            label.className = 'calendar-weekday';
            label.textContent = weekday;
            grid.append(label);
        });

        const firstDay = new Date(month.getFullYear(), month.getMonth(), 1);
        const lastDay = new Date(month.getFullYear(), month.getMonth() + 1, 0);

        for (let index = 0; index < firstDay.getDay(); index += 1) {
            const filler = document.createElement('span');
            filler.className = 'calendar-day is-muted';
            grid.append(filler);
        }

        for (let day = 1; day <= lastDay.getDate(); day += 1) {
            const date = new Date(month.getFullYear(), month.getMonth(), day);
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'calendar-day';
            button.textContent = String(day);
            button.disabled = date < today;
            button.setAttribute('aria-label', date.toLocaleDateString('en-US', { dateStyle: 'long' }));

            if (sameDay(date, checkIn)) button.classList.add('is-selected', 'is-start');
            if (sameDay(date, checkOut)) button.classList.add('is-selected', 'is-end');
            if (date > checkIn && date < checkOut) button.classList.add('is-range');

            button.addEventListener('click', () => selectDate(date));
            grid.append(button);
        }

        section.append(grid);
        return section;
    }

    function selectDate(date) {
        const error = document.querySelector('[data-booking-error]');
        if (error instanceof HTMLElement) error.classList.add('hidden');

        if (checkIn && checkOut) {
            checkIn = date;
            checkOut = null;
        } else if (!checkOut) {
            if (date <= checkIn) {
                checkIn = date;
            } else if (differenceInDays(checkIn, date) < 2) {
                if (error instanceof HTMLElement) {
                    error.textContent = 'Please select a stay of at least 2 nights.';
                    error.classList.remove('hidden');
                }
                return;
            } else {
                checkOut = date;
            }
        }

        renderCalendars();
    }

    function updateSummary() {
        if (!checkOut) return;

        const nights = differenceInDays(checkIn, checkOut);
        const base = nights * 2000;
        const parking = document.querySelector('[data-addon="parking"]')?.checked ? nights * 350 : 0;
        const romance = document.querySelector('[data-addon="romance"]')?.checked ? 1200 : 0;
        const total = base + 400 + parking + romance;
        const deposit = Math.round(total * 0.3);
        const paymentFull = document.querySelector('[data-payment="full"]')?.checked;

        setText('[data-night-count]', `${nights} nights selected`);
        setText('[data-selected-range]', `${formatDate(checkIn)} – ${formatDate(checkOut)}`);
        setText('[data-base-label]', `Base Stay (₱2,000 × ${nights} nights)`);
        setText('[data-base-price]', formatMoney(base));
        setText('[data-parking-price]', `+${formatMoney(nights * 350)}`);
        setText('[data-parking-summary]', formatMoney(parking));
        setText('[data-deposit-option]', formatMoney(deposit));
        setText('[data-full-option]', formatMoney(total));
        setText('[data-total]', formatMoney(paymentFull ? total : deposit));
        setText('[data-total-title]', paymentFull ? 'Due Today (Pay in Full)' : 'Due Today (30% Deposit)');
        setText('[data-balance]', paymentFull ? 'Reservation paid in full' : `Remaining ${formatMoney(total - deposit)} due at check-in · Total: ${formatMoney(total)}`);

        document.querySelector('[data-parking-row]')?.classList.toggle('hidden', parking === 0);
        document.querySelector('[data-romance-row]')?.classList.toggle('hidden', romance === 0);
        document.querySelector('[data-romance-row]')?.classList.toggle('flex', romance > 0);
    }

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

    function startOfDay(date) { return new Date(date.getFullYear(), date.getMonth(), date.getDate()); }
    function addDays(date, days) { const copy = new Date(date); copy.setDate(copy.getDate() + days); return copy; }
    function differenceInDays(start, end) { return Math.round((end - start) / 86400000); }
    function sameDay(first, second) { return second && first.toDateString() === second.toDateString(); }
    function formatMonth(date) { return date.toLocaleDateString('en-US', { month: 'short', year: 'numeric' }); }
    function formatDate(date) { return date.toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric', year: 'numeric' }); }
    function formatMoney(value) { return `₱${value.toLocaleString('en-US')}`; }
    function toDateInput(date) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    }

    renderCalendars();
});
