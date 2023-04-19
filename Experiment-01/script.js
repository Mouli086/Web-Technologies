const grid = document.querySelector('.grid');
const resetButton = document.querySelector('#reset');
const size = 3;

let currentPlayer = 'S';
let gameBoard = Array(size * size).fill('');


for (let i = 0; i < size * size; i++) {
  const button = document.createElement('button');
  button.addEventListener('click', () => {
    if (gameBoard[i] === '') {
      gameBoard[i] = currentPlayer;
      button.textContent = currentPlayer;
      checkWin();
      currentPlayer = currentPlayer === 'S' ? 'O' : 'S';
    }
  });
  grid.appendChild(button);
}

function checkWin() {
  const sos = 'SOS';
  const diagonals = [[0, 4, 8], [2, 4, 6]];
  let win = false;


  for (let i = 0; i < size; i++) {
    let row = '';
    let col = '';
    for (let j = 0; j < size; j++) {
      row += gameBoard[i * size + j];
      col += gameBoard[j * size + i];
    }
    if (row.includes(sos) || col.includes(sos)) {
      win = true;
    }
  }
  for (let i = 0; i < diagonals.length; i++) {
    const diagonal = diagonals[i];
    const diag = diagonal.map(index => gameBoard[index]).join('');
    if (diag.includes(sos)) {
      win = true;
    }
  }

  if (win) {
    alert(currentPlayer + ' wins!');
    gameBoard = Array(size * size).fill('');
    grid.querySelectorAll('button').forEach(button => {
      button.textContent = '';
    });
    currentPlayer = 'S';
  }
}


resetButton.addEventListener('click', () => {
  gameBoard = Array(size * size).fill('');
  grid.querySelectorAll('button').forEach(button => {
    button.textContent = '';
  });
  currentPlayer = 'S';
});
