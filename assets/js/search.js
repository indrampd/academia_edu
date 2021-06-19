function keywordFile() {  
    document.getElementById('keyword').click(); return false;
}

function searchFile(){
    var button = document.getElementById('search');
        button.click();
}


// $(document).ready(function(){
 
//     $('#keywoard').autocomplete({
//         source: "post_search.php",
//         minLength: 2,
//         select: function(event, ui) {
//             var url = ui.item.id;
//             if (url != '#') {
//                 location.href = url
//             }
//         },
//         open: function(event, ui) {
//             $(".ui-autocomplete").css("z-index", 1000)
//         }
//     })
    
//    });

// $(document).ready(function(){
//     $( "#keyword" ).autocomplete({
//       source: 'search.php'
//     });
// });

// $(document).ready(function() {

//     $('#keyword').on('keyup', function() {
//         $('#users').load('data_users.php?keyword=' + $('keyword').val());
//     });

// });