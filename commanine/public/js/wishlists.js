// 찜목록 API 0717 add KMH
let hanok = document.getElementById('hanokId');
let user = document.getElementById('user');
let url = '/api/wishlists/' + hanok.value;
let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
let wishFlg = document.querySelector('#wishFlg');
let wishHeartRed = document.querySelector('.wishHeartRed');
let wishHeart = document.querySelector('.wishHeart');
if(wishFlg.value == 0 ){
    wishHeart.classList.add('active');
    wishHeartRed.classList.remove('active');
}else{
    wishHeartRed.classList.add('active');
    wishHeart.classList.remove('active');
}
function storeWish(){
    fetch(url, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
            },
        method: 'post',
        credentials: "same-origin",
        body: JSON.stringify({
            hanok_id: hanok.value,
            user_id: user.value
        })
    })
    .then((data) => {
        console.log(data);
        wishFlg.value = 1;
        wishHeartRed.classList.add('active');
        wishHeart.classList.remove('active');
    })
    .catch(function(error) {
        console.log('실패'+error);
    });
};

function deleteWish() {
    fetch(url, {
        method: 'delete',
        body: JSON.stringify({
            hanok_id: hanok.value,
            user_id: user.value
        })
    })
    .then((data) => {
        console.log(data['errcode']);
        console.log(data['msg']);
        wishFlg.value = 0;
        wishHeart.classList.add('active');
        wishHeartRed.classList.remove('active');

        // window.location.href = redirect;
    })
    .catch(function(error) {
        console.log('실패'+error);
    });
}