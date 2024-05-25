


let ord = document.getElementById('ordannaces');
let anl = document.getElementById('analyses');

let tableOrd = document.getElementById('table-ord');
let tableAnl = document.getElementById('table-anl');
let n = 1 ; 


anl.addEventListener('click', function(){
   tableOrd.style.display = 'none';
    tableAnl.style.display = 'block';
    n = 2;
});


ord.addEventListener('click', function(){
    tableOrd.style.display = 'block';
    tableAnl.style.display = 'none';

    n = 1;
});
