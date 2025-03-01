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
        const searchInput = document.getElementById('popupSearchFormInput');
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
                    let ROOT_URL = window.location.origin;
                    content = content.replace(new RegExp(searchValue, 'gi'), '<mark>$&</mark>');
                    popupSearchResult.innerHTML += 
                            `<a href="#" class="popupSearchItem popupSearchItem-productName" id="${Item.product_id}">
                                <p class="popupSearchTitle">${Item.product_name}</p>
                                <div class="popupSearchContent">
                                    <img src="${ROOT_URL}/${Item.product_thumbnail}" width="25" height="25">
                                    <p class="popupSearchContent-Desc">${content}</p>
                                </div>
                            </a>`;
                            
                    document.querySelectorAll('.popupSearchItem-productName').forEach((product) => {
                        product.onclick = () => {
                            document.getElementById('revenue_name').value = product.querySelector('.popupSearchTitle').innerHTML;
                            document.getElementById('popupSearchModal').classList.remove("Show");
                            document.getElementById('revenue_id').value = product.getAttribute('id');
                        }
                    });
    
                }
    
            });
    
        });



    })();
});


