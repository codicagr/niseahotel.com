export default function bookingWidget(options) {
    return {
        isPopupOpen: false,
        fpInstance: null,

        options: options,

        form: {
            arrival: '',
            nights: options.nights,
            adults: options.adults,
            children: options.children,
            infants: options.infants
        },

        initCalendar(el) {
            if (!window.flatpickr) {
                console.error('flatpickr is not loaded');
                return;
            }

            this.fpInstance = window.flatpickr(el, {
                minDate: "today",
                dateFormat: "d/m/Y",
                disableMobile: false,
                onChange: (selectedDates, dateStr) => {
                    this.form.arrival = dateStr;
                },
                onReady: (selectedDates, dateStr, instance) => {
                    if (instance.isMobile && instance.mobileInput) {
                        const label = document.querySelector(`label[for="${el.id}"]`);
                        if (label) {
                            instance.mobileInput.setAttribute('aria-label', label.innerText.trim());
                        }
                    }
                }
            });
        },

        openPopup() {
            this.isPopupOpen = true;
            window.lenis?.stop();
        },

        closePopup() {
            this.isPopupOpen = false;
            window.lenis?.start();
        },

        submitBooking(baseUrl, target) {
            if(!this.form.arrival) {
                alert(this.options.arrivalError);
                if (this.fpInstance) this.fpInstance.open();
                return;
            }

            const params = {
                checkin: this.form.arrival,
                nights: this.form.nights,
                adults: this.form.adults,
            };

            if (this.form.children > 0) params.children = this.form.children;
            if (this.form.infants > 0) params.infants = this.form.infants;

            const queryParams = new URLSearchParams(params).toString();
            let cleanBaseUrl = baseUrl.replace(/\/$/, "");
            const separator = cleanBaseUrl.includes('?') ? '&' : '?';
            const finalUrl = cleanBaseUrl + separator + queryParams;

            if (target === '_blank') {
                window.open(finalUrl, '_blank');
            } else {
                window.location.href = finalUrl;
            }
        }
    };
}

function registerBookingWidget() {
    window.Alpine.data('bookingWidget', bookingWidget);
}

if (window.Alpine) {
    registerBookingWidget();
} else {
    document.addEventListener('alpine:init', registerBookingWidget);
}
