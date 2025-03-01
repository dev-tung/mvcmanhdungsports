// Validate form
Validator({
    form: '#revenueAdd',
    rules: [
        Validator.slbRequired({
            selector: '#revenue_category',
            submit: true
        })
    ],
    onSubmit: (data) => {
        data.form.submit();
    }
});

// Product category selected
document.getElementById('cmsRevenueProductCustomer').style.display = "none";
var revenueCategorySlb = document.getElementById('revenue_category');
revenueCategorySlb.addEventListener("change", function(){
    let selectedCategory = revenueCategorySlb.options[revenueCategorySlb.selectedIndex];

    // Get category name for submit
    document.getElementById('revenue_category_name').value = selectedCategory.text;

    // Get product by category
    (async () => {
        const rawResponse = await fetch(Define.API_PATH + '/product/get', {
          method: 'POST',
          headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({procat_id: selectedCategory.value})
        });
        const response = await rawResponse.json();
      
        // Done load product by category
        document.getElementById('cmsRevenueProductCustomer').style.display = "block";
        document.getElementById('popupSearch').style.display = "block";
        const searchInput = document.getElementById('popupSearchFormInputProduct');
        searchInput.addEventListener("keyup", () => {
    
            let popupSearchResult = document.getElementById('popupSearchResult');
            let searchValue = searchInput.value;
    
            if( searchValue == '' ){
                popupSearchResult.innerHTML = `<p class="popupSearchResultNo">Không có kết quả</p>`;
                return;
            }
    
            popupSearchResult.innerHTML = '';
            response.data.forEach(Item => {
    
                let middle = 80; 
                let content = Item.product_name;
                let matchIndex = content.indexOf(searchValue);
            
                content = matchIndex > middle 
                            ? '...' + content.substring(matchIndex - middle, matchIndex + middle) + '...'
                            : content = content.substring(0, middle * 2) + '...';
    
                if( content.toUpperCase().indexOf(searchValue.toUpperCase()) != -1 ){
                    content = content.replace(new RegExp(searchValue, 'gi'), '<mark>$&</mark>');
                    popupSearchResult.innerHTML += 
                            `<a href="#" class="popupSearchItem popupSearchItem-productName" id="${Item.product_id}">
                                <p class="popupSearchTitle">${Item.product_name}</p>
                                <div class="popupSearchContent">
                                    <img src="${Define.ROOT_URL}/${Item.product_thumbnail}" width="25" height="25">
                                    <p class="popupSearchContent-Desc">${content}</p>
                                </div>
                            </a>`;
                            
                    document.querySelectorAll('.popupSearchItem-productName').forEach((product) => {
                        product.onclick = () => {
                            document.getElementById('revenue_id').value = product.getAttribute('id');
                            document.getElementById('revenue_name').value = product.querySelector('.popupSearchTitle').innerHTML;
                            document.getElementById('popupSearchModalProduct').classList.remove("Show");
                        }
                    });
    
                }
    
            });
    
        });



    })();
});


// Search customer
(async () => {
    const rawResponse = await fetch(Define.API_PATH + '/customer/get', {
        method: 'POST',
        headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
        }
    });
    const response = await rawResponse.json();
    
    // Done load customer
    const searchInput = document.getElementById('popupSearchFormInputCustomer');
    searchInput.addEventListener("keyup", () => {

        let popupSearchResult = document.getElementById('popupSearchResultCustomer');
        let searchValue = searchInput.value;

        if( searchValue == '' ){
            popupSearchResult.innerHTML = `<p class="popupSearchResultNo">Không có kết quả</p>`;
            return;
        }

        popupSearchResult.innerHTML = '';
        response.data.forEach(Item => {

            let middle = 80; 
            let content = Item.customer_phone;

            let matchIndex = content.indexOf(searchValue);
        
            content = matchIndex > middle 
                        ? '...' + content.substring(matchIndex - middle, matchIndex + middle) + '...'
                        : content = content.substring(0, middle * 2) + '...';

            if( content.toUpperCase().indexOf(searchValue.toUpperCase()) != -1 ){

                content = content.replace(new RegExp(searchValue, 'gi'), '<mark>$&</mark>');
                popupSearchResult.innerHTML += 
                        `<a href="#" class="popupSearchItem popupSearchItem-customerName" id="${Item.customer_phone}">
                            <p class="popupSearchTitle">${Item.customer_name}</p>
                            <div class="popupSearchContent">
                                <p class="popupSearchContent-Desc">${content}</p>
                            </div>
                        </a>`;
                        
                document.querySelectorAll('.popupSearchItem-customerName').forEach((customer) => {
                    customer.onclick = () => {
                        document.getElementById('customer_name').value = customer.querySelector('.popupSearchTitle').innerHTML;
                        document.getElementById('customer_phone').value = customer.getAttribute('id');
                        document.getElementById('popupSearchModalCustomer').classList.remove("Show");
                    }
                });

            }

        });

    });



})();



