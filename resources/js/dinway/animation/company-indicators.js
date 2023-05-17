import { CountUp } from "countup.js";
import { isElementInViewport as isView } from "../helpers/functions";

window.addEventListener('load', function() {
    const indicators = document.querySelectorAll("#company-indicators #indicator");
    const countsUp = [];
    const usedIndexes = [];
    let animationUsed = false;
    
    indicators.forEach(indicator => {
        const count = parseInt(indicator.dataset.count);
        countsUp.push(
            new CountUp(indicator, count, {
                useGrouping: false
            })
        );
    });
    
    function countUpOnView(index) {
        if (isView(indicators[index])) {
            if (!usedIndexes.includes(index)) {
                usedIndexes.push(index);
            }
            if (usedIndexes.length === indicators.length) {
                animationUsed = true;
            }
            countsUp[index].start();
        }
    }
    
    function startCountsUp() {
        if (!animationUsed) {
            countsUp.forEach((countUp, index) => countUpOnView(index));
        }
    }
    
    startCountsUp();
    window.addEventListener("scroll", startCountsUp);

});


