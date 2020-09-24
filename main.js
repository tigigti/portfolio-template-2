window.onload = function () {
    jQuery(document).ready(function ($) {
        // $("#loader").fadeOut("slow");
        // document.body.style.overflowY = "auto";

        function handleFormRequest() {
            $("#kontaktContainer").submit(function (e) {
                e.preventDefault();
                var serializedData = $(this).serializeArray();
                var data = {};
                data.action = "send_email";
                for (var i = 0; i < serializedData.length; i++) {
                    var key = serializedData[i].name;
                    var value = serializedData[i].value;
                    data[key] = value;
                }

                $("#responses").html("Wird gesendet...");
                $("#responses").removeClass("successfull failed");
                $("#responses").addClass("sending");
                $.ajax({
                    url: ajaxurl,
                    data: data,
                    type: "post",
                })
                    .done(function (res) {
                        res = JSON.parse(res);
                        $("#responses").removeClass("sending");
                        $("#responses").html(res.message);
                        if (res.status == "success") {
                            $("#responses").addClass("successfull").removeClass("failed");
                        } else {
                            $("#responses").addClass("failed").removeClass("successfull");
                        }
                    })
                    .fail(function () {
                        console.log("request failed");
                    });
            });
        }

        const animateSubtitle = () => {
            const subItems = [];
            const subContainer = document.querySelectorAll("#subtitle-animated");
            if (!document.querySelector(".subtitle-item")) {
                return;
            }
            document.querySelectorAll(".subtitle-item").forEach(item => subItems.push(item.innerHTML));

            // Loop through subtitle items and animate them
            let currentItem = 0;
            subContainer[0].innerHTML = subItems[0];
            let i = subItems[0].length;
            let finished = false;
            let speed = 50;

            function typeWriterAnim() {
                if (i < subItems[currentItem].length && !finished) {
                    subContainer[0].innerHTML += subItems[currentItem][i];
                    i += 1;
                    speed = 50;
                } else if (i === subItems[currentItem].length && !finished) {
                    finished = true;
                    speed = 5000;
                } else if (i <= subItems[currentItem].length && i !== 1) {
                    subContainer[0].innerHTML = subContainer[0].innerHTML.slice(0, -1);
                    i -= 1;
                    speed = 50;
                } else if (i === 1 && finished) {
                    finished = false;
                    currentItem = currentItem === subItems.length - 1 ? 0 : currentItem + 1;
                    subContainer[0].innerHTML = subItems[currentItem][0];
                }

                // console.log(finished, i);
                setTimeout(typeWriterAnim, speed);
            }

            typeWriterAnim();
        };

        (function parallaxBackground() {
            if (!document.querySelector("#backgroundVid") || !document.querySelector(".top-container")) {
                return;
            }
            const vid = document.querySelector("#backgroundVid");
            const headerNav = document.querySelector(".header-nav");
            const topContainer = $(".top-container");
            const multiply = 0.3;
            const doc = $(document);

            document.addEventListener("scroll", e => {
                const st = doc.scrollTop();
                const fromTop = st * multiply;
                if (st > 200) {
                    headerNav.classList.add("pinned");
                } else {
                    headerNav.classList.remove("pinned");
                }
                vid.style.transform = `translateY(${fromTop}px)`;
                topContainer.css({
                    "background-position": `50% -${fromTop}px`,
                });
            });
        })();

        // Holy shit huge shoutout to https://stackoverflow.com/questions/27462306/css3-animate-elements-if-visible-in-viewport-page-scroll
        function animateWhenVisible(entries, observer) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("animate");
                }
            });
        }

        let options = {
            root: null,
            rootMargin: "0px",
            threshold: 0.3,
        };

        const observer = new IntersectionObserver(animateWhenVisible, options);

        observer.observe(document.getElementById("aboutMe"));
        observer.observe(document.getElementById("kontaktContainer"));

        const observeEl = selector => {
            document.querySelectorAll(selector).forEach(el => {
                observer.observe(el);
            });
        };

        observeEl(".leistung-card");
        observeEl(".text-container");
        observeEl(".image-container");

        animateSubtitle();
        handleFormRequest();
    });
};
