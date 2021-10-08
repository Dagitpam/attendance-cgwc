function createChartLayout(title) {
    var chartContainer = document.getElementById("charts");

    var layout = document.createElement("div");
    layout.className = "col-md-6";

    var card = document.createElement("div");
    card.className = "card card-422";

    var title = document.createTextNode(title);
    var titleFormat = document.createElement("p");

    titleFormat.appendChild(title);

    var cardHead = document.createElement("div");
    cardHead.className = "card-header";

    cardHead.appendChild(titleFormat);

    var cardBody = document.createElement("div");
    cardBody.className = "card-body";

    var chartDiv = document.createElement("canvas");
    chartDiv.style.height = "500px";

    cardBody.appendChild(chartDiv);

    card.appendChild(cardHead);
    card.appendChild(cardBody);
    layout.appendChild(card);
    chartContainer.appendChild(layout);

    return chartDiv;
}
