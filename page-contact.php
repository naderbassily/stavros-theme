<?php
/*
Template Name: Contact Us
*/

$admin_email           = 'me@naderamsis.com';
$display_contact_email = 'contact@stavrosbasta.com';
$contact_link          = 'mailto:' . antispambot( $admin_email );
$form_values   = [
    'name'    => '',
    'email'   => '',
    'subject' => '',
    'message' => '',
];
$form_errors   = [];
$form_status   = '';

if ( 'POST' === $_SERVER['REQUEST_METHOD'] && isset( $_POST['stavros_contact_submit'] ) ) {
    $form_values['name']    = isset( $_POST['contact_name'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_name'] ) ) : '';
    $form_values['email']   = isset( $_POST['contact_email'] ) ? sanitize_email( wp_unslash( $_POST['contact_email'] ) ) : '';
    $form_values['subject'] = isset( $_POST['contact_subject'] ) ? sanitize_text_field( wp_unslash( $_POST['contact_subject'] ) ) : '';
    $form_values['message'] = isset( $_POST['contact_message'] ) ? sanitize_textarea_field( wp_unslash( $_POST['contact_message'] ) ) : '';

    if ( ! isset( $_POST['stavros_contact_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['stavros_contact_nonce'] ) ), 'stavros_contact_form' ) ) {
        $form_errors[] = 'Security check failed. Please try again.';
    }

    if ( '' === $form_values['name'] ) {
        $form_errors[] = 'Please enter your name.';
    }

    if ( '' === $form_values['email'] || ! is_email( $form_values['email'] ) ) {
        $form_errors[] = 'Please enter a valid email address.';
    }

    if ( '' === $form_values['subject'] ) {
        $form_errors[] = 'Please add a subject.';
    }

    if ( '' === $form_values['message'] ) {
        $form_errors[] = 'Please enter your message.';
    }

    if ( empty( $form_errors ) && $admin_email ) {
        $email_subject = sprintf( 'Contact Form: %s', $form_values['subject'] );
        $email_body    = implode(
            "\n\n",
            [
                'Name: ' . $form_values['name'],
                'Email: ' . $form_values['email'],
                'Subject: ' . $form_values['subject'],
                "Message:\n" . $form_values['message'],
            ]
        );
        $headers       = [
            'Reply-To: ' . $form_values['name'] . ' <' . $form_values['email'] . '>',
        ];

        if ( wp_mail( $admin_email, $email_subject, $email_body, $headers ) ) {
            $form_status = 'success';
            $form_values = [
                'name'    => '',
                'email'   => '',
                'subject' => '',
                'message' => '',
            ];
        } else {
            $form_errors[] = 'Message could not be sent right now. Please try again shortly.';
        }
    } elseif ( empty( $form_errors ) ) {
        $form_errors[] = 'The site email address is not configured yet.';
    }
}

get_header();
?>

<main class="contact-page">
  <section class="contact-page-hero">
    <div class="contact-page-shell">
      <p class="contact-page-eyebrow">// Contact</p>
      <h1 class="contact-page-title">Let’s talk.</h1>
      <div class="contact-page-divider"></div>
      <p class="contact-page-intro">
        Reach out for speaking, consulting, advisory work, research collaboration, or media inquiries. Use the form below and include a little context so the request can be reviewed quickly.
      </p>
    </div>
  </section>

  <section class="contact-page-form-section">
    <div class="contact-page-form-copy">
      <div class="sec-header">
        <span class="sec-label sec-label-light">// Get In Touch</span>
      </div>
      <h2 class="sec-title-light">Simple outreach.<br/><em>Direct response.</em></h2>
      <p class="contact-page-copy">
        Include who you are, what you need, and any relevant dates or scope. That is enough to start the conversation.
      </p>
      <a href="<?php echo esc_url( $contact_link ); ?>" class="contact-page-direct-link"><?php echo esc_html( antispambot( $display_contact_email ) ); ?></a>
    </div>

    <div class="contact-page-form-card">
      <?php if ( 'success' === $form_status ) : ?>
      <div class="contact-page-alert contact-page-alert-success">
        Your message was sent successfully.
      </div>
      <?php endif; ?>

      <?php if ( ! empty( $form_errors ) ) : ?>
      <div class="contact-page-alert contact-page-alert-error">
        <?php foreach ( $form_errors as $form_error ) : ?>
        <p><?php echo esc_html( $form_error ); ?></p>
        <?php endforeach; ?>
      </div>
      <?php endif; ?>

      <form method="post" class="contact-page-form">
        <?php wp_nonce_field( 'stavros_contact_form', 'stavros_contact_nonce' ); ?>

        <div class="contact-page-field">
          <label for="contact_name">Name</label>
          <input id="contact_name" name="contact_name" type="text" value="<?php echo esc_attr( $form_values['name'] ); ?>" required>
        </div>

        <div class="contact-page-field">
          <label for="contact_email">Email</label>
          <input id="contact_email" name="contact_email" type="email" value="<?php echo esc_attr( $form_values['email'] ); ?>" required>
        </div>

        <div class="contact-page-field">
          <label for="contact_subject">Subject</label>
          <input id="contact_subject" name="contact_subject" type="text" value="<?php echo esc_attr( $form_values['subject'] ); ?>" required>
        </div>

        <div class="contact-page-field">
          <label for="contact_message">Message</label>
          <textarea id="contact_message" name="contact_message" rows="7" required><?php echo esc_textarea( $form_values['message'] ); ?></textarea>
        </div>

        <button type="submit" name="stavros_contact_submit" class="btn-primary-dark">Send Message</button>
      </form>
    </div>
  </section>
</main>

<?php get_footer(); ?>
