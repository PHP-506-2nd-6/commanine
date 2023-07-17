// 찜목록 API 0717 add KMH
let hanok = document.getElementById('hanokId');
let user = document.getElementById('user');
let url = '/api/wishlists/' + hanok.value;
let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

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
        // window.location.href = redirect;
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

        // window.location.href = redirect;
    })
    .catch(function(error) {
        console.log('실패'+error);
    });
}