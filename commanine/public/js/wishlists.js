// 찜목록 API 0717 add KMH
let hanok = document.getElementById('hanokId');
let user = document.getElementById('user');
let postUrl = '/api/wishlists/post/' + hanok.value;
let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
let deleteUrl = '/api/wishlists/delete/' + hanok.value;
let countWish = document.querySelector('.countWish');

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
//     let hanok = document.getElementById('hanokId');
// let user = document.getElementById('user');
// let postUrl = '/api/wishlists/post/' + hanok.value;
// let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch(postUrl, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json, text-plain, */*",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
            },
        method: 'post',
        credentials: "same-origin",
        body: JSON.stringify({
            user_id: user.value,
            hanok_id: hanok.value
        })
    })
    .then(data=>{
        if(data.status !== 200){
                throw new Error(data.status + ' : API Response Error');
            }
        return data.json();
        })
    .then((apiData) => {
        console.log(apiData);
        if(apiData['errorcode'] === 'E01'){
            // return console.log(apiData['msg']);
            return window.location.href = 'http://www.localhost/users/login';
        }

        wishHeartRed.classList.add('active');
        wishHeart.classList.remove('active');
        countWish.innerHTML = parseInt(countWish.innerHTML)+1;
        // countWish.innerHTML = countWish.
    })
    .catch(function(error) {
        console.log('실패'+error);
    });
};

function deleteWish() {
    fetch(deleteUrl, {
        headers: {
            "Content-Type": "application/json",
            "Accept": "application/json",
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": token
            },
        method: 'delete',
        body: JSON.stringify({
            hanok_id: hanok.value,
            user_id: user.value
        })
    })
    .then(data=>{
        if(data.status !== 200){
                throw new Error(data.status + ' : API Response Error');
            }
        return data.json();
        })
    .then((apiData) => {
        console.log(apiData);
        if(apiData['errorcode'] === 'E01'){
            // return console.log(apiData['msg']);
            return window.location.href = 'http://www.localhost/users/login';
        }
        wishHeartRed.classList.toggle('active');
        wishHeart.classList.toggle('active');
        countWish.innerHTML = parseInt(countWish.innerHTML)-1;
        // countWish.innerHTML = countWish.
    })
    .catch(function(error) {
        console.log('실패'+error);
    });
}