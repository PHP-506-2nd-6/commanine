// const ratingStars = [...document.getElementsByClassName("rating__star")];
// const ratingResult = document.querySelector(".rating__result");

// printRatingResult(ratingResult);

// function executeRating(stars, result) {
//     const starClassActive = "rating__star fas fa-star";
//     const starClassUnactive = "rating__star far fa-star";
//     const starsLength = stars.length;
//     let i;
//     stars.map((star) => {
//         star.onclick = () => {
//             i = stars.indexOf(star);

//             if (star.className.indexOf(starClassUnactive) !== -1) {
//                 printRatingResult(result, i + 1);
//                 for (i; i >= 0; --i) stars[i].className = starClassActive;
//             } else {
//                 printRatingResult(result, i);
//                 for (i; i < starsLength; ++i)
//                     stars[i].className = starClassUnactive;
//             }
//         };
//     });
// }

// function printRatingResult(result, num = 0) {
//     // result.textContent = `${num}/5`;
//     result.textContent = `${num}`;
// }

// executeRating(ratingStars, ratingResult);
// var value = document.getElementById("rate");

// -----------------------

const ratingStars = [...document.getElementsByClassName("rating__star")];
const ratingForm = document.getElementById("ratingForm");

function executeRating(stars) {
    const starClassActive = "rating__star fas fa-star";
    const starClassUnactive = "rating__star far fa-star";
    const starsLength = stars.length;
    let i;

    stars.forEach((star) => {
        star.onclick = () => {
            i = stars.indexOf(star);

            if (star.className.indexOf(starClassUnactive) !== -1) {
                for (i; i >= 0; --i) stars[i].className = starClassActive;
            } else {
                for (i; i < starsLength; ++i)
                    stars[i].className = starClassUnactive;
            }

            // const rating = i;
            const rating = document.querySelectorAll(
                ".rating__star.fas.fa-star"
            ).length;

            // 폼에 별점 값을 설정하여 서버로 전송
            document.getElementById("ratingInput").value = rating;
            ratingForm.submit();
        };
    });
}

executeRating(ratingStars);

// -------------------------------------------------
// function checkDataAndRedirect() {
//     var data = /* 데이터 존재 여부를 확인하는 로직 */;

//     if (data) {
//       alert("데이터가 이미 존재합니다.");
//       return;
//     } else {
//       window.location.href = "다른페이지URL";
//     }
//   }
