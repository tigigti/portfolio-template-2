window.onload = function () {
    jQuery(document).ready(function ($) {
        $("#loader").fadeOut("slow");
        document.body.style.overflowY = "auto";
        // document.body.style.overflowX = "auto";

        if (document.querySelector(".contact-group h1")) {
            document.querySelector(".contact-group h1").classList.add("animated");
        }

        function fadeInOnView() {
            $(window).scroll(function () {
                var viewportTop = $(window).scrollTop();
                var viewportBottom = viewportTop + $(window).height();
                $(".animated-icon").each(function () {
                    // Abstand von Oberster Rand des Dokuments
                    var iconPosTop = $(this).offset().top;
                    var iconPosBottom = iconPosTop + $(this).height();

                    //Get the position and height of the view and the element
                    // Check if the element is inside the view and animate it
                    if (viewportTop <= iconPosTop && viewportBottom >= iconPosBottom) {
                        if (!$(this).hasClass("fadeInDown")) {
                            $(this).addClass("fadeInDown");
                        }
                    } else {
                        $(this).removeClass("fadeInDown");
                    }
                });
            });
        }

        function modalAnimation() {
            var modal = $("#modal");
            var closeSymbol = $("#close-modal");
            var showAnim = "zoomInDown";
            var exitAnim = "bounceOut";

            $("#contact-btn").click(function () {
                modal.show();
                modal.addClass(showAnim);
            });
            closeSymbol.click(function () {
                modal.removeClass(showAnim);
                modal.addClass(exitAnim);
                setTimeout(function () {
                    modal.hide();
                    modal.removeClass(exitAnim);
                }, 1000);
            });
        }

        function fancyForm() {
            $(".form-group input").each(function () {
                if ($(this).val() != "") {
                    $(this).siblings().addClass("active");
                }
            });

            $(".form-group input")
                .focusin(function () {
                    $(this).siblings().addClass("active");
                })
                .blur(function () {
                    if ($(this).val() == "") {
                        $(this).siblings().removeClass("active");
                    }
                });
        }

        function handleFormRequest() {
            $("#modal-form").submit(function (e) {
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

        function anchorFunction() {
            var anchorElm = document.getElementById("anchor");
            if (!anchorElm) {
                return;
            }
            // Scroll to top on click
            anchorElm.addEventListener("click", function () {
                window.scroll({
                    top: 0,
                    left: 0,
                    behavior: "smooth",
                });
            });

            // Display the Anchor after scrolling
            document.addEventListener("scroll", function () {
                if (window.pageYOffset > 1000) {
                    $(anchorElm).fadeIn(500);
                } else {
                    $(anchorElm).fadeOut(500);
                }
            });
        }

        function fetchPostsOnScroll() {
            var blog = document.getElementById("main-content");
            if (!blog) {
                return;
            }
            var loadingPosts = false;
            var offset = 10;
            document.addEventListener("scroll", function () {
                if (window.innerHeight + window.pageYOffset >= document.body.offsetHeight && !loadingPosts) {
                    loadingPosts = true;
                    console.log("loading Posts...");
                    // Ajax here
                    $.ajax({
                        url: ajaxurl,
                        data: {
                            action: "get_next_posts",
                            offset: offset,
                        },
                        type: "post",
                    })
                        .done(function (res) {
                            $(blog).append(res);
                            loadingPosts = false;
                            offset += 10;
                        })
                        .fail(function (res) {
                            console.log("Request Failed");
                        });
                }
            });
        }

        const animateSubtitle = () => {
            const subItems = [];
            const subContainer = document.querySelectorAll("#subtitle-animated");
            if (!document.querySelector(".subtitle-item")) {
                return;
            }
            document.querySelectorAll(".subtitle-item").forEach((item) => subItems.push(item.innerHTML));

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

        // Enclose function in parentheses to call them immediately
        (function toggleNightMode() {
            var toggler = $("#night-mode-toggler");
            var icon = toggler.find("i");
            var nightMode = false;

            toggler.on("click", () => {
                console.log("night mode toggle");
                if (!nightMode) {
                    icon.addClass("fas fa-sun").removeClass("far fa-moon");
                    document.body.dataset.theme = "night-mode";
                    nightMode = !nightMode;
                    return;
                }
                icon.addClass("far fa-moon").removeClass("fas fa-sun");
                document.body.dataset.theme = "standard";
                nightMode = !nightMode;
            });
        })();

        (function parallaxBackground() {
            if (!document.querySelector("#backgroundVid") || !document.querySelector(".top-container")) {
                return;
            }
            const vid = document.querySelector("#backgroundVid");
            const headerNav = document.querySelector(".header-nav");
            const topContainer = $(".top-container");
            const multiply = 0.3;
            const doc = $(document);

            document.addEventListener("scroll", (e) => {
                const st = doc.scrollTop();
                const fromTop = st * multiply;
                if (st > 200) {
                    headerNav.classList.add("pinned");
                } else {
                    headerNav.classList.remove("pinned");
                }
                // vid.style.top = `${fromTop}px`;
                vid.style.transform = `translateY(${fromTop}px)`;
                topContainer.css({
                    "background-position": `50% -${fromTop}px`,
                });
            });
        })();

        // Holy shit huge shoutout to https://stackoverflow.com/questions/27462306/css3-animate-elements-if-visible-in-viewport-page-scroll
        function animateWhenVisible(entries, observer) {
            entries.forEach((entry) => {
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
        // const leistungCards = document.querySelectorAll(".leistung-card");
        // leistungCards.forEach((card) => {
        //     observer.observe(card);
        // });

        const observeEl = (selector) => {
            document.querySelectorAll(selector).forEach((el) => {
                observer.observe(el);
            });
        };

        observeEl(".leistung-card");
        observeEl(".text-container");
        observeEl(".image-container");

        animateSubtitle();
        modalAnimation();
        fancyForm();
        fadeInOnView();
        handleFormRequest();
        // anchorFunction();
        fetchPostsOnScroll();
    });
};
