<?php
/*
Template Name: Contact Page
*/

get_header();


// ACF
$contact_hero_title       = get_field('contact_hero_title');
$contact_hero_description = get_field('contact_hero_description');
$contact_hero_image       = get_field('contact_hero_image');

$contact_title       = get_field('contact_title');
$contact_description = get_field('contact_description');

$contact_location    = get_field('contact_location');
$contact_email       = get_field('contact_email');
$contact_phone       = get_field('contact_phone');
$working_hours       = get_field('working_hours');


// Get the first row from the Working Hours repeater
$working_hours = $working_hours[0] ?? [];


// If a field is empty or does not exist it use an empty string instead
$weekday_opening   = $working_hours['weekday_opening'] ?? '';
$weekday_closing   = $working_hours['weekday_closing'] ?? '';
$saturday_opening  = $working_hours['saturday_opening'] ?? '';
$saturday_closing  = $working_hours['saturday_closing'] ?? '';
$sunday_opening    = $working_hours['sunday_opening'] ?? '';
$sunday_closing    = $working_hours['sunday_closing'] ?? '';


// If both an opening and closing time exist, display them together (string interpolation)
// Otherwise displays "Closed"
$weekday_hours = ($weekday_opening && $weekday_closing) ? "$weekday_opening - $weekday_closing" : 'Closed';
$saturday_hours = ($saturday_opening && $saturday_closing) ? "$saturday_opening - $saturday_closing" : 'Closed';
$sunday_hours = ($sunday_opening && $sunday_closing) ? "$sunday_opening - $sunday_closing" : 'Closed';


// Gets the image URL from the ACF image array
if (is_array($contact_hero_image)) {
    $contact_hero_image = $contact_hero_image['url'] ?? '';
}


// Remove spaces and special characters with Regex so the phone number works correctly in the href="tel:" link
$contact_phone_link = $contact_phone
    ? preg_replace('/[^0-9+]/', '', $contact_phone)
    : '';
?>


<!-- Contact Page -->
<main id="primary" class="contact-page" tabindex="-1">

    <!-- Contact Hero -->

    <!-- If a hero image exists then it uses it as the background image -->
    <section class="contact-hero"
        <?php if ($contact_hero_title) : ?>
        aria-labelledby="contact-hero-title"
        <?php else : ?>
        aria-label="Contact"
        <?php endif; ?>
        <?php if ($contact_hero_image) : ?>
        style="background-image: url('<?php echo esc_url($contact_hero_image); ?>');"
        <?php endif; ?>>

        <!-- Dark Overlay -->
        <div class="contact-hero-overlay" aria-hidden="true"></div>

        <!-- Contact Hero Content -->
        <div class="contact-hero-content">

            <!-- Title -->
            <?php if ($contact_hero_title) : ?>
                <h1 id="contact-hero-title" class="contact-hero-title">
                    <?php echo esc_html($contact_hero_title); ?>
                </h1>
            <?php endif; ?>

            <!-- Description -->
            <?php if ($contact_hero_description) : ?>
                <p class="contact-hero-description">
                    <?php echo esc_html($contact_hero_description); ?>
                </p>
            <?php endif; ?>

        </div>

    </section>


    <!-- Contact Section -->
    <section class="contact-section"
        <?php if ($contact_title) : ?>
        aria-labelledby="contact-section-title"
        <?php else : ?>
        aria-label="Contact information and form"
        <?php endif; ?>>

        <!-- Contact Container -->
        <div class="contact-container">

            <!-- Contact Info Container-->
            <div class="contact-info">

                <!-- Contact Info Title -->
                <?php if ($contact_title) : ?>
                    <h2 id="contact-section-title" class="contact-title">
                        <?php echo esc_html($contact_title); ?>
                    </h2>
                <?php endif; ?>

                <!-- Contact Info Description -->
                <?php if ($contact_description) : ?>
                    <p class="contact-description">
                        <?php echo esc_html($contact_description); ?>
                    </p>
                <?php endif; ?>


                <!-- Contact Details -->
                <address class="contact-details" aria-label="Nordic Bloom contact details">

                    <!-- Email -->
                    <?php if ($contact_email) : ?>
                        <div class="contact-detail-item">

                            <!-- Icon -->
                            <div class="contact-detail-icon" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32" aria-hidden="true" focusable="false">
                                    <path d="M0 0h32v32H0z" fill="none" />
                                    <path fill="#fff" d="M28 6H4a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h24a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2m-2.2 2L16 14.78L6.2 8ZM4 24V8.91l11.43 7.91a1 1 0 0 0 1.14 0L28 8.91V24Z" />
                                </svg>
                            </div>

                            <!-- Email Container -->
                            <div class="contact-detail-content">

                                <span class="contact-detail-label">
                                    Email
                                </span>

                                <a href="mailto:<?php echo esc_attr($contact_email); ?>" class="contact-detail-value">
                                    <?php echo esc_html($contact_email); ?>
                                </a>

                            </div>

                        </div>
                    <?php endif; ?>


                    <!-- Phone -->
                    <?php if ($contact_phone) : ?>
                        <div class="contact-detail-item">

                            <!-- Icon -->
                            <div class="contact-detail-icon" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32" aria-hidden="true" focusable="false">
                                    <path d="M0 0h32v32H0z" fill="none" />
                                    <path fill="#fff" d="M26 29h-.17C6.18 27.87 3.39 11.29 3 6.23A3 3 0 0 1 5.76 3h5.51a2 2 0 0 1 1.86 1.26L14.65 8a2 2 0 0 1-.44 2.16l-2.13 2.15a9.37 9.37 0 0 0 7.58 7.6l2.17-2.15a2 2 0 0 1 2.17-.41l3.77 1.51A2 2 0 0 1 29 20.72V26a3 3 0 0 1-3 3M6 5a1 1 0 0 0-1 1v.08C5.46 12 8.41 26 25.94 27a1 1 0 0 0 1.06-.94v-5.34l-3.77-1.51l-2.87 2.85l-.48-.06c-8.7-1.09-9.88-9.79-9.88-9.88l-.06-.48l2.84-2.87L11.28 5Z" />
                                </svg>
                            </div>

                            <!-- Phone Container -->
                            <div class="contact-detail-content">

                                <span class="contact-detail-label">
                                    Phone
                                </span>

                                <a href="tel:<?php echo esc_attr($contact_phone_link); ?>" class="contact-detail-value">
                                    <?php echo esc_html($contact_phone); ?>
                                </a>

                            </div>

                        </div>
                    <?php endif; ?>


                    <!-- Location -->
                    <?php if ($contact_location) : ?>
                        <div class="contact-detail-item">

                            <!-- Icon -->
                            <div class="contact-detail-icon" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32" aria-hidden="true" focusable="false">
                                    <path d="M0 0h32v32H0z" fill="none" />
                                    <path fill="#fff" d="M16 18a5 5 0 1 1 5-5a5.006 5.006 0 0 1-5 5m0-8a3 3 0 1 0 3 3a3.003 3.003 0 0 0-3-3" />
                                    <path fill="#fff" d="m16 30l-8.436-9.949a35 35 0 0 1-.348-.451A10.9 10.9 0 0 1 5 13a11 11 0 0 1 22 0a10.9 10.9 0 0 1-2.215 6.597l-.001.003s-.3.394-.345.447ZM8.813 18.395s.233.308.286.374L16 26.908l6.91-8.15c.044-.055.278-.365.279-.366A8.9 8.9 0 0 0 25 13a9 9 0 1 0-18 0a8.9 8.9 0 0 0 1.813 5.395" />
                                </svg>
                            </div>

                            <!-- Location Container -->
                            <div class="contact-detail-content">

                                <span class="contact-detail-label">
                                    Location
                                </span>

                                <!-- Street Address + City + Country -->
                                <p class="contact-detail-value">
                                    <?php echo esc_html($contact_location); ?>
                                </p>

                            </div>

                        </div>

                    <?php endif; ?>


                    <!-- Working Hours -->
                    <div class="contact-hours-section">

                        <!-- Icon -->
                        <div class="contact-detail-icon" aria-hidden="true">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512" aria-hidden="true" focusable="false">
                                <path d="M0 0h512v512H0z" fill="none" />
                                <path fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="32" d="M256 64C150 64 64 150 64 256s86 192 192 192s192-86 192-192S362 64 256 64Z" />
                                <path fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="32" d="M256 128v144h96" />
                            </svg>
                        </div>


                        <!-- Working Hours Content -->
                        <div class="contact-hours-content">

                            <!-- Working Hours Label -->
                            <span class="contact-detail-label contact-hours-label">
                                Working Hours
                            </span>

                            <!-- Wokring Hours Container -->
                            <div class="contact-hours">

                                <!-- First Row Monday-Friday Container -->
                                <div class="contact-hours-row">

                                    <!-- Monday- Friday Label-->
                                    <span class="contact-hours-day">
                                        Monday - Friday
                                    </span>

                                    <!-- Monday- Friday Working Hours -->
                                    <span class="contact-hours-time">
                                        <?php echo esc_html($weekday_hours); ?>
                                    </span>

                                </div>

                                <!-- Second Row Saturday Container -->
                                <div class="contact-hours-row">

                                    <!-- Saturday Label -->
                                    <span class="contact-hours-day">
                                        Saturday
                                    </span>

                                    <!-- Saturday Working Hours -->
                                    <span class="contact-hours-time">
                                        <?php echo esc_html($saturday_hours); ?>
                                    </span>

                                </div>

                                <!-- Third Row Saturday Container -->
                                <div class="contact-hours-row">

                                    <!-- Sunday Label -->
                                    <span class="contact-hours-day">
                                        Sunday
                                    </span>

                                    <!-- Sunday Working Hours -->
                                    <span class="contact-hours-time">
                                        <?php echo esc_html($sunday_hours); ?>
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </address>

            </div>


            <!-- Right Side Container -->
            <div class="contact-form-wrapper">

                <!-- Success Rate -->
                <?php if (isset($_GET['sent']) && $_GET['sent'] === '1') : ?>

                    <!-- Success Container -->
                    <div class="contact-success" role="status" aria-live="polite">

                        <!-- Icon Container -->
                        <div class="contact-succes-icon-wrapper" aria-hidden="true">

                            <!-- Icon -->
                            <div class="contact-success-icon">

                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 56 56" aria-hidden="true" focusable="false">
                                    <path d="M0 0h56v56H0z" fill="none" />
                                    <path fill="#fff" d="M23.078 48.027c1.008 0 1.805-.445 2.367-1.312L47.594 11.84c.422-.68.61-1.195.61-1.735c0-1.289-.868-2.132-2.157-2.132c-.914 0-1.453.304-2.016 1.195L22.984 42.707L12.062 28.41c-.585-.82-1.148-1.148-2.015-1.148c-1.313 0-2.25.914-2.25 2.203c0 .539.234 1.148.68 1.71L20.64 46.669c.726.914 1.43 1.36 2.437 1.36" />
                                </svg>

                            </div>

                        </div>

                        <h2 class="contact-success-title">
                            Message sent — tak!
                        </h2>

                        <p class="contact-success-text">
                            We've received your note and will reply within one business day.
                            Keep an eye on your inbox.
                        </p>

                    </div>

                <?php else : ?>

                    <!-- Form -->
                    <!-- Sends the form data to WordPress for processing -->
                    <!-- Form -->
                    <!-- Sends the form data to WordPress for processing -->
                    <form
                        class="contact-form"
                        action="<?php echo esc_url(admin_url('admin-post.php')); ?>"
                        method="POST"
                        data-parsley-validate
                        aria-label="Request a quote form">

                        <!-- This tells WordPress which function should handle the form submission -->
                        <input type="hidden" name="action" value="submit_contact_form">


                        <!-- Add a WordPress nonce to protect the form submission (security) -->
                        <?php wp_nonce_field('contact_form_action', 'contact_form_nonce'); ?>


                        <!-- Name Fields -->
                        <div class="contact-form-grid">

                            <!-- Company Name -->
                            <div class="contact-form-field">

                                <label for="company_name">
                                    Company Name <span aria-hidden="true">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="company_name"
                                    name="company_name"
                                    placeholder="Nordic Bloom A/S"
                                    autocomplete="organization"
                                    required
                                    aria-required="true"
                                    data-parsley-required-message="Please enter your company name.">

                            </div>


                            <!-- Contact Person -->
                            <div class="contact-form-field">

                                <label for="contact_person">
                                    Contact Person <span aria-hidden="true">*</span>
                                </label>

                                <input
                                    type="text"
                                    id="contact_person"
                                    name="contact_person"
                                    placeholder="Anna Jensen"
                                    autocomplete="name"
                                    required
                                    aria-required="true"
                                    data-parsley-required-message="Please enter a contact person.">

                            </div>


                            <!-- Email -->
                            <div class="contact-form-field">

                                <label for="email">
                                    Email <span aria-hidden="true">*</span>
                                </label>

                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    placeholder="anna@company.dk"
                                    autocomplete="email"
                                    required
                                    aria-required="true"
                                    data-parsley-required-message="Please enter your email."
                                    data-parsley-type-message="Please enter a valid email address.">

                            </div>


                            <!-- Phone -->
                            <div class="contact-form-field">

                                <label for="phone">
                                    Phone <span class="optional">(Optional)</span>
                                </label>

                                <input
                                    type="tel"
                                    id="phone"
                                    name="phone"
                                    placeholder="+45 70 00 00 00"
                                    autocomplete="tel">

                            </div>

                        </div>


                        <!-- Type of Space -->
                        <div class="contact-form-field contact-form-full">

                            <label for="space_type">
                                Type of Space <span aria-hidden="true">*</span>
                            </label>

                            <select
                                id="space_type"
                                name="space_type"
                                required
                                aria-required="true"
                                data-parsley-required-message="Please select your type of space.">
                                <option value="" selected disabled>Select type of space</option>
                                <option value="office">Office</option>
                                <option value="hotel">Hotel</option>
                                <option value="restaurant">Restaurant</option>
                                <option value="salon">Salon</option>
                                <option value="retail">Retail</option>
                                <option value="other">Other</option>
                            </select>

                        </div>


                        <!-- Help Options -->
                        <fieldset class="contact-help-section">

                            <legend>
                                What do you need help with?
                            </legend>


                            <div class="contact-help-grid">

                                <!-- Regular Flower Delivery -->
                                <label class="contact-checkbox">

                                    <input
                                        type="checkbox"
                                        name="services[]"
                                        value="Regular flower delivery">

                                    <span class="contact-checkbox-box" aria-hidden="true"></span>

                                    <span>Regular flower delivery</span>

                                </label>


                                <!-- Vase Service -->
                                <label class="contact-checkbox">

                                    <input
                                        type="checkbox"
                                        name="services[]"
                                        value="Vase service">

                                    <span class="contact-checkbox-box" aria-hidden="true"></span>

                                    <span>Vase service</span>

                                </label>


                                <!-- Maintenance -->
                                <label class="contact-checkbox">

                                    <input
                                        type="checkbox"
                                        name="services[]"
                                        value="Maintenance">

                                    <span class="contact-checkbox-box" aria-hidden="true"></span>

                                    <span>Maintenance</span>

                                </label>


                                <!-- Not Sure Yet -->
                                <label class="contact-checkbox">

                                    <input
                                        type="checkbox"
                                        name="services[]"
                                        value="Not sure yet">

                                    <span class="contact-checkbox-box" aria-hidden="true"></span>

                                    <span>Not sure yet</span>

                                </label>

                            </div>

                        </fieldset>


                        <!-- Message -->
                        <div class="contact-form-field contact-form-full">

                            <label for="message">
                                Message <span class="optional">(Optional)</span>
                            </label>

                            <textarea
                                id="message"
                                name="message"
                                rows="5"
                                maxlength="1000"
                                placeholder="Tell us more about your space, the size of your arrangements or anything else that would be helpful."></textarea>

                        </div>


                        <!-- Submit Button -->
                        <button
                            type="submit"
                            class="contact-submit"
                            aria-label="Request a quote">
                            Request a Quote
                        </button>


                        <!-- Form Note -->
                        <p class="contact-form-note">
                            No commitment. We'll contact you to discuss your space and needs.
                        </p>

                    </form>


                <?php endif; ?>

            </div>

        </div>

    </section>

</main>

<?php get_footer(); ?>


<script>
    document.addEventListener("DOMContentLoaded", () => {

        const form = document.querySelector(".contact-form");
        const formSteps = document.getElementById("formSteps");
        const nextButton = document.getElementById("nextButton");
        const backButton = document.getElementById("backButton");
        const submitButton = document.getElementById("submitButton");
        const stepNumber = document.getElementById("currentStepNumber");
        const progressFill = document.getElementById("progressFill");
        const progressBar = document.getElementById("formProgressBar");
        const formWarning = document.getElementById("formWarning");
        const messageField = document.getElementById("message");
        const characterCount = document.getElementById("characterCount");
        const steps = document.querySelectorAll(".form-step");

        // Stop if the form is not shown
        if (!form || !formSteps || !nextButton || !backButton || !submitButton || !stepNumber || !progressFill || !progressBar || !steps.length) {
            return;
        }

        const totalSteps = steps.length;
        let currentStep = 0;

        // Update the visible step and progress bar
        function updateForm() {
            formSteps.style.transform = `translateX(-${currentStep * 25}%)`;

            stepNumber.textContent = currentStep + 1;

            progressFill.style.width =
                `${((currentStep + 1) / totalSteps) * 100}%`;

            // Updates the accessible progress value
            progressBar.setAttribute("aria-valuenow", currentStep + 1);
            progressBar.setAttribute("aria-valuetext", `Step ${currentStep + 1} of ${totalSteps}`);

            // Makes only the current step available to keyboard and screen reader users
            steps.forEach((step, index) => {
                const isActive = index === currentStep;

                step.setAttribute("aria-hidden", isActive ? "false" : "true");

                step.querySelectorAll("input, textarea, select, button, a").forEach(element => {
                    element.tabIndex = isActive ? 0 : -1;
                });
            });

            backButton.style.visibility =
                currentStep === 0 ? "hidden" : "visible";

            nextButton.style.display =
                currentStep === totalSteps - 1 ? "none" : "inline-flex";

            submitButton.style.display =
                currentStep === totalSteps - 1 ? "inline-flex" : "none";

            hideWarning();
        }

        // Moves keyboard focus to the heading of the current step
        function focusCurrentStep() {
            const activeStep = steps[currentStep];
            const heading = activeStep.querySelector("h2, legend");

            if (!heading) {
                return;
            }

            heading.setAttribute("tabindex", "-1");
            heading.focus();
        }

        // Show a form warning
        function showWarning(message) {
            if (!formWarning) return;

            formWarning.textContent = message;
            formWarning.classList.add("is-visible");
        }

        // Hide the form warning
        function hideWarning() {
            formWarning?.classList.remove("is-visible");
        }

        // Validate required fields in the current step
        function validateCurrentStep() {
            const activeStep = steps[currentStep];

            const requiredFields =
                activeStep.querySelectorAll("input[required], textarea[required]");

            for (const field of requiredFields) {

                if (field.type === "radio") {
                    const checkedRadio =
                        activeStep.querySelector(
                            `input[name="${field.name}"]:checked`
                        );

                    if (!checkedRadio) {
                        showWarning(
                            "Please choose one of the options before continuing."
                        );

                        field.focus();
                        return false;
                    }
                } else if (!field.value.trim()) {
                    showWarning(
                        "Please complete the required information before continuing."
                    );

                    field.focus();
                    return false;
                } else if (
                    field.type === "email" &&
                    !field.validity.valid
                ) {
                    showWarning(
                        "Please enter a valid email address before continuing."
                    );

                    field.focus();
                    return false;
                }
            }

            hideWarning();
            return true;
        }

        // Go to the next step
        nextButton.addEventListener("click", () => {
            if (validateCurrentStep() && currentStep < totalSteps - 1) {
                currentStep++;
                updateForm();
                focusCurrentStep();
            }
        });

        // Go back one step
        backButton.addEventListener("click", () => {
            if (currentStep > 0) {
                currentStep--;
                updateForm();
                focusCurrentStep();
            }
        });

        // Prevent submission if the last step is invalid
        form.addEventListener("submit", event => {
            if (!validateCurrentStep()) {
                event.preventDefault();
            }
        });

        // Count the message characters
        if (messageField && characterCount) {
            const updateCharacterCount = () => {
                characterCount.textContent = messageField.value.length;
            };

            updateCharacterCount();
            messageField.addEventListener("input", updateCharacterCount);
        }

        updateForm();
    });
</script>