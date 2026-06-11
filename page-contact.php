<?php
/*
Template Name: Contact Us
*/

$admin_email           = stavros_contact_recipient_email();
$display_contact_email = stavros_contact_display_email();
$contact_link          = 'mailto:' . antispambot( $display_contact_email );
$form_values = [
    'name'    => '',
    'email'   => '',
    'subject' => '',
    'message' => '',
];
$form_errors = [];
$form_status = isset( $_GET['contact_status'] ) ? sanitize_key( wp_unslash( $_GET['contact_status'] ) ) : '';

if ( 'error' === $form_status ) {
    $form_errors[] = isset( $_GET['contact_error'] ) && '' !== trim( (string) wp_unslash( $_GET['contact_error'] ) )
        ? sanitize_text_field( wp_unslash( $_GET['contact_error'] ) )
        : 'Message could not be sent right now. Please try again shortly.';
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
      <?php if ( 'sent' === $form_status ) : ?>
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

      <form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" class="contact-page-form">
        <input type="hidden" name="action" value="stavros_contact_form">
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
