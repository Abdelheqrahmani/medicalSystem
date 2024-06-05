let ord = document.getElementById('ordannaces');
let anl = document.getElementById('analyses');
let rappmed = document.getElementById('rapmed');

let tableOrd = document.getElementById('table-ord');
let tableAnl = document.getElementById('table-anl');
let tableRapp = document.getElementById('table-rapp');
let n = 1;

ord.style.backgroundColor = '#16a085';
ord.style.color = 'white';

anl.addEventListener('click', function(){
   tableOrd.style.display = 'none';
   anl.style.backgroundColor = '#16a085';
   ord.style.backgroundColor = 'white';
   ord.style.color = '#16a085';
   anl.style.color = 'white';
   rappmed.style.backgroundColor = 'white';
   rappmed.style.color = '#16a085';
   tableAnl.style.display = 'block';
   tableRapp.style.display = 'none';
   n = 2;
});

ord.addEventListener('click', function(){
    tableOrd.style.display = 'block';
    ord.style.backgroundColor = '#16a085';
    anl.style.backgroundColor = 'white';
    ord.style.color = 'white';
    anl.style.color = '#16a085';
    rappmed.style.backgroundColor = 'white';
    rappmed.style.color = '#16a085';
    tableAnl.style.display = 'none';
    tableRapp.style.display = 'none';
    n = 1;
});

rappmed.addEventListener('click', function(){
    tableOrd.style.display = 'none';
    anl.style.backgroundColor = 'white';
    anl.style.color = '#16a085';
    ord.style.backgroundColor = 'white';
    ord.style.color = '#16a085';
    rappmed.style.backgroundColor = '#16a085';
    rappmed.style.color = 'white';
    tableAnl.style.display = 'none';
    tableRapp.style.display = 'block';
    n = 3;
});
