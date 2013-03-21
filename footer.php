 	<?php  		 	
	 	wp_enqueue_scripts( "jquery" );
 	?> 	
 	<script type="text/javascript">
		/*
		* Placeholder plugin for jQuery
		* ---
		* Copyright 2010, Daniel Stocks (http://webcloud.se)
		* Released under the MIT, BSD, and GPL Licenses.
		*/
		(function(jQuery) {
		    function Placeholder(input) {
		        this.input = input;
		        if (input.attr('type') == 'password') {
		            this.handlePassword();
		        }
		        // Prevent placeholder values from submitting
		        jQuery(input[0].form).submit(function() {
		            if (input.hasClass('placeholder') && input[0].value == input.attr('placeholder')) {
		                input[0].value = '';
		            }
		        });
		    }
		    Placeholder.prototype = {
		        show : function(loading) {
		            // FF and IE saves values when you refresh the page. If the user refreshes the page with
		            // the placeholders showing they will be the default values and the input fields won't be empty.
		            if (this.input[0].value === '' || (loading && this.valueIsPlaceholder())) {
		                if (this.isPassword) {
		                    try {
		                        this.input[0].setAttribute('type', 'text');
		                    } catch (e) {
		                        this.input.before(this.fakePassword.show()).hide();
		                    }
		                }
		                this.input.addClass('placeholder');
		                this.input[0].value = this.input.attr('placeholder');
		            }
		        },
		        hide : function() {
		            if (this.valueIsPlaceholder() && this.input.hasClass('placeholder')) {
		                this.input.removeClass('placeholder');
		                this.input[0].value = '';
		                if (this.isPassword) {
		                    try {
		                        this.input[0].setAttribute('type', 'password');
		                    } catch (e) { }
		                    // Restore focus for Opera and IE
		                    this.input.show();
		                    this.input[0].focus();
		                }
		            }
		        },
		        valueIsPlaceholder : function() {
		            return this.input[0].value == this.input.attr('placeholder');
		        },
		        handlePassword: function() {
		            var input = this.input;
		            input.attr('realType', 'password');
		            this.isPassword = true;
		            // IE < 9 doesn't allow changing the type of password inputs
		            if (jQuery.browser.msie && input[0].outerHTML) {
		                var fakeHTML = jQuery(input[0].outerHTML.replace(/type=(['"])?password\1/gi, 'type=$1text$1'));
		                this.fakePassword = fakeHTML.val(input.attr('placeholder')).addClass('placeholder').focus(function() {
		                    input.trigger('focus');
		                    jQuery(this).hide();
		                });
		                jQuery(input[0].form).submit(function() {
		                    fakeHTML.remove();
		                    input.show();
		                });
		            }
		        }
		    };
		    var NATIVE_SUPPORT = !!("placeholder" in document.createElement( "input" ));
		    jQuery.fn.placeholder = function() {
		        return NATIVE_SUPPORT ? this : this.each(function() {
		            var input = jQuery(this);
		            var placeholder = new Placeholder(input);
		            placeholder.show(true);
		            input.focus(function() {
		                placeholder.hide();
		            });
		            input.blur(function() {
		                placeholder.show(false);
		            });

		            // On page refresh, IE doesn't re-populate user input
		            // until the window.onload event is fired.
		            if (jQuery.browser.msie) {
		                jQuery(window).load(function() {
		                    if(input.val()) {
		                        input.removeClass("placeholder");
		                    }
		                    placeholder.show(true);
		                });
		                // What's even worse, the text cursor disappears
		                // when tabbing between text inputs, here's a fix
		                input.focus(function() {
		                    if(this.value == "") {
		                        var range = this.createTextRange();
		                        range.collapse(true);
		                        range.moveStart('character', 0);
		                        range.select();
		                    }
		                });
		            }
		        });
		    };
		})(jQuery);

		jQuery('input[placeholder], textarea[placeholder]').placeholder();

		jQuery("#site-nav a").click( function () { jQuery(this).toggleClass("selected"); } );

		var timer;

		jQuery("#main-menu > ul > li").mouseenter(
	    	function() {
				var element = jQuery(this).children(".hintbox");
		        timer = setTimeout (
		        	function() {
			        	element.addClass("hintbox-visible");		
		        	}, 
	        	1000);
			}
        );

		jQuery("#main-menu > ul > li").mouseleave(
	    	function() {
	    		clearTimeout(timer);
		        var element = jQuery(this).children(".hintbox");
		        element.removeClass("hintbox-visible");	
			}
        );
		
	 </script>
	 <?php wp_footer() ?>
</body>
</html>