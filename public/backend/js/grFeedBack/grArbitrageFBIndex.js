(function() {
    document.addEventListener('DOMContentLoaded', function () {
        // Feedback form wrapper
        let wrapper = document.querySelector('.gr-arbitrage-fb-wrapper');
        // Form
        let form = wrapper.querySelector('.gr-afw-form');
        // Form inputs
        let userName = document.getElementById("afbUserFio"),
            userMessanger = document.getElementById("afbUserMessagner"),
            userPhone = document.getElementById("afbUserPhone");
        // Form open button
        let openBtn = $('.gr-arbitrage-fb-open');
        // Form close button
        let closeBtn = $('.gr-afw-close');
        // Form submit button
        let submitBtn = wrapper.querySelector('.gr-afwc-submit-btn');

        // Submit form function
        submitBtn.addEventListener("click", () => {
            
            if (userName.value == "") {
                userName.classList.add("error");
            }
            if (userMessanger.value == "") {
                userMessanger.classList.add("error");
            }
            if (userPhone.value == "") {
                userPhone.classList.add("error");
            }

            if (userName.value != "" && userMessanger.value != "" && userPhone.value != "") {
                submitBtn.removeAttribute("disabled");
                form.submit();
            }
        });

        // Input events
        form.addEventListener("click", (event) => {
            if (event.target.tagName == "INPUT") {
                event.target.classList.remove("error");
                event.target.addEventListener("focusout", () => {
                    submitBtnStatus();
                    if (event.target.value == "") {
                        event.target.classList.add("error");
                    }
                });
            }
        });

        // Check submit button status
        const submitBtnStatus = () => {
            if (userName.value != "" && userMessanger.value != "" && userPhone.value != "") {
                submitBtn.removeAttribute("disabled");
                submitBtn.classList.remove("disable");
            }
            else {
                submitBtn.classList.add("disable");
            }
        }

        submitBtnStatus();

        // Open function
        openBtn.on("click", () => {
            $('.gr-arbitrage-fb').addClass("open");
        });

        // Close function
        closeBtn.on("click", () => {
            $('.gr-arbitrage-fb').removeClass("open");
        });
    })
})();