
const scriptElement = document.currentScript;
window.onload = function() {
    const typeList = JSON.parse(scriptElement.getAttribute('data-exist-type'));
    for (const year in typeList) {
        const content = document.querySelector('.content');

        const yearDiv = document.createElement('div');
        yearDiv.classList.add('year');
        yearDiv.textContent = year;
        content.appendChild(yearDiv);

        for (const number of typeList[year]) {
            const link = document.createElement('a');
            link.href = `/word/${year}/${number}`;
            link.classList.add('btn', 'btn-primary', 'btn-lg', 'btn-block');
            link.textContent = number;
            yearDiv.appendChild(link);
        }
    }

}

