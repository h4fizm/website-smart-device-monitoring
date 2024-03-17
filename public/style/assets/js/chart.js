let circularProgresses = document.querySelectorAll(".circular-progress");
let progressValues = document.querySelectorAll(".progress-value");
let progressIndicators = document.querySelectorAll(".progress-indicator");

console.log(circularProgresses);
console.table(progressIndicators);

// Define the end values and units for each indicator
let indicators = [
    { endValue: 30, unit: 'Volt' },
    { endValue: 50, unit: 'Ampere' },
    { endValue: 80, unit: 'Watt' },
    { endValue: 20, unit: 'Celcius' }
];

let speed = 20; // Milliseconds

circularProgresses.forEach((circularProgress, index) => {
    let progressStartValue = 0;
    let progressEndValue = parseFloat(progressIndicators[index].innerHTML.split(" ")[0]);
    let unit = indicators[index].unit;

    let progress = setInterval(() => {
        if (progressStartValue <= progressEndValue) {
            progressStartValue += 0.5;
            progressValues[index].textContent = `${progressStartValue} ${unit}`;
            circularProgress.style.background = `conic-gradient(#3a2ae8 ${progressStartValue * 3.6}deg, #ededed 0deg)`;
        }

        if (progressStartValue >= progressEndValue) {
            progressValues[index].textContent = `${progressEndValue} ${unit}`;
            clearInterval(progress);
        }
    }, speed);
});
