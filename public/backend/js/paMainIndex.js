(function() {
    // Main menu nav
    let navMenu = $(".cabinet-menu");
    // Mobile menu control
    let monMenuBtn = $(".open-mobile-cbmenu");

    monMenuBtn.on("click", () => {
        if (navMenu.hasClass("active")) {
            navMenu.removeClass("active");
            monMenuBtn.removeClass("active");
        }
        else {
            navMenu.addClass("active");
            monMenuBtn.addClass("active");
        }
    });

    // Menu tabs & control button
    let menu = $(".nav-contents");
    let menuTags = $(".nav-tags");
    // Control button
    let mbtnInvestor = menuTags.find("#nt-investor");
    let mbtnPartner = menuTags.find("#nt-partner");
    // Tabs
    let mTabsInvestor = menu.find(".investor");
    let mTabsPartner = menu.find(".partner");

    // Event functions
    // Open investor tab
    mbtnInvestor.on("click", () => {
        menuTags.removeClass("active");
        
        mbtnPartner.removeClass("active");
        
        mTabsPartner.removeClass("active");
        mTabsInvestor.addClass("active");
    });
    // Open partner tab
    mbtnPartner.on("click", () => {
        menuTags.addClass("active");
        
        mbtnPartner.addClass("active");

        mTabsInvestor.removeClass("active");
        mTabsPartner.addClass("active");
    });

    // Hide & Unhide Report
    var reportContentWrapper = $('.monthly-reports-wrapper'),
        reportContentContent = $('.monthly-reports-content'),
        reportContentBlock = $('.mmr-block'),
        reportControl = $('.view-more-mmr-block');

    reportControl.click(function () {
        var rBHeight = reportContentBlock.outerHeight(true),
			rCWHeight = reportContentContent.outerHeight(true);

        if (reportControl.hasClass('active')) {
            if ($('html').outerWidth(true) > 1000) {
                reportContentWrapper.css('height', rBHeight);
            }
            else if ($('html').outerWidth(true) < 1000) {
                reportContentWrapper.css('height', (rBHeight * 3));
            }
            reportControl.removeClass('active');
            reportContentWrapper.removeClass('active');
        }
        else {
            reportContentWrapper.css('height', rCWHeight);
            reportControl.addClass('active');
            reportContentWrapper.addClass('active');
        }
	});
	
	// Hide Top report
	var rBHeight = reportContentBlock.outerHeight(true);

    if ($('html').outerWidth(true) > 1000) {
        reportContentWrapper.css('height', rBHeight);
    }
    else if ($('html').outerWidth(true) < 1000) {
        reportContentWrapper.css('height', (rBHeight * 3));
    }

    // News control
    let beNewsBlock = $(".mln-block");

    function beNewsLoadEdit() {
        beNewsBlock.each(function() {
            let thisBlock = $(this),
                text = thisBlock.find(".mln-text p").text(),
                result = thisBlock.find(".mln-text p");
            
            if (text.length > 100) {
                result.text(text.substring(0, 100) + '...');
            }
        });
    }

    beNewsLoadEdit();

    const UserBalanceChart = (id) => {
        // Chart's
        // let charts = document.getElementById("userBalance");
        let charts = document.getElementById(id);

        if (typeof(charts) != 'undefined' && charts != null) {
            // Track
            let track = charts.querySelector('.track-outline circle');
            // Outline
            let outline = charts.querySelector('.moving-outline circle');
            // Outline
            let text = charts.querySelector('.chart-info h2');
            // Get the length oof the outline
            let outlineLength = outline.getTotalLength();
            // First & Second sum from calculate
            let firstSum = Number(charts.getAttribute("data-first-sum").replace(/,/gi, ""));
            let secondSum = Number(charts.getAttribute("data-second-sum").replace(/,/gi, ""));

            outline.style.strokeDasharray = outlineLength;
            outline.style.strokeDashoffset = outlineLength;
            
            let percent = Number(parseInt((secondSum / firstSum) * 100));


            if (percent != NaN) {
                text.innerText = percent;
            }
            else {
                text.innerText = "0";
            }

            if (percent > 100 && percent < 200) {
                track.setAttribute("stroke", "rgba(255, 255, 255, 0.4)");
                outline.setAttribute("stroke", "rgba(255, 255, 255, 0.8)");
            }
            else if (percent > 200 && percent < 9999) {
                track.setAttribute("stroke", "rgba(255, 255, 255, 0.4)");
                outline.setAttribute("stroke", "rgba(255, 255, 255, 1)");
            }
            else {
                track.setAttribute("stroke", "rgba(255, 255, 255, 0.4)");
                outline.setAttribute("stroke", "rgba(255, 255, 255, 0.6)");
            }

            let progress = outlineLength - ((secondSum / firstSum) * outlineLength);

            if (progress < 0) {
                progress = outlineLength - ((progress % outlineLength) * (-1));

                outline.style.strokeDashoffset = progress;
            }
            else {
                outline.style.strokeDashoffset = progress;
            }
        }
        else {
            return;
        }
    }

    UserBalanceChart("userBalance");
    UserBalanceChart("userReferal");
    UserBalanceChart("userInvest");
    UserBalanceChart("userAvailable");
    UserBalanceChart("userWithdrawal");
}());