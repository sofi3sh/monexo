(function() {
    document.addEventListener('DOMContentLoaded', function () {
        // Feedback form wrapper
        let wrapper = document.querySelector('.gr-feedback-wrapper');

        if (typeof(wrapper) != 'undefined' && wrapper != null) {
            // Form
            let form = wrapper.querySelector('.gr-fw-form');
            // Form inputs
            let userName = document.getElementById("fbUserFio"),
                userMessanger = document.getElementById("fbUserMessagner"),
                userPhone = document.getElementById("fbUserPhone");
            // Form open button
            let openBtn = $('.gr-feedback-open');
            // Form close button
            let closeBtn = $('.gr-fw-close');
            // Form submit button
            let submitBtn = wrapper.querySelector('.gr-fwc-submit-btn');

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
                $('.gr-feedback').addClass("open");
            });

            // Close function
            closeBtn.on("click", () => {
                $('.gr-feedback').removeClass("open");
            });
        }
    });
})();