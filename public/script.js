$(document).ready(function() {
    // Smooth scrolling for navigation links
    $('nav a').on('click', function(event) {
        if (this.hash !== "") {
            event.preventDefault();
            var hash = this.hash;
            $('html, body').animate({
                scrollTop: $(hash).offset().top - 80
            }, 800);
        }
    });

    // Fade in sections on scroll
    $(window).scroll(function() {
        $('section').each(function() {
            var top_of_element = $(this).offset().top;
            var bottom_of_screen = $(window).scrollTop() + $(window).innerHeight();

            if (bottom_of_screen > top_of_element) {
                $(this).animate({'opacity':'1'}, 1000);
            }
        });
    });

    // Form submission (you would typically handle this with AJAX)
    $('#contact-form').submit(function(event) {
        event.preventDefault();
        alert('Thank you for your message. We will get back to you soon!');
        this.reset();
    });

    // Download button click event
    $('.download-btn').click(function() {
        alert('Thank you for your interest! The app download will start shortly.');
    });
});
