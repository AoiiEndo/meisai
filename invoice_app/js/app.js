let companyName = document.getElementById('company_name_input');
        companyName.addEventListener('change', function() {
            let companyChange = companyName.value;

            let iframeElem = document.getElementById('iframe');
            let target1 = iframeElem.contentWindow.document.querySelector('#company1');
            let target2 = iframeElem.contentWindow.document.querySelector('#company2');
            let target3 = iframeElem.contentWindow.document.querySelector('#company3');

            target1.innerHTML = companyChange;
            target2.innerHTML = companyChange;
            target3.innerHTML = companyChange;
        }); 

    // 取引金額取得js

        let amount = document.getElementById('transactions_money');
        amount.addEventListener('change', function(){
            let amountChange = amount.value;

            let iframeElem = document.getElementById('iframe');
            let amountTar1 = iframeElem.contentWindow.document.querySelector('#amountValue1');
            let amountTar2 = iframeElem.contentWindow.document.querySelector('#amountValue2');
            let amountTar3 = iframeElem.contentWindow.document.querySelector('#amountValue3');

            amountTar1.innerHTML = amountChange;
            amountTar2.innerHTML = amountChange;
            amountTar3.innerHTML = amountChange;
        });

    // 日付取得js

        var date = document.getElementById('date_input');
        date.addEventListener('change', function(){
            let yearValue = date.value[0];
            let monthValue = date.value[5];
            let dateValue = date.value[8];
            
            for(let i=1;i<4;i++){
                yearValue += date.value[i];
            };
            monthValue += date.value[6];
            dateValue += date.value[9];
            
            let iframeElem = document.getElementById('iframe');
            let year_place = iframeElem.contentWindow.document.querySelector('#yearvalue');
            let month_place = iframeElem.contentWindow.document.querySelector('#monthvalue');
            let date_place = iframeElem.contentWindow.document.querySelector('#datevalue');

            let year_place2 = iframeElem.contentWindow.document.querySelector('#yearvalue2');
            let month_place2 = iframeElem.contentWindow.document.querySelector('#monthvalue2');
            let date_place2 = iframeElem.contentWindow.document.querySelector('#datevalue2');

            let year_place3 = iframeElem.contentWindow.document.querySelector('#yearvalue3');
            let month_place3 = iframeElem.contentWindow.document.querySelector('#monthvalue3');
            let date_place3 = iframeElem.contentWindow.document.querySelector('#datevalue3');

            year_place.innerHTML = yearValue;
            year_place2.innerHTML = yearValue;
            year_place3.innerHTML = yearValue;
            month_place.innerHTML = monthValue;
            month_place2.innerHTML = monthValue;
            month_place3.innerHTML = monthValue;
            date_place.innerHTML = dateValue;
            date_place2.innerHTML = dateValue;
            date_place3.innerHTML = dateValue;
        });

    // 消費税取得js

        var tax = document.getElementById('tax');
        tax.addEventListener('change', function(){
            var num = tax.selectedIndex;
            var taxValue = tax.options[num].value;

            let iframeElem = document.getElementById('iframe');
            let taxrat1 = iframeElem.contentWindow.document.querySelector('#tax_ratio1');
            let taxrat2 = iframeElem.contentWindow.document.querySelector('#tax_ratio2');
            let taxrat3 = iframeElem.contentWindow.document.querySelector('#tax_ratio3');

            taxrat1.innerHTML = taxValue;
            taxrat2.innerHTML = taxValue;
            taxrat3.innerHTML = taxValue;
        });
        // 印刷用js
   
        let print = document.getElementById('print');
        print.addEventListener('click', function(){
            let print_iframe = document.getElementById('iframe');
            print_iframe.contentWindow.print();
        });