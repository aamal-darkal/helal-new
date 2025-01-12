 <script>
     function addKeyword() {
         const inp = document.querySelector("[data-name='keyword']");
         if (inp.value == '') return;
         const inpVal = inp.value;
         inp.value = ''
         const template = document.getElementById("template-keyword").children[0]
         const newKeyword = template.cloneNode(true)
         newKeyword.querySelector('input').value = inpVal
         newKeyword.querySelector('span').innerHTML = inpVal
         document.querySelector("#keywords").appendChild(newKeyword)
     }


     function deleteKeyword(inp) {
         inp.parentNode.remove();
     }
 </script>
