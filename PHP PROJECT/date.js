$(document).ready(()=>{
    $(".date").each(function() {
        let date = $(this).text();
        let time = moment(date).fromNow();
        $(this).html(time);
    });  
})
