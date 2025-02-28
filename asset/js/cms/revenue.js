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

// Get category name for submit
var revenueCategorySlb = document.getElementById('revenue_category');
revenueCategorySlb.addEventListener("change", function(){
    document.getElementById('revenue_category_name').value = revenueCategorySlb.options[revenueCategorySlb.selectedIndex].text;
});


// Search product by productName
fetch('http://manhdungsports.local/api/product/get')
.then(res => res.json())
.then(response => {

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

});
