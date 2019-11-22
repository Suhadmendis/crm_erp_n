 <script>
 
  $( function() {


    $( "#name" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=namegrn&keyword=" + document.getElementById('name').value,
     minLength: 0
    });

   

  } );


  </script>



