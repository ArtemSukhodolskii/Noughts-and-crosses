//function func(id){
//    const btn = document.querySelector("." + id);
//    console.log(btn)
//    btn.classList.toggle('cross');
//}

const field = [[], [], []];

function fill_board(field){
    for (let i = 0; i < field.length; i++) {
      for (let j = 0; j < field[i].length; j++) {
        const str = "c" + String(j) + "r" + String(i);
        if(field[i][j] === "#"){
          document.querySelectorAll(".btn-label").forEach(item => {
            if(item.getAttribute("for") === str){
              item.setAttribute("for", "#");
              item.classList.add("cross");
            }
          });
        }else if(field[i][j] === "0"){
          document.querySelectorAll(".btn-label").forEach(item => {
            if(item.getAttribute("for") === str){
              item.setAttribute("for", "#");
              item.classList.add("null");
            }
          });
        }
      }
    }
}


for (let i = 0; i < field.length; i++) {
  for (let j = 0; j < 3; j++) {
    field[i][j] = " ";
  }
}

function AJAX (url, method, data) {
  const xhr = new XMLHttpRequest();
  let form = JSON.stringify({
    field: data
  });
  xhr.open(method, url);

  xhr.onload = function () {
    const data = JSON.parse(xhr.response);
    if(data.hasOwnProperty("Winner")){
      document.querySelector(".result-form").classList.remove("disable");
      const text = document.querySelector("#result1");
      if(data.Winner === "Draw"){
        text.innerHTML = "Ничья! Хотите попробывать снова?";
      }else if(data.Winner === "#"){
        text.innerHTML ="Вы победили! Хотите попробывать снова?";
      }else{
        text.innerHTML = "Вы проиграли! Хотите попробывать снова?";
      }

    }
    else if(data.hasOwnProperty("Win")){
      field[data.Win[0]][data.Win[1]] = "0";
    }else if(data.hasOwnProperty("Draw")){
      field[data.Draw[0]][data.Draw[1]] = "0";
    }else {
      field[data.Lose[0]][data.Lose[1]] = "0";
    }
    fill_board(field);
  }
  xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');
  xhr.send(form);
}

const alert = document.querySelector(".alert");

document.querySelectorAll(".btn-label").forEach(item => {
    item.addEventListener('click', event =>{
        if(!item.classList.contains('cross')){
            item.classList.add("cross");
            if(alert.classList.contains("active")){
                alert.classList.remove("active");
            }
            const number = item.getAttribute("for");
            field[number[3]][number[1]] = "#";
            console.log(field);
            AJAX("echo.php", "POST", field);
            // Сразу отправлять данные в back-end на обработку игры
        }else {
            alert.classList.add("active");
        }
    });
});