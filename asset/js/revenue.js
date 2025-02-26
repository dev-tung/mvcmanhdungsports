function GetSearchItem(Title, Content, SearchValue, MatchIndex){
    let Middle = 80;

    Content = MatchIndex > Middle 
                ? '...' + Content.substring(MatchIndex - Middle, MatchIndex + Middle) + '...'
                : Content = Content.substring(0, Middle * 2) + '...';

    Content = Content.replace(new RegExp(SearchValue, 'gi'), '<mark>$&</mark>');
    return `<div class="productSearchItem">
                <p class="productSearchTitle">${Title}</p>
                <div class="productSearchContent">
                    <svg class="productSearchContent-Icon" width="25" height="25" viewBox="0 0 20 20"><path d="M17 5H3h14zm0 5H3h14zm0 5H3h14z" stroke="currentColor" fill="none" fill-rule="evenodd" stroke-linejoin="round"></path></svg>
                    <p class="productSearchContent-Desc">${Content}</p>
                </div>
            </div>`;
} 


fetch('https://dummyjson.com/posts')
.then(res => res.json())
.then(response => {

    document.getElementById('productSearch').style.display = "block";
    const searchInput = document.getElementById('productSearchFormInput');
    searchInput.addEventListener("keyup", () => {

        let productSearchResult = document.getElementById('productSearchResult');
        let SearchValue = searchInput.value;

        if( SearchValue == '' ){
            productSearchResult.innerHTML = `<p class="productSearchResult-No">Không có kết quả</p>`;
            return;
        }

        productSearchResult.innerHTML = '';
        response.posts.forEach(Item => {
            let Title = Item.title; let Content = Item.body;
            if( Content.toUpperCase().indexOf(SearchValue.toUpperCase()) != -1 ){
                let MatchIndex = Content.indexOf(SearchValue);
                productSearchResult.innerHTML += GetSearchItem(Title, Content, SearchValue, MatchIndex);
            }
        });

    });

});
