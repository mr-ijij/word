async function fetchCsvData(file) {
    const response = await fetch(file);
    const csvData = await response.text();
    return csvData;
}

async function displayCsvData() {
    const csvData = await fetchCsvData("./words/2023/4.csv");
    const wordContainer = document.getElementById("word-container");
    const lines = csvData.split("\n");

    for (const line of lines) {
        const [english, japanese] = line.split(", ");
        const wordRow = document.createElement("div");
        wordRow.className = "word-row";

        const englishElement = document.createElement("span");
        englishElement.textContent = english;

        const japaneseElement = document.createElement("span");
        japaneseElement.textContent = japanese;

        wordRow.appendChild(englishElement);
        wordRow.appendChild(japaneseElement);
        wordContainer.appendChild(wordRow);
    }
}

displayCsvData();