document.addEventListener('DOMContentLoaded', function() {
    // Prepare the scroll for the navigation bar. Call the navBarSticky function when scrolling
    window.onscroll = function () {
        navBarSticky();
    }

    // Find our nav and pull the first one in the list using [0]. You know...even though there's one. =/
    var nav = document.getElementsByClassName("nav")[0];
    var body = document.getElementsByTagName("body")[0];
    var sticky = nav.offsetTop;

    // Once we scroll far enough, make the navbar sticky-wicky.
    function navBarSticky() {
        if (window.pageYOffset >= sticky) {
            nav.classList.add("sticky")
            body.classList.add("nav-is-sticky")
        } else {
            nav.classList.remove("sticky")
            body.classList.remove("nav-is-sticky");
        }
    }
	
	// Grrrrrr we're probably just gonna have to do an AJAX request for this. Guess I'm learning how that works. Basically I want to be able to load the categories and alphabetical indexes by clicking the appropriate button in the index navigations. Turns out I can't just load the php page because we have certain functions that need to be ran through wp-load. To make this how I want, just gonna have to go through Admin AJAX.
	
	$("#alph-cat").click(function() {
		$("#the-index-content").load("/wp-content/themes/kraken-trellis-child/template-parts/index-parts/kraken-index-alph.php");
	});
	$("#cat-cat").click(function() {
		$("#the-index-content").load("/wp-content/themes/kraken-trellis-child/template-parts/index-parts/kraken-index-cat.php");
	});
    
} //func
						 
) // addEventListener for DOMContentLoaded