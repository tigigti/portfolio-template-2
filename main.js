window.onload = function () {
    function handleFormRequestVanilla() {
        document.querySelector("#kontaktContainer").addEventListener("submit", e => {
            e.preventDefault();
            const formData = new FormData(e.target);
            formData.append("action", "send_email");

            const responseBox = document.querySelector("#responses");
            responseBox.innerHTML = "Wird gesendet...";
            responseBox.classList.remove("successfull", "failed");
            responseBox.classList.add("sending");

            fetch(ajaxurl, {
                method: "post",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded; charset=UTF-8",
                },
                body: new URLSearchParams(formData),
            })
                .then(res => res.json())
                .then(res => {
                    console.log("res", res);
                    responseBox.classList.remove("sending");
                    responseBox.innerHTML = res.message;
                    if (res.status == "success") {
                        responseBox.classList.add("successfull");
                        responseBox.classList.remove("failed");
                    } else {
                        responseBox.classList.remove("successfull");
                        responseBox.classList.add("failed");
                    }
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
        const topContainer = document.querySelector(".top-container");
        const multiply = 0.3;

        document.addEventListener("scroll", e => {
            const st = window.pageYOffset;
            const fromTop = st * multiply;
            if (st > 200) {
                headerNav.classList.add("pinned");
            } else {
                headerNav.classList.remove("pinned");
            }
            vid.style.transform = `translateY(${fromTop}px)`;
            topContainer.style.backgroundPosition = `50% -${fromTop}px`;
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
    handleFormRequestVanilla();
};
