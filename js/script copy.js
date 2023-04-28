const selectBox = document.querySelector(".select-box"),
selectBtnX = selectBox.querySelector(".options .playerX"),
selectBtnO = selectBox.querySelector(".options .playerO"),
playBoard = document.querySelector(".play-board"),
players = document.querySelector(".players"),
allBox = document.querySelectorAll(".game-row span"),
resultBox = document.querySelector(".result-box"),
wonText = resultBox.querySelector(".won-text"),
replayBtn = resultBox.querySelector("button");

function sendData(data) {
  const xhr = new XMLHttpRequest();
  const url = "../php/save_game.php";

  xhr.open("POST", url, true);
  xhr.setRequestHeader("Content-Type", "application/json");

  const jsonData = JSON.stringify(data);
  console.log(jsonData);

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      console.log("Data sent successfully!");
    }
  };

  xhr.send(jsonData);
}


let playerXIcon = "fas fa-times",
playerOIcon = "far fa-circle",
playerSign = "X",
playerSigned = "",
runBot = true;

window.onload = ()=>{
    for (let i = 0; i < allBox.length; i++) {
       allBox[i].setAttribute("onclick", "clickedBox(this)");
    }
}

selectBtnX.onclick = ()=>{
    selectBox.classList.add("hide");
    playBoard.classList.add("show");
    playerSign = "X";
    playerSigned = "X";
}

selectBtnO.onclick = ()=>{ 
    selectBox.classList.add("hide");
    playBoard.classList.add("show");
    playerSign = "O";
    playerSigned = "O";
    players.setAttribute("class", "players active player");
}

function clickedBox(element){
    if(players.classList.contains("player")){
        playerSign = "O";
        element.innerHTML = `<i class="${playerOIcon}"></i>`;
        players.classList.remove("active");
        element.setAttribute("id", playerSign);
    }else{
        element.innerHTML = `<i class="${playerXIcon}"></i>`;
        element.setAttribute("id", playerSign);
        players.classList.add("active");
    }
    selectWinner();
    element.style.pointerEvents = "none";
    playBoard.style.pointerEvents = "none";
    let randomTimeDelay = ((Math.random() * 1000) + 200).toFixed();
    setTimeout(()=>{
        bot(runBot);
    }, randomTimeDelay);
}

function bot(){
    let array = [];
    if(runBot){
        playerSign = "O";
        for (let i = 0; i < allBox.length; i++) {
            if(allBox[i].childElementCount == 0){
                array.push(i);
            }
        }
        let randomBox = array[Math.floor(Math.random() * array.length)];
        if(array.length > 0){
            if(players.classList.contains("player")){ 
                playerSign = "X";
                allBox[randomBox].innerHTML = `<i class="${playerXIcon}"></i>`;
                allBox[randomBox].setAttribute("id", playerSign);
                players.classList.add("active");
            }else{
                allBox[randomBox].innerHTML = `<i class="${playerOIcon}"></i>`;
                players.classList.remove("active");
                allBox[randomBox].setAttribute("id", playerSign);
            }
            selectWinner();
        }
        allBox[randomBox].style.pointerEvents = "none";
        playBoard.style.pointerEvents = "auto";
        playerSign = "X";
    }
}


function checkWin(sign){
let moves = [
[0, 1, 2],
[3, 4, 5],
[6, 7, 8],
[0, 3, 6],
[1, 4, 7],
[2, 5, 8],
[0, 4, 8],
[2, 4, 6]
];
for (let i = 0; i < moves.length; i++) {
let [a, b, c] = moves[i];
if (allBox[a].id == sign && allBox[b].id == sign && allBox[c].id == sign) {
return true;
}
}
return false;
}

function selectWinner(){
if(checkWin(playerSign)){
setResultBox("You won the game!");
saveGame(playerSigned, "win");
} else if(checkWin("O")){
setResultBox("Bot won the game!");
saveGame(playerSigned, "loss");
} else if(emptySpaces().length == 0){
setResultBox("Game is tied!");
saveGame(playerSigned, "draw");
}
}

function emptySpaces(){
let spaces = [];
for (let i = 0; i < allBox.length; i++) {
if (allBox[i].childElementCount == 0) {
spaces.push(i);
}
}
return spaces;
}

function setResultBox(msg){
wonText.textContent = msg;
resultBox.classList.add("show");
playBoard.classList.remove("show");
}

function saveGame(sign, gameStatus){
let gameData = { sign: sign, gameStatus: gameStatus };
// You can send gameData to your server or store it in your browser's local storage
console.log(gameData);
sendData(gameData);
}

replayBtn.onclick = ()=>{
window.location.reload();
}
