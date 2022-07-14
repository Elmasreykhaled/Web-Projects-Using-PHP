
$(".btnedit").click(e=>{
    let textValues = DisplayData(e);
    let id = $("input[name*='book_id']");
    let book_name = $("input[name*='book_name']");
    let book_publisher = $("input[name*='book_publisher']");
    let book_price = $("input[name*='book_price']");
    id.val(textValues[0]);
    book_name.val(textValues[1]);
    book_publisher.val(textValues[2]);
    book_price.val(textValues[3].replace("$", ""));

});

function DisplayData(e){
    let id = 0;
    const tableData = $("#sel table tbody tr td");
    let textValues = [];
    for (const value of tableData){
        if (value.dataset.id == e.target.dataset.id){
            textValues[id++] = value.textContent;

        }
    }
    return textValues;
}