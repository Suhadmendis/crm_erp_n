 <script>
 
  $( function() {


    $( "#inputText" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=inputTextaod&keyword=" + document.getElementById('inputText').value,
     minLength: 0
    });

    $( "#Address" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=Addressaod&keyword=" + document.getElementById('Address').value,
     minLength: 0
    });

    $( "#ncp" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=ncpaod&keyword=" + document.getElementById('ncp').value,
     minLength: 0
    });

    $( "#tel" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=telaod&keyword=" + document.getElementById('tel').value,
     minLength: 0
    });

    $( "#Name_of_Driver" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=Name_of_Driveraod&keyword=" + document.getElementById('Name_of_Driver').value,
     minLength: 0
    });

   


  });


  </script>



