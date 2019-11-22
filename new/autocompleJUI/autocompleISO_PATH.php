 <script>
 
  $( function() {
 
//Quotation

    $( "#manual_ref" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=manual_ref&keyword=" + document.getElementById('manual_ref').value,
     minLength: 0
    });

     $( "#ATTN" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=ATTN&keyword=" + document.getElementById('ATTN').value,
     minLength: 0
    });


 $( "#CC" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=CC&keyword=" + document.getElementById('CC').value,
     minLength: 0
    });

  $( "#TO" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=TO&keyword=" + document.getElementById('TO').value,
     minLength: 0
    });

    $( "#SUBJECT" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SUBJECT&keyword=" + document.getElementById('SUBJECT').value,
     minLength: 0
    });


    //MRN


     $( "#txt_entno" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=manual_ref&keyword=" + document.getElementById('txt_entno').value,
     minLength: 0
    });

     $( "#txt_jobno" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=ATTN&keyword=" + document.getElementById('txt_jobno').value,
     minLength: 0
    });


 $( "#Product" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=CC&keyword=" + document.getElementById('Product').value,
     minLength: 0
    });

  $( "#txt_remarks" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=TO&keyword=" + document.getElementById('txt_remarks').value,
     minLength: 0
    });

//MRN EX

    $( "#txt_entno" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SUBJECT&keyword=" + document.getElementById('txt_entno').value,
     minLength: 0
    });

     $( "#txt_jobno" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SUBJECT&keyword=" + document.getElementById('txt_jobno').value,
     minLength: 0
    });

      $( "#Product" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SUBJECT&keyword=" + document.getElementById('Product').value,
     minLength: 0
    });

       $( "#txt_remarks" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SUBJECT&keyword=" + document.getElementById('txt_remarks').value,
     minLength: 0
    });

    //MRN IS

    $( "#txt_entno" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SUBJECT&keyword=" + document.getElementById('txt_entno').value,
     minLength: 0
    });

     $( "#txt_jobno" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SUBJECT&keyword=" + document.getElementById('txt_jobno').value,
     minLength: 0
    });

      $( "#Product" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SUBJECT&keyword=" + document.getElementById('Product').value,
     minLength: 0
    });

       $( "#txt_remarks" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SUBJECT&keyword=" + document.getElementById('txt_remarks').value,
     minLength: 0
    });

    //MRN GN

    $( "#txt_entno" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SUBJECT&keyword=" + document.getElementById('txt_entno').value,
     minLength: 0
    });

     $( "#txt_jobno" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SUBJECT&keyword=" + document.getElementById('txt_jobno').value,
     minLength: 0
    });

      $( "#txt_remarks" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SUBJECT&keyword=" + document.getElementById('txt_remarks').value,
     minLength: 0
    });

       $( "#manuel_ref" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SUBJECT&keyword=" + document.getElementById('manuel_ref').value,
     minLength: 0
    });

    //MRN INK

    $( "#txt_entno" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SUBJECT&keyword=" + document.getElementById('txt_entno').value,
     minLength: 0
    });

     $( "#txt_remarks" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SUBJECT&keyword=" + document.getElementById('txt_remarks').value,
     minLength: 0
    });

      $( "#manuel_ref" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SUBJECT&keyword=" + document.getElementById('manuel_ref').value,
     minLength: 0
    });

       $( "#txt_jobno" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SUBJECT&keyword=" + document.getElementById('txt_jobno').value,
     minLength: 0
    });

       $( "#Product" ).autocomplete({
      source: "autocompleJUI/commonISO.php?Command=SUBJECT&keyword=" + document.getElementById('Product').value,
     minLength: 0
    });



  } );

  




  </script>



