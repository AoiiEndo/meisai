function meisai(i){
    // 出力しているオブジェクトを取得
    let company = document.getElementById("companyname"+i);
    let price = document.getElementById("price_position"+i);
    let tax = document.getElementById("taxtax"+i);
    let created = document.getElementById("createdat"+i);

    // 出力している値を取得
    let company_value = company.textContent;
    let price_value = price.textContent;
    let tax_value = tax.textContent;
    let created_value = created.textContent;

    // 取得した値を出力
    // iframe取得
    let iframeElem = document.getElementById('iframe');
    // 金額取得
    let amountTar1 = iframeElem.contentWindow.document.querySelector('#amountValue1');
    let amountTar2 = iframeElem.contentWindow.document.querySelector('#amountValue2');
    let amountTar3 = iframeElem.contentWindow.document.querySelector('#amountValue3');
    // 会社取得
    let target1 = iframeElem.contentWindow.document.querySelector('#company1');
    let target2 = iframeElem.contentWindow.document.querySelector('#company2');
    let target3 = iframeElem.contentWindow.document.querySelector('#company3');
    // 消費税オブジェクト取得
    let taxrat1 = iframeElem.contentWindow.document.querySelector('#tax_ratio1');
    let taxrat2 = iframeElem.contentWindow.document.querySelector('#tax_ratio2');
    let taxrat3 = iframeElem.contentWindow.document.querySelector('#tax_ratio3');
    // 日付取得
    let yearValue = created_value[0];
    let monthValue = created_value[5];
    let dateValue = created_value[8];
    
    for(let i=1;i<4;i++){
        yearValue += created_value[i];
    };
    monthValue += created_value[6];
    dateValue += created_value[9];
    let year_place = iframeElem.contentWindow.document.querySelector('#yearvalue');
    let month_place = iframeElem.contentWindow.document.querySelector('#monthvalue');
    let date_place = iframeElem.contentWindow.document.querySelector('#datevalue');
    let year_place2 = iframeElem.contentWindow.document.querySelector('#yearvalue2');
    let month_place2 = iframeElem.contentWindow.document.querySelector('#monthvalue2');
    let date_place2 = iframeElem.contentWindow.document.querySelector('#datevalue2');
    let year_place3 = iframeElem.contentWindow.document.querySelector('#yearvalue3');
    let month_place3 = iframeElem.contentWindow.document.querySelector('#monthvalue3');
    let date_place3 = iframeElem.contentWindow.document.querySelector('#datevalue3');

    amountTar1.innerHTML = price_value;
    amountTar2.innerHTML = price_value;
    amountTar3.innerHTML = price_value;

    target1.innerHTML = company_value;
    target2.innerHTML = company_value;
    target3.innerHTML = company_value;

    taxrat1.innerHTML = tax_value+"%";
    taxrat2.innerHTML = tax_value+"%";
    taxrat3.innerHTML = tax_value+"%";

    year_place.innerHTML = yearValue;
    year_place2.innerHTML = yearValue;
    year_place3.innerHTML = yearValue;
    month_place.innerHTML = monthValue;
    month_place2.innerHTML = monthValue;
    month_place3.innerHTML = monthValue;
    date_place.innerHTML = dateValue;
    date_place2.innerHTML = dateValue;
    date_place3.innerHTML = dateValue;
}