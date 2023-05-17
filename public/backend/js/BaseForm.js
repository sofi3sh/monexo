// BaseForm select list
(function(){
    "use strict";

    // Form
    let form = $(".gr-mw-form");
	
	if (typeof(form) != 'undefined' && form != null) {

        // Main select wrapper
        let stwr        = form.find(".select-website");
		// Current site
		let currentSite = stwr.find(".current-site");
		// Current text
		let text        = currentSite.find("p");
		// Link button
        let linkBtn     = stwr.find(".open-website");
        // Input's
        let allReqInput = form.find(".gr-mwc-data--input.req");
        // Form send button
		let sendBtn     = form.find(".gr-mwc-submit-btn");
		
		// Form all inputs for check validation
		// First
		let firstIn     = form.find("#UserFio");
		// Second
		let secondIn    = form.find("#UserMessagner");
		// Third
		let thirdIn     = form.find("#UserPhone");

        sendBtn.on("click", () => {
            allReqInput.each(function() {
                // All item
				let thisElem = $(this);
				
                if (thisElem.val() == "" || thisElem.val() == null) {
                    thisElem.addClass("error");
                }
                else {
                    thisElem.removeClass("error");
				}
				
			});
			
			if ((firstIn.val() != "") && (secondIn.val() != "") && (thirdIn.val() != "")) {
				form.submit();
			}
        });

        allReqInput.each(function() {
            // All item
            let ths = $(this);

            ths.on("click", () => {
                if (ths.hasClass("error")) {
                    ths.removeClass("error");
                }
            });

            ths.focusout(() =>  {
                if (ths.val() == "" || ths.val() == null) {
                    ths.addClass("error");
                }
            });
        });
		
		if (typeof(currentSite) != 'undefined' && currentSite != null) {

			// Website's list
			let list    = stwr.find(".site-list");
			// Website
			let www     = list.find("p.item");

			// Open modal window
			currentSite.on("click", () => {
				if (stwr.hasClass("open")) {
					// Remove 'open' class on select website wrapper
					stwr.removeClass("open");
				}
				else {
					// Add 'open' class on select website wrapper
					stwr.addClass("open");
				}
			});

			www.each(function() {
				// This item
				let thisElem = $(this);
				// Get data - website link
				let link     = thisElem.data("sitelink");
				// Get text - website link
				let linkText = thisElem.text();

				thisElem.on("click", () => {
					if (linkBtn.hasClass("blocked")) {
						linkBtn.removeClass("blocked");

                        stwr.removeClass("open");

						text.text(linkText);
						linkBtn.attr("href", String(link));
					}
					else {
                        stwr.removeClass("open");

						text.text(linkText);
						linkBtn.attr("href", String(link));
					}
				});
			});
		}
	}

}());