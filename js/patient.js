


let ord = document.getElementById('ordannaces');
let anl = document.getElementById('analyses');

let tableOrd = document.getElementById('table-ord');
let tableAnl = document.getElementById('table-anl');
let n = 1 ; 
ord.style.backgroundColor = '#16a085';
ord.style.color = 'white';


anl.addEventListener('click', function(){
   tableOrd.style.display = 'none';
   anl.style.backgroundColor = '#16a085';
   ord.style.backgroundColor = 'white';
   ord.style.color = '#16a085';
   anl.style.color = 'white';
    tableAnl.style.display = 'block';
    n = 2;
});


ord.addEventListener('click', function(){
    tableOrd.style.display = 'block';
    ord.style.backgroundColor = '#16a085';
    anl.style.backgroundColor = 'white';
    ord.style.color = 'white';
    anl.style.color = '#16a085';
    tableAnl.style.display = 'none';

    n = 1;
});
