 <script>
     function showFile(input , viewId) {
         let file = input.files[0];
         
         const reader = new FileReader();
         reader.addEventListener('load', () => {
             document.getElementById(viewId).src = reader.result;
         });
         //readAsDataURL method encodes the file as a base64 encoded string, which can be used directly in image elements.
         reader.readAsDataURL(file);
     }
 </script>
