const roomBtn = document.querySelector('.roomBtn');
const addrBtn = document.querySelector('.addrBtn');
const serviceBtn = document.querySelector('.serviceBtn');
const policyBtn = document.querySelector('.policyBtn');
const reviewBtn = document.querySelector('.reviewBtn');
const addr = document.querySelector('.addr');
const service = document.querySelector('.service');
roomBtn.addEventListener('click',function() {
    // const rooms = document.querySelector('.rooms');
    // rooms.style.backgroundColor = 'cornflowerblue';
    addr.classList.remove('on');
    service.classList.remove('on');
    policyBtn.classList.remove('on');
    reviewBtn.classList.remove('on');
    })
    // rooms.style.display = 'inline-block';})
// let flg = 0;
addrBtn.addEventListener('click',() => {addr.className += ' on'})
serviceBtn.addEventListener('click',() => {service.className += ' on'})