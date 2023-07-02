class mosneCarousel {
    /**
     * @param {Object} element
     * @param {Object} opts
     */
    constructor(element, opts) {
        this.element = element;
        this.opts = opts;
        this.isActive = false;
        this.carousel = element.querySelector(".m-carousel__wrapper");
        this.dots = element.querySelector(".m-carousel__dots");
        this.counterCurrent = element.querySelector(".m-carousel__current");
        this.counterTot = element.querySelector(".m-carousel__tot");
        this.nav = element.querySelector(".m-carousel__nav");
        this.next = element.querySelector(".m-carousel__next");
        this.prev = element.querySelector(".m-carousel__prev");
        this.elements = element.querySelectorAll(".m-carousel__slide");
        this.tot = this.elements.length;
        this.counterActive = [];
        this.scrollArg = {
            behavior: "smooth",
            block: "center",
            inline: "center"
        };
        this.init();
    }

    init() {
        if (this.isActive) {
            return false;
        } else {
            let self = this;
            this.isActive = true;
            this.dots.innerHTML = "";
            this.counterTot.innerHTML = this.tot;
            Array.prototype.forEach.call(this.elements, function (el, i) {
                let button = document.createElement("button");
                button.innerHTML =
                    '<span class="sr-only">Go to slide ' + (i + 1) + "<span>";
                button.classList.add("m-carousel__dot");
                button.onclick = function () {
                    self.elements[i].scrollIntoView(self.scrollArg);
                    self.elements[i].focus();
                };
                self.dots.appendChild(button);
            });

            this.next.onclick = function () {
                let target = self.counterActive[self.counterActive.length - 1];
                self.elements[target].focus();
                self.elements[target].scrollIntoView(self.scrollArg);
            };
            this.prev.onclick = function () {
                let target = self.counterActive[0] - 2;
                self.elements[target].focus();
                self.elements[target].scrollIntoView(self.scrollArg);
            };

            this.dotsButtons = this.dots.querySelectorAll(".m-carousel__dot");

            this.observer = new IntersectionObserver(
                function (entries, observer) {
                    // find the entry with the largest intersection ratio
                    this.currentActiveSlides = [];

                    entries.forEach(function (entry) {
                        let idx = self.indexInParent(entry.target);
                        if (entry.isIntersecting) {
                            entry.target.classList.add("m-carousel__slide-current");
                            self.dotsButtons[idx].classList.add("m-carousel__dot-active");
                            self.counterActive.push(idx + 1);
                            self.status = idx;
                        } else {
                            entry.target.classList.remove("m-carousel__slide-current");
                            self.dotsButtons[idx].classList.remove("m-carousel__dot-active");
                            self.counterActive = self.counterActive.filter(
                                (e) => e !== idx + 1
                            );
                        }
                    });

                    var activated = entries.reduce(function (max, entry) {
                        return entry.intersectionRatio > max.intersectionRatio
                            ? entry
                            : max;
                    });
                    if (activated.intersectionRatio > 0) {
                        let currentIndex = activated.target;
                        self.renderCounter();
                        self.renderNav(currentIndex);
                    }
                },
                {
                    root: self.carousel,
                    threshold: .95
                }
            );
            Array.prototype.forEach.call(this.elements, function (el, i) {
                el.setAttribute("id", "slide-" + i);
                el.setAttribute("tabindex", 0);
                self.observer.observe(self.elements[i]);
            });
        }
    }

    indexInParent(node) {
        var children = node.parentNode.childNodes;
        var num = 0;
        for (var i = 0; i < children.length; i++) {
            if (children[i] == node) return num;
            if (children[i].nodeType == 1) num++;
        }
        return -1;
    }

    resetClass(containerEl, classToRemove) {
        let targetElements = containerEl.querySelectorAll("." + classToRemove);
        Array.prototype.forEach.call(targetElements, function (el, i) {
            el.classList.remove(classToRemove);
        });
    }

    renderCounter() {
        this.counterActive.sort();
        let currentRender = this.counterActive.join(", ");
        if ("" !== currentRender) {
            this.counterCurrent.innerHTML = currentRender;
        }
    }

    renderDots(current) {
        resetClass(this.dots, "m-carousel__dot-active");
        let currentDot = this.dots[current];
        currentDot.classList.add("m-carousel__dot-active");
    }

    renderNav(current) {
        this.resetClass(this.nav, "m-carousel__hide");
        let currentIdx = this.indexInParent(current);
        if (0 === currentIdx) {
            this.prev.classList.add("m-carousel__hide");
        }
        if (this.tot - 1 === currentIdx) {
            this.next.classList.add("m-carousel__hide");
        }
    }
}

const mosneCarouselOptions = {
    dots: true,
    nav: false,
    scrollbar: false,
    counter: true
};


// wait for dom ready
document.addEventListener("DOMContentLoaded", function () {
    const mCarousel = document.querySelectorAll(".m-carousel");
    Array.prototype.forEach.call(mCarousel, function (el, i) {
        new mosneCarousel(el, mosneCarouselOptions);
    });
});
