// const minSlider = document.getElementById("minPrijs");
// const maxSlider = document.getElementById("maxPrijs");
// const minValue = document.getElementById("minValue");
// const maxValue = document.getElementById("maxValue");
// const resetBtn = document.getElementById("resetPrijs");

// const origineleMin = parseInt(minSlider.value);
// const origineleMax = parseInt(maxSlider.value);

// // Functie om knop actief te maken indien sliders aangepast zijn
// function checkPrijsFilter() {
//     if (parseInt(minSlider.value) !== origineleMin || parseInt(maxSlider.value) !== origineleMax) {
//         resetBtn.disabled = false;
//     } else {
//         resetBtn.disabled = true;
//     }
// }

// // Update slider display
// function updateSliders() {
//     minValue.textContent = minSlider.value;
//     maxValue.textContent = maxSlider.value;
//     checkPrijsFilter();
// }

// // Event listeners
// minSlider.addEventListener("input", updateSliders);
// maxSlider.addEventListener("input", updateSliders);

// // Reset knop functionaliteit
// resetBtn.addEventListener("click", () => {
//     minSlider.value = origineleMin;
//     maxSlider.value = origineleMax;
//     updateSliders();
// });