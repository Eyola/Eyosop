document.getElementById("navProjects").classList.add('bg-info');

document.querySelector('.situationButton').addEventListener(
'click', () => {
    document.querySelector('.situationButton').hidden = true;
    document.querySelector('.orderButton').hidden = true;
    document.querySelector('.resultsButton').hidden = true;
    document.querySelector('.returnSituation').hidden = false;
    document.querySelector('.situation').hidden = false;
    document.querySelector('.returnSituation').hidden = false;
},
false,
);

document.querySelector('.orderButton').addEventListener(
    'click', () => {
    document.querySelector('.situationButton').hidden = true;
    document.querySelector('.orderButton').hidden = true;
    document.querySelector('.resultsButton').hidden = true;
    document.querySelector('.returnOrder').hidden = false;
    document.querySelector('.order').hidden = false;
    document.querySelector('.returnOrder').hidden = false;
},
false,
);

document.querySelector('.resultsButton').addEventListener(
    'click', () => {
    document.querySelector('.situationButton').hidden = true;
    document.querySelector('.orderButton').hidden = true;
    document.querySelector('.resultsButton').hidden = true;
    document.querySelector('.returnOrder').hidden = false;
    document.querySelector('.results').hidden = false;
    document.querySelector('.returnResults').hidden = false;
},
false,
);

document.querySelector('.returnSituation').addEventListener(
    'click', () => {
        document.querySelector('.situationButton').hidden = false;
        document.querySelector('.orderButton').hidden = false;
        document.querySelector('.resultsButton').hidden = false;
        document.querySelector('.returnSituation').hidden = true;
        document.querySelector('.situation').hidden = true;
},
false,
);

document.querySelector('.returnOrder').addEventListener(
    'click', () => {
        document.querySelector('.situationButton').hidden = false;
        document.querySelector('.orderButton').hidden = false;
        document.querySelector('.resultsButton').hidden = false;
        document.querySelector('.returnOrder').hidden = true;
        document.querySelector('.order').hidden = true;
},
false,
);