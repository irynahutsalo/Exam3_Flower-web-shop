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
<main class="contact-page">

    <!-- Contact Hero -->

    <!-- If a hero image exists then it uses it as the background image -->
    <section class="contact-hero"
        <?php if ($contact_hero_image) : ?>
             style="background-image: url('<?php echo esc_url($contact_hero_image); ?>');"
        <?php endif; ?>>

        <!-- Dark Overlay -->
        <div class="contact-hero-overlay"></div>

        <!-- Contact Hero Content -->
        <div class="contact-hero-content">

            <!-- Title -->
            <?php if ($contact_hero_title) : ?>
                <h1 class="contact-hero-title">
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
    <section class="contact-section">

        <!-- Contact Container -->
        <div class="contact-container">

            <!-- Contact Info Container-->
            <div class="contact-info">

                <!-- Contact Info Title -->
                <?php if ($contact_title) : ?>
                    <h2 class="contact-title">
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
                <div class="contact-details">

                    <!-- Email -->
                    <?php if ($contact_email) : ?>
                        <div class="contact-detail-item">

                            <!-- Icon -->
                            <div class="contact-detail-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32" aria-hidden="true">
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
                            <div class="contact-detail-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
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
                            <div class="contact-detail-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 32 32">
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
                        <div class="contact-detail-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 512 512">
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

                </div>

            </div>


            <!-- Right Side Container -->
            <div class="contact-form-wrapper">

                <!-- Success Rate -->
                <?php if (isset($_GET['sent']) && $_GET['sent'] === '1') : ?>

                    <!-- Success Container -->
                    <div class="contact-success">

                        <!-- Icon Container -->
                        <div class="contact-succes-icon-wrapper">
                            <!-- Icon -->
                            <div class="contact-success-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 56 56">
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
                    <form class="contact-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST" data-parsley-validate>

                        <!-- This tells WordPress which function should handle the form submission -->
                        <input type="hidden" name="action" value="submit_contact_form">

                        <!-- Add a WordPress nonce to protect the form submission (security) -->
                        <?php wp_nonce_field('contact_form_action','contact_form_nonce'); ?>

                        <!-- Progress Container -->
                        <div class="form-progress">

                            <!-- Shows the Steps -->
                            <span class="form-progress-text">Step <span id="currentStepNumber">1</span> of 4</span>

                            <!-- Progress Bar -->
                            <div class="form-progress-bar">
                                <div class="form-progress-fill" id="progressFill"></div>
                            </div>

                        </div>


                        <!-- Steps Container -->
                        <div class="form-steps-wrapper">
                            <!-- Steps Content Container -->
                            <div class="form-steps" id="formSteps">

                                <!-- Step 1 -->
                                <div class="form-step">

                                    <h2>
                                        Hej! First — who's writing in?
                                    </h2>

                                    <p class="form-helper">
                                        This helps us route your message to the right person.
                                    </p>


                                    <div class="contact-choice-list">

                                        <!-- Option A -->
                                        <label class="contact-choice-card">
                                            <!-- Radio - Option A -->
                                            <input type="radio" name="customer_type" value="home_customer"required>
                                            <span class="contact-choice-letter"> A </span>

                                            <span class="contact-choice-text">
                                                <!-- Title -->
                                                <strong> A home customer</strong>
                                                <!-- Small Description -->
                                                <small> Flower Club subscriber, or thinking about it</small>
                                            </span>
                                        </label>

                                        <!-- Option B -->
                                        <label class="contact-choice-card">
                                            <!-- Radio - Option B -->
                                            <input type="radio" name="customer_type" value="business">
                                            <span class="contact-choice-letter"> B </span>

                                            <span class="contact-choice-text">
                                                <!-- Title -->
                                                <strong> A business</strong>
                                                <!-- Small Description -->
                                                <small> Office, hotel, salon or similar space</small>
                                            </span>
                                        </label>


                                        <!-- Option C -->
                                        <label class="contact-choice-card">
                                            <!-- Radio - Option C -->
                                            <input type="radio" name="customer_type" value="something_else">
                                            <span class="contact-choice-letter"> C </span>

                                            <span class="contact-choice-text">
                                                <!-- Title -->
                                                <strong> Something else </strong>
                                                <!-- Small Description -->
                                                <small> Gift, press, partnership, or just a question</small>
                                            </span>
                                        </label>

                                    </div>

                                </div>


                              <!-- Step 2  -->
                                <div class="form-step">

                                    <h2>
                                        What's your name?
                                    </h2>

                                    <p class="form-helper">
                                        Tell us how we can reach you.
                                    </p>

                                    <!-- Personal Data -->
                                    <div class="contact-personal-fields">
                                        <!-- Name -->
                                        <input type="text" id="name" name="name" placeholder="Type your name..." required
                                            data-parsley-required-message="Please enter your name."
                                        >
                                        <!-- Email -->
                                        <input type="email" id="email" name="email" placeholder="you@email.com" required
                                            data-parsley-required-message="Please enter your email."
                                            data-parsley-type-message="Please enter a valid email address."
                                        >
                                        <!-- Phone  -->
                                        <span class="contact-input-label">
                                            Phone (optional — for delivery-day questions)
                                        </span>

                                        <input type="tel" id="phone" name="phone" placeholder="+45 ...">

                                    </div>

                                </div>

                                <!-- Step 3 -->
                                <div class="form-step">

                                    <h2>
                                        What's this about?
                                    </h2>

                                    <p class="form-helper">
                                        Pick the option that fits best.
                                    </p>

                                    <div class="contact-choice-list">
                                        <!-- Option A -->
                                        <label class="contact-choice-card">
                                            <!-- Radio - Option A -->
                                            <input type="radio" name="subject" value="Bloom for Business enquiry" required>
                                            <span class="contact-choice-letter"> A </span>

                                            <span class="contact-choice-text">
                                                <!-- Title -->
                                                <strong> Bloom for Business enquiry</strong>
                                                <!-- Small Description -->
                                                <small> Managed flowers for your workplace</small>
                                            </span>
                                        </label>

                                        <!-- Option B -->
                                        <label class="contact-choice-card">
                                            <!-- Radio - Option B -->
                                            <input type="radio" name="subject" value="Existing business account">
                                            <span class="contact-choice-letter"> B </span>

                                            <span class="contact-choice-text">
                                                <!-- Title -->
                                                <strong> An existing business account </strong>
                                                <!-- Small Description -->
                                                <small> Delivery schedule, sizing, or changes</small>
                                            </span>
                                        </label>

                                        <!-- Option C -->
                                        <label class="contact-choice-card">
                                            <!-- Radio - Option C -->
                                            <input type="radio" name="subject" value="Billing invoicing or EAN">
                                            <span class="contact-choice-letter"> C </span>
                                            <!-- Title -->
                                            <span class="contact-choice-text">
                                                <strong> Billing, invoicing or EAN</strong>
                                            </span>

                                        </label>

                                        <!-- Option D -->
                                        <label class="contact-choice-card">
                                            <!-- Radio - Option D -->
                                            <input type="radio" name="subject" value="Partnership">
                                            <span class="contact-choice-letter"> D </span>
                                            <!-- Title-->
                                            <span class="contact-choice-text">
                                                <strong> Partnership</strong>
                                            </span>
                                        </label>

                                        <!-- Option E -->
                                        <label class="contact-choice-card">
                                            <!-- Radio - Option E -->
                                            <input type="radio" name="subject" value="Something else">
                                            <span class="contact-choice-letter"> E </span>
                                            <!-- Title -->
                                            <span class="contact-choice-text">
                                                <strong> Something else </strong>
                                            </span>
                                        </label>

                                    </div>

                                </div>


                                <!-- Step 4 -->
                                <div class="form-step">
                                    <h2>
                                        Tell us more.
                                    </h2>

                                    <p class="form-helper">
                                        The more detail, the faster we can help.
                                    </p>

                                    <!-- Texarea -->
                                    <textarea id="message" name="message" rows="7" maxlength="500" placeholder="Type your message..." required
                                        data-parsley-required-message="Please write a message.">
                                    </textarea>

                                    <!-- Character Limit -->
                                    <div class="character-counter">
                                        <span id="characterCount">0</span>/500 characters
                                    </div>

                                </div>

                            </div>

                        </div>


                        <!-- Validation Warning -->
                        <div class="form-warning" id="formWarning" role="alert" aria-live="polite">
                            Please complete the required information before continuing.
                        </div>

                        <!-- Navigation -->
                        <div class="form-navigation">

                            <button type="button" class="form-back-button" id="backButton">
                                Back
                            </button>

                            <button type="button" class="form-next-button" id="nextButton">
                                Next
                            </button>

                            <button type="submit" class="contact-submit" id="submitButton">
                                Send message
                            </button>

                        </div>

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
    const formWarning = document.getElementById("formWarning");
    const messageField = document.getElementById("message");
    const characterCount = document.getElementById("characterCount");

    // Stop if the form is not shown
    if (!form || !formSteps || !nextButton || !backButton || !submitButton || !stepNumber || !progressFill) {
        return;
    }

    const totalSteps = 4;
    let currentStep = 0;

    // Update the visible step and progress bar
    function updateForm() {
        formSteps.style.transform = `translateX(-${currentStep * 25}%)`;

        stepNumber.textContent = currentStep + 1;

        progressFill.style.width =
            `${((currentStep + 1) / totalSteps) * 100}%`;

        backButton.style.visibility =
            currentStep === 0 ? "hidden" : "visible";

        nextButton.style.display =
            currentStep === totalSteps - 1 ? "none" : "inline-flex";

        submitButton.style.display =
            currentStep === totalSteps - 1 ? "inline-flex" : "none";

        hideWarning();
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
        const activeStep =
            document.querySelectorAll(".form-step")[currentStep];

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

                    return false;
                }
            }

            else if (!field.value.trim()) {
                showWarning(
                    "Please complete the required information before continuing."
                );

                field.focus();
                return false;
            }

            else if (
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
        }
    });

    // Go back one step
    backButton.addEventListener("click", () => {
        if (currentStep > 0) {
            currentStep--;
            updateForm();
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